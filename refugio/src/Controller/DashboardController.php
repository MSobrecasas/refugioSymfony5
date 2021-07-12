<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Models\User as UserEntity;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'dashboard')]
    public function index(): Response
    {
        $em = $this -> getDoctrine() -> getManager();
        $user = $em -> getRepository(User::class) -> findAll();
        return $this->render('dashboard/index.html.twig', [
            'usuarios' => $user
        ]);
    }
}
