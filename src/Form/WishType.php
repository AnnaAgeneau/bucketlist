<?php

namespace App\Form;

use App\Entity\Wish;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WishType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',null,[
                'label' => 'Titre de votre Souhait',
                'attr' => ['placeholder' => 'veuillez écrire votre titre'],
            ])

            ->add('description',null,[              
                'attr' => ['placeholder' => 'décrivez votre souhait' ],
            ])

            ->add('author',null,[
                'label' => 'Auteur',
                'attr' => ['placeholder' => 'veuillez écrire votre nom/pseudo' ], 
            ])

            ->add('isPublished',null,[
                'label' => 'Cocher pour publier',               
            ])
            ->add('dateCreated',null,[
                'label' => 'Date de création',               
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Wish::class,
        ]);
    }
}
