<?php
/**
 * Created by PhpStorm.
 * User: ulrich
 * Date: 31/10/2018
 * Time: 13:28
 */

namespace App\Form\Type;


use App\Entity\Image;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
            'imageFile', VichImageType::class, array(
                'by_reference' => false,
                'allow_delete' => false
                )
             )
            ->add('alt', TextType::class)
            ->add('description', TextType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Image::class
        ));
    }
}