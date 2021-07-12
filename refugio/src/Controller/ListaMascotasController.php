<?php

namespace App\Controller;

use App\Entity\Mascota;
use App\Repository\MascotaRepository;
use App\Controller\ArticleController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListaMascotasController extends AbstractController
{
    #[Route('/lista/mascotas', name: 'lista_mascotas')]
    public function index(): Response
    {
       
    
        $em = $this -> getDoctrine() -> getManager();
        $mascotas= $em -> getRepository(Mascota::class) -> findAll();
        return $this->render('lista_mascotas/index.html.twig', [
            'mascotas' => $mascotas,
        ]);
    }
}
