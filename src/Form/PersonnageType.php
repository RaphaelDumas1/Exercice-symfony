<?php

namespace App\Form;

use App\Entity\Type;
use App\Entity\Personnage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class PersonnageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('date_naissance')
            ->add('description')
            ->add('niveau')
            ->add('experience')
            ->add('endurance')
            ->add('intelligence')
            ->add('agilite')
            ->add('vie')
            ->add(
                'type',
                EntityType::class,
                array(
                    'class' => Type::class,
                    'choice_label' => 'nom',
                )
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Personnage::class,
        ]);
    }
}
