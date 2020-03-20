<?php

namespace App\Form\Parameter;

use App\Entity\Parameter\Foot;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class FootType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('contact', TextareaType::class, [
            'label' => 'Vos informations de Contact'
        ]);
        $builder->add('socialNetwork', TextType::class, [
            'label' => 'Votre lien de Réseau Social'
        ]);
        $builder->add('aboutUs', TextType::class, [
            'label' => 'À Propos du site'
        ]);
        $builder->add('aboutF', TextType::class, [
            'label' => 'À Propos du créateur du site'
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Foot::class,
        ]);
    }
}