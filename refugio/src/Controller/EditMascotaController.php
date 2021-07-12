<?php

namespace App\Controller;

use App\Entity\Mascota;
use App\Form\Mascota1Type;
use App\Repository\MascotaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/edit/mascota')]
class EditMascotaController extends AbstractController
{
    #[Route('/', name: 'edit_mascota_index', methods: ['GET'])]
    public function index(MascotaRepository $mascotaRepository): Response
    {
        return $this->render('edit_mascota/index.html.twig', [
            'mascotas' => $mascotaRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'edit_mascota_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $mascotum = new Mascota();
        $form = $this->createForm(Mascota1Type::class, $mascotum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($mascotum);
            $entityManager->flush();

            return $this->redirectToRoute('edit_mascota_index');
        }

        return $this->render('edit_mascota/new.html.twig', [
            'mascotum' => $mascotum,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'edit_mascota_show', methods: ['GET'])]
    public function show(Mascota $mascotum): Response
    {
        return $this->render('edit_mascota/show.html.twig', [
            'mascotum' => $mascotum,
        ]);
    }

  

    #[Route('/{id}/edit', name: 'edit_mascota_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Mascota $mascotum): Response
    {
        $form = $this->createForm(Mascota1Type::class, $mascotum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('edit_mascota_index');
        }

        return $this->render('edit_mascota/edit.html.twig', [
            'mascotum' => $mascotum,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'edit_mascota_delete', methods: ['POST'])]
    public function delete(Request $request, Mascota $mascotum): Response
    {
        if ($this->isCsrfTokenValid('delete'.$mascotum->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($mascotum);
            $entityManager->flush();
        }

        return $this->redirectToRoute('edit_mascota_index');
    }
}
