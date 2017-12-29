<?php
// src/OC/PlatformBundle/Form/NomDeDomaineType.php

namespace OC\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextAreaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class NomDeDomaineType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {

      $builder
          ->add('Domaine', UrlType::class,array(
              'label'=>'Nom de domaine',
              'label_attr'=>array(
                  'class'=>'col-md-5 control-label',
                  'style'=>'text-align: left',          ),


          ))
      ->add('DateDeCreation', DateType::class,array(
        'label'=>'Date de création',
          'label_attr'=>array(
              'class'=>'col-md-5 control-label',
              'style'=>'text-align: left',          ),


      ))
      ->add('DateDExpiration', DateType::class, array(
        'label'=>'Date d\'expiration',
          'label_attr'=>array(
              'class'=>'col-md-5 control-label',
              'style'=>'text-align: left',          ),

      ))
      ->add('Remarque', TextAreaType::class, array(

          'label_attr'=>array(
              'class'=>'col-md-5 control-label',
              'style'=>'text-align: left', ),


      ));

  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'OC\PlatformBundle\Entity\NomDeDomaine',


    ));
  }
}
