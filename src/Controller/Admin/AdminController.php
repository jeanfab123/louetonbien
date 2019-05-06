<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AdminController extends AbstractController
{

    /**
     * @Route("/admin", name="admin.index")
     * @return                   \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        return $this->render('admin/index.html.twig');
    }
}
