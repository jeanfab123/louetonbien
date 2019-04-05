<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ItemController extends AbstractController
{

    /**
     * @Route("/articles/", name="items")
     * @return              Response
     * @throws              Exception
     */
    public function show(): Response
    {
        return $this->render(
            'item/items.html.twig', [
            'current_menu' => 'items'
            ]
        );
    }
}
