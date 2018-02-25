<?php
/**
 * Created by PhpStorm.
 * User: jack
 * Date: 04.02.18
 * Time: 17:17
 */

namespace App\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;


class UserFixture extends Fixture
{
    private $encoder;

    private  $users = [
        [
            'username' => 'admin',
            'email' => 'example@gmail.com',
            'password' => 'admin',
            'isActive' => '1',
        ]
    ];

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        foreach ($this->users as $user) {
            $userTest = new User();

            $userTest->setUsername($user['username']);
            $userTest->setEmail($user['email']);

            $userTest->setPassword($user['password']);

            $password = $this->encoder->encodePassword($userTest, $userTest->getPassword());
            $userTest->setPassword($password);

            $userTest->setUsername($user['username']);
            $userTest->setIsActive($user['isActive']);

            $manager->persist($userTest);
        }
        $manager->flush();
    }
}
