<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class User1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username',null,['required' => true])
            ->add('password',PasswordType::class)
            ->add('nombre',null,['required' => true])
            ->add('apellido',null,['required' => true])
            ->add('dni',null,['required' => true])
            ->add('direccion',null,['required' => true])
            ->add('email',EmailType::class)
            ->add('cantidadMascotas',null,['required' => true])
            ->add('telefono',null,['required' => true])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
