<?php

namespace App\Controller;

use App\Entity\Mascota;
use App\Form\MascotaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class MascotaController extends AbstractController
{
    #[Route('/mascota', name: 'mascota')]
    public function index(Request $request): Response
    {
        $mascota = new Mascota();
        $form = $this -> createForm(MascotaType::class, $mascota);
        $form -> handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em -> persist($mascota);
            $em -> flush();
            $this->addFlash('exito','Se ha registrado Exitosamente');
            return $this->redirectToRoute('mascota');

        }
        return $this->render('mascota/index.html.twig', [
            'controller_name' => 'Mascota',
            'formulario' => $form->createView()
        ]);
    }
}
