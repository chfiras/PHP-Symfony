<?php
// src/OC/PlatformBundle/Form/AdvertEditType.php

namespace OC\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class FacturationEditType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder->remove('date');
  }

  public function getParent()
  {
    return FacturationType::class;
  }
}
