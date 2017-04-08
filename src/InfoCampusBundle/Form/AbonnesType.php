<?php

namespace InfoCampusBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AbonnesType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('prenom', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('type', ChoiceType::class, array(
                'choices'  => array(
                    'Général' => 'G',
                    'Etudiant' => 'E',
                    'Pro' => 'P',
                ),
                'attr' => array('class' => 'form-control'),
                ))
            ->add('numTel', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('domaineInteret', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('niveau', ChoiceType::class, array(
                'choices'  => array(
                    'Licence1' => 'L1',
                    'Licence2' => 'L2',
                    'Licence3' => 'L3',
                    'Master1' => 'M1',
                    'Master2' => 'M2',
                    'Doctorant' => 'D',
                    'Personnel' => 'P'
                ),
                'attr' => array('class' => 'form-control'),
            ))
//            ->add('password', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('faculte', EntityType::class, array(
                'class' => 'InfoCampusBundle\Entity\Facultes',
                'choice_label' => 'nom',
                'attr' => array('class' => 'form-control')
            ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'InfoCampusBundle\Entity\Abonnes'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'infocampusbundle_abonnes';
    }


}
