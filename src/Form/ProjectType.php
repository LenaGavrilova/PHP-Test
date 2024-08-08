<?php

namespace App\Form;

use App\Entity\Project;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,[
                'required' => true,
            ])
            ->add('client', TextType::class,[
                'required' => true,
            ])
            ->add('startDate', DateType::class, [
                'widget' => 'single_text',
                    'required' => true,
            ])
            ->add('endDate', DateType::class, [
                'widget' => 'single_text',
                'required' => true,
            ])
            ->add('budget', NumberType::class,[
                'required' => true,
            ])
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'in progress' => 'in progress',
                    'comleted' => 'completed',
                    'on start' => 'on start',
                    'on finish' => 'on finish'
                ]
            ])
            ->add('description', TextType::class, [
                'required' => true,
            ])
            ->add('projectManager', TextType::class, [
                'required' => true,
            ])
            ->add('documents', TextType::class, [
                'required' => true,
            ])
            ->add('priority', TextType::class, [
                'required' => true,
            ])
            ->add('technologies', TextType::class, [
                'required' => true,
            ])
            ->add('notes', TextType::class, [
                'required' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
