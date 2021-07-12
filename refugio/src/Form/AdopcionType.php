<?php

namespace App\Form;

use App\Entity\Adopcion;
use App\Entity\Mascota;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Button;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;


use Symfony\Component\Form\FormInterface;

class AdopcionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('fechaAdopcion')
            ->add('mascota', EntityType:: class, [
                'class' => 'App\Entity\Mascota',
                'placeholder' => 'Seleccionar Mascota',
                
            ])
            ->add('usuario', EntityType:: class, [
                'class' => 'App\Entity\User',
                'placeholder' => 'Seleccionar Adoptante',
                
            ])
        ;
   
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Adopcion::class,
        ]);
    }
}
