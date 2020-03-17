<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use App\Entity\Parameter\PresentationText;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class PresentationTextType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('presentationText')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PresentationText::class,
        ]);
    }
}