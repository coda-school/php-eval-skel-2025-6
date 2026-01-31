<?php

namespace App\Form;

use App\Entity\Ver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class VerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('content', TextareaType::class, [
                'label' => false, // On cache le label pour un look plus "réseau social"
                'attr' => [
                    'placeholder' => "Ecrit ton Ver",
                    'class' => 'form-control', // Classe CSS (Bootstrap ou autre)
                    'rows' => 3
                ],
                'constraints' => [
                    new NotBlank(['message' => 'Un ver ne peut pas être vide !']),
                    new Length([
                        'max' => 280,
                        'maxMessage' => 'Votre ver est trop long (max {{ limit }} caractères).'
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ver::class,
        ]);
    }
}
