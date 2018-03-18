<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;

/**
 * Class AdminController
 */
class AdminController extends BaseAdminController
{
    /**
     * @Route("", name="dashboard")
     */
    public function dashboard()
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
}
