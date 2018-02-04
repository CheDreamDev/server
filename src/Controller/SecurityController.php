<?php
/**
 * Created by PhpStorm.
 * User: jack
 * Date: 03.02.18
 * Time: 12:41
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Facebook\Facebook;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login")
     *
     */
    public function login(AuthenticationUtils $authUtils)
    {
        $fb = new Facebook([
            'app_id' => '2100826210141247', // Replace {app-id} with your app id
            'app_secret' => 'a649d831412f50ba11a6fdb774318498',
            'default_graph_version' => 'v2.2',
        ]);

        $helper = $fb->getRedirectLoginHelper();

        $permissions = ['email']; // Optional permissions
        $loginUrl = $helper->getLoginUrl('http://test.chedream.org/callback', $permissions);

        // get the login error if there is one
        $error = $authUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authUtils->getLastUsername();

        return $this->render('security/login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
            'url'           => $loginUrl,
        ));

    }


    /**
     * @Route("/logout")
     */
    public function logout()
    {

    }
}
