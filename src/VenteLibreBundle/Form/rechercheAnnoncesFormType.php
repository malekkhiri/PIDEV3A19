<?php
/**
 * Created by PhpStorm.
 * User: oussama
 * Date: 12/02/2018
 * Time: 22:13
 */

namespace VenteLibreBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class rechercheAnnoncesFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('titre')
            ->add('Valider', SubmitType::class);
    }
    public function configureOptions(OptionsResolver $resolver)
    {
    }

    public function getName()
    {
        return 'ventelibrebundle_recherche_modele_form';
    }



}