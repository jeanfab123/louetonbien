<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;

class AdminController extends BaseAdminController
{
    /**
     * @Route("/dashboard", name="admin_dashboard")
     */
    public function dashboard()
    {
        return $this->render('admin/dashboard.html.twig');
    }
}
