<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 15/02/2018
 * Time: 01:19
 */

namespace ProduitBundle\Form;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Produit2Type extends AbstractType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('brochure', FileType::class, array('label' => 'image.jpg','data_class' => null));
    }/**
 * {@inheritdoc}
 */
    public function configureOptions(OptionsResolver $resolver )
    {
        $resolver->setDefaults(array(
            'data_class' => 'ProduitBundle\Entity\Produit',

        ));

    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'produitbundle_produit';
    }

}