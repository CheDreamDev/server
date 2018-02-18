<?php
/**
 * Created by PhpStorm.
 * User: jack
 * Date: 18.02.18
 * Time: 11:47
 */

namespace App\Auth;

use Doctrine\ORM\EntityManagerInterface;
use HWI\Bundle\OAuthBundle\Security\Core\User\OAuthUserProvider;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class OAuthProvider extends OAuthUserProvider
{
    protected $session, $em, $admins, $container, $encoder;

    public function __construct( ContainerInterface $service_container,
        SessionInterface $session,
        EntityManagerInterface $entityManager, UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
        $this->session = $session;
        $this->em = $entityManager;
        $this->container = $service_container;
    }

    public function loadUserByUsername($username)
    {

        $qb = $this->em->createQueryBuilder();
        $qb->select('u')
            ->from('App:User', 'u')
            ->where('u.facebookId = :gid')
            ->setParameter('gid', $username)
            ->setMaxResults(1);
        $result = $qb->getQuery()->getResult();

        if (count($result)) {
            return $result[0];
        } else {
            return new User();
        }
    }

    public function loadUserByOAuthUserResponse(UserResponseInterface $response)
    {
        //Data from Facebook response
        $facebook_id = $response->getUsername(); /* An ID like: 112259658235204980084 */
        $email = $response->getEmail();
        $nickname = $response->getNickname();
        $realname = $response->getRealName();
        $avatar = $response->getProfilePicture();

        //set data in session
        $this->session->set('email', $email);
        $this->session->set('nickname', $nickname);
        $this->session->set('realname', $realname);
        $this->session->set('avatar', $avatar);

        //Check if this Facebook user already exists in our app DB
        $qb = $this->em->createQueryBuilder();
        $qb->select('u')
            ->from('App:User', 'u')
            ->where('u.facebookId = :gid')
            ->setParameter('gid', $facebook_id)
            ->setMaxResults(1);
        $result = $qb->getQuery()->getResult();

        //add to database if doesn't exists
        if (!count($result)) {
            $user = new User();
            $user->setUsername($facebook_id);
            $user->setRealname($realname);
            $user->setNickname($nickname);
            $user->setEmail($email);
            $user->setFacebookId($facebook_id);

            //Set some wild random pass since its irrelevant, this is Facebook login

            $password = $this->encoder->encodePassword($user, $user->getSalt());
            $user->setPassword($password);

            $em = $this->em;
            $em->persist($user);
            $em->flush();
        } else {
            $user = $result[0]; /* return User */
        }

        //set id
        $this->session->set('id', $user->getId());

        return $this->loadUserByUsername($response->getUsername());
    }

    public function supportsClass($class)
    {
        return $class === User::class;
    }
}