<?php

namespace App\Form\Parameter;

use App\Entity\Parameter\Head;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class HeadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title');
        $builder->add('headerPicture');
        $builder->add('h1');
        $builder->add('presentationText');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Head::class,
        ]);
    }
}