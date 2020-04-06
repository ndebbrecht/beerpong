<?php

namespace App\Form;

use App\Entity\InfoMail;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InfoMailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('topic', TextType::class, array(
                'label' => 'Titel',
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('content', TextType::class, array(
                'label' => 'Inhalt',
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => InfoMail::class,
        ]);
    }
}
