<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Common\Persistence\ObjectManager;

class AdminCategoryController extends AbstractController
{

    /**
     * @var CategoryRepository
     */
    private $repository;

    public function __construct(CategoryRepository $categoryRepository, ObjectManager $objectManager)
    {
        $this->repository = $categoryRepository;
        $this->objectManager = $objectManager;
    }

    /**
     * @Route("/admin/category", name="admin.category.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $categories = $this->repository->findAll();

        return $this->render('admin/category/index.html.twig', compact('categories'));
    }

    /**
     * @Route("/admin/category/new/", name="admin.category.new")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function new(Request $request)
    {

        $category = new Category();

        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->objectManager->persist($category);
            $this->objectManager->flush();
            $this->addFlash('success', 'Element créé avec succès !');
            return $this->redirectToRoute('admin.category.index');
        }

        return $this->render(
            'admin/category/new.html.twig',
            [
                'category' => $category,
                'form' => $form->createView()
            ]
        );
    }

    /**
     * @Route("/admin/category/{id}/edit/", name="admin.category.edit", methods="GET|POST")
     * @param Category $category
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Category $category, Request $request)
    {

        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->objectManager->flush();
            $this->addFlash('success', 'Element modifié avec succès !');
            return $this->redirectToRoute('admin.category.index');
        }

        return $this->render(
            'admin/category/edit.html.twig',
            [
                'category' => $category,
                'form' => $form->createView()
            ]
        );
    }

    /**
     * @Route("/admin/category/{id}/delete/", name="admin.category.delete", methods="DELETE")
     * @param Category $category
     * @return Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function delete(Category $category, Request $request)
    {

        if ($this->isCsrfTokenValid('delete' . $category->getId(), $request->get('_token'))) {
            $this->objectManager->remove($category);
            $this->objectManager->flush();
            $this->addFlash('success', 'Element supprimé avec succès !');
        }
        return $this->redirectToRoute('admin.category.index');
    }
}
