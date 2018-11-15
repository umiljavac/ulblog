<?php
/**
 * Created by PhpStorm.
 * User: ulrich
 * Date: 31/10/2018
 * Time: 14:08
 */

namespace App\Form\Type;


use App\Entity\Techno;
use Symfony\Component\Form\AbstractType;
use App\Entity\Project;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TechnoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'technos', EntityType::class, array(
                'class' => Techno::class,
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
