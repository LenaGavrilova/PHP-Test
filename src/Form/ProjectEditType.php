<?php

namespace App\Form;

use App\Entity\Project;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, ['label' => 'Name'])
            ->add('client', TextType::class, ['label' => 'Client'])
            ->add('developers', EntityType::class, [
                'class' => 'App\Entity\Developer',
                'choice_label' => 'fullName',
                'label' => 'Команда разработчиков',
                'multiple' => true,
                'expanded' => false,
            ]) ->add('startDate', DateType::class, [
                'label' => 'Start date',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ])
            ->add('endDate', DateType::class, [
                'label' => 'End date',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ])
            ->add('budget', NumberType::class)
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'in progress' => 'in progress',
                    'comleted' => 'completed',
                    'on start' => 'on start',
                    'on finish' => 'on finish'
                ],
                'label' => 'Status',
            ])
            ->add('description', TextType::class)
            ->add('projectManager', TextType::class)
            ->add('documents', TextType::class)
            ->add('priority', TextType::class)
            ->add('technologies', TextType::class)
            ->add('notes', TextType::class);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
