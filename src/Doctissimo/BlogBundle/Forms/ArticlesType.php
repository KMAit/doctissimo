<?php

/**
 * Created by PhpStorm.
 * User: Kamel
 * Date: 02/06/2019
 * Time: 18:40
 */

namespace Doctissimo\BlogBundle\Forms;

use Doctissimo\BlogBundle\Entity\Articles;
use Doctissimo\BlogBundle\Forms\Models\ArticlesModels;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticlesType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                    'required' => true,
                    'label' => "Titre de l'article",
                    'attr' => ["class" => "form-control mb-3"]
                ]
            )
            ->add('description', TextareaType::class, [
                    'required' => false,
                    'label' => "Déscription de l'article",
                    'attr' => ["class" => "form-control mb-3 resize-none"]
                ]
            )
            ->add("save", SubmitType::class,[
                'label' => "Ajouter un article",
                "attr" => ["class" => "btn btn-primary"]
            ]);

    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ArticlesModels::class
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return null;
    }
}