<?php

namespace App\Controller;

use App\Entity\Adopcion;
use App\Form\AdopcionType;
use App\Repository\AdopcionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/adopcion')]
class AdopcionController extends AbstractController
{
    #[Route('/', name: 'adopcion_index', methods: ['GET'])]
    public function index(AdopcionRepository $adopcionRepository): Response
    {
        return $this->render('adopcion/index.html.twig', [
            'adopcions' => $adopcionRepository->findAll(),
        ]);
    }





    #[Route('/new', name: 'adopcion_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $adopcion = new Adopcion();
        $form = $this->createForm(AdopcionType::class, $adopcion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($adopcion);
            $entityManager->flush();

            return $this->redirectToRoute('adopcion_index');
        }

        return $this->render('adopcion/new.html.twig', [
            'adopcion' => $adopcion,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'adopcion_show', methods: ['GET'])]
    public function show(Adopcion $adopcion): Response
    {
        return $this->render('adopcion/show.html.twig', [
            'adopcion' => $adopcion,
        ]);
    }

    #[Route('/{id}/edit', name: 'adopcion_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Adopcion $adopcion): Response
    {
        $form = $this->createForm(AdopcionType::class, $adopcion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('adopcion_index');
        }

        return $this->render('adopcion/edit.html.twig', [
            'adopcion' => $adopcion,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'adopcion_delete', methods: ['POST'])]
    public function delete(Request $request, Adopcion $adopcion): Response
    {
        if ($this->isCsrfTokenValid('delete'.$adopcion->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($adopcion);
            $entityManager->flush();
        }

        return $this->redirectToRoute('adopcion_index');
    }
}
