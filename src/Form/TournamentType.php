<?php

namespace App\Form;

use App\Entity\Tournament;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TournamentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('begin', DateTimeType::class, array(
                'required' => true,
                'label' => 'Datum & Uhrzeit: ',
                'date_widget' => 'single_text',
                'time_widget' => 'choice',
                'html5' => true,
                'input' => 'datetime',
                'minutes' => array(
                    '00',
                    '15',
                    '30',
                    '45',
                )
            ))
            ->add('maxPlayers', IntegerType::class, array(
                'required' => true,
                'label' => 'Max. Teams: ',
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tournament::class,
        ]);
    }
}
