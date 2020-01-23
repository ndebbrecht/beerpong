<?php

namespace App\Form;

use App\Entity\Team;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TeamType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('player1name', TextType::class, array(
                'label' => 'Spieler 1: ',
                'required' => true,
            ))
            ->add('player1external', CheckboxType::class, array(
                'label' => 'bist du extern? ',
                'required' => false,
            ))
            ->add('player1number', TelType::class, array(
                'label' => 'Handynummer: ',
                'required' => false,
            ))
            ->add('player2name', TextType::class, array(
                'label' => 'Spieler 2: ',
                'required' => true,
            ))
            ->add('player2external', CheckboxType::class, array(
                'label' => 'bist du extern? ',
                'required' => false,
            ))
            ->add('player2number', TextType::class, array(
                'label' => 'Handynummer: ',
                'required' => false,
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Team::class,
        ]);
    }
}
