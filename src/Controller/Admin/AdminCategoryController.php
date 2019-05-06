<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\CategoryRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use App\Entity\Category;
use App\Form\CategoryType;

class AdminCategoryController extends AbstractController
{

    /**
     * @var CategoryRepository
     */
    private $repository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->repository = $categoryRepository;
    }

    /**
     * @Route("/admin/category", name="admin.category.index")
     * @return                   \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $categories = $this->repository->findAll();

        return $this->render('admin/category/index.html.twig', compact('categories'));
    }

    /**
     * @Route("/admin/category/{id}/edit/", name="admin.category.edit")
     * @return                              \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Category $category)
    {
        $form = $this->createForm(CategoryType::class);
        return $this->render('admin/category/edit.html.twig', [
            'category' => $category,
            'form' => $form->createView()
        ]);
    }
}
