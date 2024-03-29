<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Videos;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class AddTrickType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', null, [
                'required' => true
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'title'
            ])
            ->add('content')
            ->add('videos', CollectionType::class, [
                'entry_type' => VideosType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false
            ])
            ->add('featured_img',
                FileType::class, [
                    'label' => false,
                    'mapped' => false,
                    'required' => false
                ])
            ->add('image',
                FileType::class, [
                'label' => false,
                'multiple' => true,
                'mapped' => false,
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
