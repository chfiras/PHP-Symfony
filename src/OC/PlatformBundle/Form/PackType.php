<?php

namespace OC\PlatformBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;



class PackType Extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'label'=>'Nom du pack',
                'attr'=>array(
                    'class'=>'form-control col-md-11',

                ),
                'label_attr'=>array(
                    'style'=>'text-align: left',
                )
            ));
        $builder
            ->add('description', TextareaType::class, array(
                'attr'=>array(
                    'class'=>'ckeditor'
                ),
                'label_attr'=>array(
                    'style'=>'text-align: left',
                ),
            ));

        $builder->add('save',      SubmitType::class ,array(
        'label'=>'Enregistrer',
            'attr'=>array(
        'style'=>'text-align: left',
    )
    ))
    ;

        // On ajoute une fonction qui va écouter un évènement
        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,    // 1er argument : L'évènement qui nous intéresse : ici, PRE_SET_DATA
            function(FormEvent $event) { // 2e argument : La fonction à exécuter lorsque l'évènement est déclenché
                // On récupère notre objet Advert sous-jacent
                $pack = $event->getData();


            }
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'OC\PlatformBundle\Entity\Pack',
            'cascade_validation' => true,
        ));
    }
}