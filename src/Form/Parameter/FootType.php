<?php

namespace App\Form\Parameter;

use App\Entity\Parameter\Foot;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class FootType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('contact');
        $builder->add('socialNetwork');
        $builder->add('aboutUs');
        $builder->add('aboutF');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Foot::class,
        ]);
    }
}