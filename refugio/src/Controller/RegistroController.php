<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegistroController extends AbstractController
{
    #[Route('/registro', name: 'registro')]
    public function index(Request $request, 
    UserPasswordHasherInterface $passwordHasher): Response
    {
        //UserPasswordEncoderInterface $passwordEncoder
        $user = new User();
        $form = $this -> createForm(UserType::class, $user);
        $form -> handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            //$user -> setActivo(true);
            $user -> setRoles(['ROLE_USER']);
           /* $user->setPassword($passwordEncoder->encodePassword(
                               $user,
                               $form['password']->getData()
                               ));*/
            $user->setPassword($passwordHasher->hashPassword(
                               $user,
                               $form['password']->getData()
                               ));
            $em -> persist($user);
            $em -> flush();
            $this->addFlash('exito','Se ha registrado Exitosamente');
            return $this->redirectToRoute('registro');

        }
        return $this->render('registro/index.html.twig', [
            'controller_name' => 'Registro',
            'formulario' => $form->createView()
        ]);
    }
}
// para ingresar uso http://localhost/refugio/public/index.php/registro