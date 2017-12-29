<?php

namespace OC\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;


class blocFactureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('categorie', ChoiceType::class, array(
                'label'=>'Catégorie',
                'choices'=> array(
                    'Steg'=>'Steg',
                    'Sonede'=>'Sonede',
                    'Télécom'=>'Télécom',
                    'Gestion des ressources' => 'Gestion des ressources',
                    'Salaire du personnel' => 'Salaire du personnel',
                    'Frais de location' => 'Frais de location',
                    'Divers frais' => 'Divers frais',
                ),
                'label_attr'=>array(
                    'class'=>'col-md-5 control-label',
                    'style'=>'text-align: left',
                ),
                'attr'=>array(
                    'class'=>'form-control'
                )
            ))
            ->add('montant', TextType::class, array(
                'label'=>'Montant (en Dinars)',
                'label_attr'=>array(
                    'class'=>'col-md-5 control-label',
                    'style'=>'text-align: left',          ),
                'attr'=>array(
                    'class'=>'montant',
                    'id'=>'mon'
                )
            ))
            ->add('note', TextareaType::class, array(
                'required'=>false,
                'label'=>'Note',
                'label_attr'=>array(
                    'class'=>'col-md-5 control-label',
                    'style'=>'text-align: left',          ),
                'attr'=>array(
                    'class'=>'form-control'
                ),
            ))
            ->add('DateFin',DateType::class,array(
                'label_attr'=>array(
                    'class'=>'col-md-8 control-label',
                    'style'=>'text-align: left',
                    ),
                'label'=>'Dernière date avant paiement'
            ));

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'OC\PlatformBundle\Entity\blocFacture'
        ));
    }
}
