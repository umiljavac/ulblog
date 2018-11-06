<?php
/**
 * Created by PhpStorm.
 * User: ulrich
 * Date: 31/10/2018
 * Time: 13:48
 */

namespace App\Form\Type;

use App\Entity\Category;
use App\Entity\Project;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'category', EntityType::class, array(
                'class' => Category::class,
                'choice_label' => 'name'
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