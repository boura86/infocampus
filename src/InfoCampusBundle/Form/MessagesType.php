<?php

namespace InfoCampusBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MessagesType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('libelle', TextareaType::class, array('attr' => array('class' => 'form-control')))
            ->add('objet', TextType::class, array('attr' => array('class' => 'form-control')));
//            ->add('date',  DateTimeType::class, array(
//                'widget' => 'single_text',
//                'html5' => false,
//                'format' => 'dd-MM-yyyy',
//                'attr' => array('class' => 'form-control','placeholder' => 'dd-mm-yyyy'),
//            ))
//            ->add('dateReception', DateTimeType::class, array(
//                'widget' => 'single_text',
//                'html5' => false,
//                'format' => 'dd-MM-yyyy',
//                'attr' => array('class' => 'form-control','placeholder' => 'dd-mm-yyyy'),
//            ))
//            ->add('dateEnvoi', DateTimeType::class, array(
//                'widget' => 'single_text',
//                'html5' => false,
//                'format' => 'dd-MM-yyyy',
//                'attr' => array('class' => 'form-control','placeholder' => 'dd-mm-yyyy'),
//            ))
//            ->add('statut', TextType::class, array('attr' => array('class' => 'form-control')))
//            ->add('abonnes')
//            ->add('facultes', EntityType::class, array(
//        // query choices from this entity
//                        'class' => 'InfoCampusBundle\Entity\Facultes',
//                        'choice_label' => 'nom',
//                        'multiple' => true,
//                        'attr' => array('class' => 'form-control')
//                    ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'InfoCampusBundle\Entity\Messages'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'infocampusbundle_messages';
    }


}
