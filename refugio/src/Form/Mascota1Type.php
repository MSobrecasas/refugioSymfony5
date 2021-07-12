<?php

namespace App\Form;

use App\Entity\Mascota;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class Mascota1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('edad')
            ->add('tipo', EntityType:: class, [
                'class' => 'App\Entity\TipoMascota',
                'placeholder' => 'Seleccionar Tipo',
                
            ])
            ->add('raza', EntityType:: class, [
                'class' => 'App\Entity\RazaMascota',
                'placeholder' => 'Seleccionar Raza'
            ])
            ->add('color',null,['required' => true])
            ->add('tamanio',null,['required' => true])
            ->add('foto', FileType::class)
            ->add('fechaIngreso',null,['required' => true])
            
            //->add('activo')
            //->add('adopcion')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Mascota::class,
        ]);
    }
}
