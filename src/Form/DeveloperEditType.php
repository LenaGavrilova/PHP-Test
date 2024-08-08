<?php

namespace App\Form;

use App\Entity\Developer;
use App\Entity\Project;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DeveloperEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fullName', TextType::class, ['label' => 'Full name'])
            ->add('position', TextType::class, ['label' => 'Position'])
            ->add('project', EntityType::class, [
                'class' => Project::class,
                'choice_label' => 'name',
                'label' => 'Project',
                'placeholder' => 'Choose project',
            ])
            ->add('email', EmailType::class, ['label' => 'Email'])
            ->add('phoneNumber', TextType::class, ['label' => 'Phone'])
            ->add('birthday', DateType::class, [
                'label' => 'Birthdate',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ])
            ->add('skills', TextType::class, ['label' => 'Skills'])
            ->add('experienceYears', NumberType::class, ['label' => 'Experience years'])
            ->add('hireDate', DateType::class, [
                'label' => 'Hire date',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',])
            ->add('address', TextType::class, ['label' => 'Address'])
            ->add('salary', NumberType::class, ['label' => 'Salasy'])
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'hired' => 'hired',
                    'on vacation' => 'on vacation',
                    'in project' => 'in project',
                    'free' => 'free',
                    'fired' => 'fired',
                ],
                'label' => 'Status',
            ])
            ->add('notes', TextType::class, ['label' => 'Notes']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Developer::class,
        ]);
    }
}
