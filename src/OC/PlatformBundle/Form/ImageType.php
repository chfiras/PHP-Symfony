<?php
// src/OC/PlatformBundle/Form/ImageType.php

namespace OC\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;

class ImageType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('file', FileType::class, array(
        'label'=>false,
        'constraints' => array(
          new Image(array('mimeTypes'=>
          array(
              'image/jpeg',
              'image/png',
              'image/jpg',
              'image/gif'
          )
        )

    )
  ),
      'label_attr'=>array(
      'class'=>'col-md-5 control-label',
      'style'=>'text-align: left',
  ),

      ))
    ;
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'OC\PlatformBundle\Entity\Image'
    ));
  }
}
