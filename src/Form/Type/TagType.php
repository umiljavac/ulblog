<?php
/**
 * Created by PhpStorm.
 * User: ulrich
 * Date: 31/10/2018
 * Time: 13:59
 */

namespace App\Form\Type;

use App\Entity\Project;
use App\Entity\Tag;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TagType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'tags', EntityType::class, array(
                'class' => Tag::class,
                'choice_label' => 'name',
                'expanded' => true,
                'multiple' => true
            )
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Project::class
        ));
    }
}