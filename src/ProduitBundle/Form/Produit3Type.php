<?php

namespace ProduitBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Produit3Type extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('nomProduit')

            ->add('prix')->add('description')->add('quantite')
            ->add('brochure', FileType::class ,array('label' => 'image.jpg','data_class'=>null));
/*            ->add('Valider Modification',SubmitType::class);*/

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
