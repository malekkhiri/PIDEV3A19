<?php

namespace MagasinBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MagasinType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom_magasin')
            ->add('region', ChoiceType::class, array(
                'choices'  => array(
                    'Choisir Region' => 'Choisir Region',
                    'Ariana' => 'Ariana', 'Béja' => 'Béja',
                    'Ben Arous' => 'Ben Arous', 'Bizerte' => 'Bizerte',
                    'Gabès' => 'Gabès', 'Gafsa' => 'Gafsa', 'Jendouba' => 'Jendouba',
                    'Kairouan' => 'Kairouan', 'Kasserine' => 'Kasserine',
                    'Kébili	' => 'Kébili', 'Le Kef	' => 'Le Kef',
                    'Mahdia	' => 'Mahdia', 'La Manouba	' => 'La Manouba',
                    'Médenine' => 'Médenine', 'Monastir' => 'Monastir',
                    'Nabeul' => 'Nabeul', 'Sfax	' => 'Sfax	', 'Sidi Bouzid	' => 'Sidi Bouzid	',
                    'Siliana	' => 'Siliana	', 'Sousse' => 'Sousse', 'Tataouine	' => 'Tataouine	',
                    'Tozeur	' => 'Tozeur', 'Tunis		' => 'Tunis		', 'Zaghouan' => 'Zaghouan',


                )            ))

            ->add('ville', ChoiceType::class, array(
                'choices'  => array(
                    'Choisir ville' => 'Choisir ville',
                    'Tunis' => 'Tunis',
                    'Le Bardo' => 'Le Bardo',
                    'La Manouba' => 'La Manouba',
                )))

            ->add('adresse_magasin')

        ;


    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MagasinBundle\Entity\Magasin'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'magasinbundle_magasin';
    }


}