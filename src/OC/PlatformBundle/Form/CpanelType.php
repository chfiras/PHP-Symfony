<?php
// src/OC/PlatformBundle/Form/CpanelType.php

namespace OC\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CpanelType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('NomUtilisateur', TextType::class, array(
        'label'=>'Nom d\'utilisateur',
          'label_attr'=>array(

                  'class'=>'col-md-5 control-label',
                  'style'=>'text-align: left',

          ),
          'attr'=>array(
              'class'=>'form-control'
          )

      ))
      ->add('Password', TextType::class, array(
        'label'=>'Mot de passe',
          'label_attr'=>array(
              'class'=>'col-md-5 control-label',
              'style'=>'text-align: left',
          ),
          'attr'=>array(
              'class'=>'form-control'
          )
      ))
      ->add('Chemin', TextType::class, array(
          'label_attr'=>array(
              'class'=>'col-md-5 control-label',
              'style'=>'text-align: left',
          ),
          'attr'=>array(
              'class'=>'form-control'
          )
      ));

  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'OC\PlatformBundle\Entity\Cpanel'

    ));
  }
}
