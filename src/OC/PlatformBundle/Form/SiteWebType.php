<?php
// src/OC/PlatformBundle/Form/SiteWebType.php

namespace OC\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SiteWebType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('name', UrlType::class, array(
        'label'=>'Site web',

          'attr'=>array(
              'class'=>'form-control'
          ),
          'label_attr'=>array(
              'class'=>'col-md-5 control-label',

      'style'=>'text-align: left',
  )

      ))
      ->add('Param', TextType::class, array(
      'label'=>'Paramètre de connexion',
      'attr'=>array(
          'class'=>'form-control'
      ),
      'label_attr'=>array(
          'class'=>'col-md-8 control-label',

          'style'=>'text-align: left',
      )

  ));
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'OC\PlatformBundle\Entity\SiteWeb'
    ));
  }
}
