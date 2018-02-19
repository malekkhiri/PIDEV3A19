<?php
/**
 * Created by PhpStorm.
 * User: Hosni
 * Date: 12/02/2018
 * Time: 22:20
 */

namespace MagasinBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RechercheMagasin extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id_magasin')->add('Recherche',SubmitType::class)
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
    public function getName()
    {
        return 'magasinbundle_magasin';
    }
}







