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
     */
    public function login()
    {
        $facebook_app_id = $this->container->getParameter('facebook_app_id');

        return $this->render('security/login.html.twig',[
            'facebook_app_id' => $facebook_app_id
        ]);
    }
}
