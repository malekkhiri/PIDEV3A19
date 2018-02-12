<?php

namespace ProjetBundle\Form;




use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;



class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {



        /*$builder->add('roles',ChoiceType::class , array(
            'choices' => array(

              'Admin'=> 'ROLE_ADMIN','form.roles', 'translation_domain' => 'FOSUserBundle',
                'Lecteur' => 'ROLE_SUPER_ADMIN','form.roles', 'translation_domain' => 'FOSUserBundle' ,

            'choices_as_values' => true,'multiple'=>false,'expanded'=>true)
        /*'required'    => false,
            'empty_value' => 'Choisir le role',
            'empty_data'  => null*/

        $builder
            ->add('roles', CollectionType::class, array(
                    'entry_type' => ChoiceType::class,
                    'entry_options' => array(
                        'choices' => array(
                           'Utilisateur' =>  'ROLE_UTILISATEUR',
                             'Vendeur' =>'ROLE_VENDEUR'
                        )
                    )
                )
            )
        ;

    }

    public function getParent()

    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix()

    {
        return 'app_user_registration';
    }

    public function getName()

    {
        return $this->getBlockPrefix();
    }
}