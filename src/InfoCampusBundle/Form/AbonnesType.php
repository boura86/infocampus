<?php

namespace InfoCampusBundle\Form;

use Doctrine\ORM\EntityRepository;
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
        $builder->add('nom', TextType::class, array('required' => false, 'attr' => array('class' => 'form-control')))
            ->add('prenom', TextType::class, array('required' => false, 'attr' => array('class' => 'form-control', 'required' => false)))
            ->add('type', ChoiceType::class, array(
                'choices'  => array(
                    'Général' => 'G',
                    'Infocampus' => 'IC',
                    'InfocampusPlus' => 'IP',
                ),
                'attr' => array('class' => 'form-control'),
                ))
            ->add('numTel', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('domaineInteret', TextType::class, array('required' => false, 'attr' => array('class' => 'form-control')))
            ->add('niveau', EntityType::class, array(
                'class' => 'InfoCampusBundle\Entity\Niveau',
                'query_builder' => function (EntityRepository $niv) {
                    return $niv->createQueryBuilder('u')
                        ->orderBy('u.nom', 'ASC');
                },
                'choice_label' => 'nom',
                'required' => false,
                'empty_data' =>null,
                'preferred_choices' => array(),
                'attr' => array('class' => 'form-control')
            ))
//            ->add('password', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('faculte', EntityType::class, array(
                'class' => 'InfoCampusBundle\Entity\Facultes',
                'query_builder' => function (EntityRepository $fac) {
                    return $fac->createQueryBuilder('u')
                        ->orderBy('u.nom', 'ASC');
                },
                'choice_label' => 'nom',
                'required' => false,
                'empty_data' =>null,
                'preferred_choices' => array(),
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
