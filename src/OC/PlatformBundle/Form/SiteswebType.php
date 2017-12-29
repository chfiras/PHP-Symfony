<?php
// src/OC/PlatformBundle/Form/SiteswebType.php

namespace OC\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SiteswebType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('URL', UrlType::class, array(
        'label'=>'URL',
          'label_attr'=>array(
              'class'=>'col-md-5 control-label',
              'style'=>'text-align: left',          ),
          'attr'=>array(
              'class'=>'form-control'
          )
      ))
      ->add('user', TextType::class, array(
        'label'=>'Utilisateur',
          'label_attr'=>array(
              'class'=>'col-md-5 control-label',
              'style'=>'text-align: left',          ),
          'attr'=>array(
              'class'=>'form-control'
          )
      ))
      ->add('Password', TextType::class, array(
        'label'=>'Mot de passe',
          'label_attr'=>array(
              'class'=>'col-md-5 control-label',
              'style'=>'text-align: left',          ),
          'attr'=>array(
              'class'=>'form-control'
          )
      ));

  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'OC\PlatformBundle\Entity\Sitesweb'
    ));
  }
}
