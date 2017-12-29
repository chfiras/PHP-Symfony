<?php
// src/OC/PlatformBundle/Form/AdvertType.php

namespace OC\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;


class AdvertType extends AbstractType
{


  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    // Arbitrairement, on récupère toutes les catégories qui commencent par "D"
    $builder
        ->add('Client',     TextType::class, array(
            'label_attr'=>array(
                'class'=>'col-md-5 control-label',
                'style'=>'text-align: left',
            ),
            'attr'=>array(
                'class'=>'form-control'
            )
        ))
        ->add('Responsable',TextType::class, array(
            'label_attr'=>array(
                'class'=>'col-md-5 control-label',
                'style'=>'text-align: left',
            ),
            'attr'=>array(
                'class'=>'form-control'
            )
        ))
        ->add('MailPrincipal',     EmailType::class, array(
          'label_attr'=>array(
              'class'=>'col-md-8 control-label',
              'style'=>'text-align: left',
          ),
          'attr'=>array(
              'class'=>'form-control'
          )
      ))
      ->add('Description',   TextareaType::class,array(
          'label_attr'=>array(
              'class'=>'col-md-5 control-label',
              'style'=>'text-align: left',
          ),
          /*'attr'=>array(
              'class'=>'form-control'
          )*/
      ))
      ->add('image',     ImageType::class,array(
          'label'=>'Logo',
          'label_attr'=>array(
              'class'=>'col-md-5 control-label',
              'style'=>'text-align: left',
          ),
          'attr'=>array(
              'class'=>'form-control'
          )
      ))
        ->add('MF',TextType::class, array(
            'label'=>'Matricule Fiscale',
            'label_attr'=>array(
                'class'=>'col-md-5 control-label',
                'style'=>'text-align: left',
            ),
            'attr'=>array(
                'class'=>'form-control'
            )
        ))
      ->add('SiteWeb', CollectionType::class, array(
        'entry_type'   => SiteWebType::class,
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
      ->add('Adresse', CollectionType::class, array(
        'entry_type'   => AdresseType::class,
        'allow_add'    => true,
        'allow_delete' => true,
        'entry_options' => array(
            'label' => false,
         ),
          'label_attr'=>array(
              'class'=>'col-md-5 control-label',
              'style'=>'text-align: left',
          ),
          'attr'=>array(
              'class'=>'form-control'
          )
      ))
      ->add('TelFax', CollectionType::class, array(
        'entry_type'   => TelFaxType::class,
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
      ->add('NomDeDomaine', CollectionType::class, array(
        'entry_type'   => NomDeDomaineType::class,
        'allow_add'    => true,
        'allow_delete' => true,
        'entry_options' => array(
            'label' => false,
         ),


      ))
      ->add('Cpanel', CpanelType::class)
      ->add('FTP', FTPType::class)
      ->add('BaseDeDonnee', CollectionType::class, array(
        'entry_type'   => BaseDeDonneeType::class,
        'allow_add'    => true,
        'allow_delete' => true,
        'entry_options' => array(
            'label' => false,
         ),
      ))
      ->add('Sitesweb', CollectionType::class, array(
        'entry_type'   => SiteswebType::class,
        'allow_add'    => true,
        'allow_delete' => true,
        'entry_options' => array(
            'label' => false,
         ),
      ))
      ->add('Reseaux', CollectionType::class, array(
        'entry_type'   => ReseauxType::class,
        'allow_add'    => true,
        'allow_delete' => true,
        'entry_options' => array(
            'label' => false,
         ),
      ))
      ->add('Emails', CollectionType::class, array(
        'entry_type'   => EmailsType::class,
        'allow_add'    => true,
        'allow_delete' => true,
        'entry_options' => array(
            'label' => false,
         ),
      ))
        ->add('pack',ChoiceType::class,array(
            'label_attr'=>array(
                'class'=>'col-md-5 control-label',
                'style'=>'text-align: left',
            ),
            'attr'=>array(
                'class'=>'form-control'
            ),
            'choices'=>array_combine(array_values($options['pack']),array_values($options['pack'])),
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
      'data_class' => 'OC\PlatformBundle\Entity\Advert',
      'cascade_validation' => true,
    ))
        ->setRequired('pack')
        ->setAllowedTypes('pack',array('array'));
  }

}
