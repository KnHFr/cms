<?php

namespace App\Form\Parameter;

use App\Entity\Parameter\Head;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class HeadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', TextType::class, [
            'label' => 'Titre de l\'onglet du site'
        ]);
        $builder->add('headerPicture', TextType::class, [
            'label' => 'Image principale du site'
        ]);
        $builder->add('h1', TextType::class, [
            'label' => 'Titre principal du site'
        ]);
        $builder->add('presentationText', TextType::class, [
            'label' => 'Texte de présentation du site'
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Head::class,
        ]);
    }
}