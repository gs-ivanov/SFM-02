<?php

namespace ScpmBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
//        $builder
//            ->add('dutyId')
//            ->add('username')
//            ->add('password')
//            ->add('email')
//            ->add('shipName')
//            ->add('shipType')
//            ->add('roles');

        $builder
            ->add('dutyId',NumberType::class, array('label' => 'User ID * : '))
            ->add('username',TextType::class, array('label' => 'User Name * : '))
            ->add('position',TextType::class, array('label' => 'User Position * : '))
            ->add('password',PasswordType::class, array('label' => 'Password * : '))
            ->add('email',EmailType::class, array('label' => 'Email * : '))
            ->add('shipName',TextType::class, array('label' => 'Ship Name * : '))
            ->add('shipType',TextType::class, array('label' => 'Ship Type * : '))
            ->add('Register',SubmitType::class);

    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ScpmBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'scpmbundle_user';
    }


}
