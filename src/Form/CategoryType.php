<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', null, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Titre de la catégorie',
                'label_attr' => ['class' => 'form-label'],
            ])
            ->add('color', ColorType::class, [
                'attr' => ['class' => 'form-control form-control-color'],
                'label' => 'Couleur',
                'label_attr' => ['class' => 'form-label'],
            ])
            ->add('enregistrer', SubmitType::class, [
                'attr' => ['class' => 'btn btn-success mt-3'],
                'label' => 'Enregistrer',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}
