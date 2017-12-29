<?php
// src/OC/PlatformBundle/Form/AdvertType.php

namespace OC\PlatformBundle\Form;



use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;



class FacturationType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {


    $builder

        ->add('Periode',DateType::class,array(
            'attr'=>array(
                'class'=>'col-md-6 col-md-push-3'
            )
        ))
        ->add('blocFacture', CollectionType::class, array(
            'entry_type'   => blocFactureType::class,
            'allow_add'    => true,
            'allow_delete' => true,
            'entry_options' => array(
                'label' => false,
            ),

            'attr'=>array(
                'class'=>'form-control'
            ),
            'label_attr'=>array(
                'class'=>'col-md-5 control-label',
                'style'=>'text-align: left',
            ),

        ))

      ->add('save',      SubmitType::class ,array(
          'label'=>'Enregistrer'
      ))
    ;

    // On ajoute une fonction qui va écouter un évènement
    $builder->addEventListener(
      FormEvents::PRE_SET_DATA,    // 1er argument : L'évènement qui nous intéresse : ici, PRE_SET_DATA
      function(FormEvent $event) { // 2e argument : La fonction à exécuter lorsque l'évènement est déclenché
        // On récupère notre objet Advert sous-jacent
        $advert = $event->getData();


      }
    );
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'OC\PlatformBundle\Entity\Facturation',
      'cascade_validation' => true,
    ));
  }
}
