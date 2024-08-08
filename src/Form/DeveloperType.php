<?php

namespace App\Form;

use App\Entity\Developer;
use App\Entity\Project;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use function Symfony\Component\Translation\t;

class DeveloperType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fullName', TextType::class)
            ->add('position', TextType::class)
            ->add('email', EmailType::class)
            ->add('phoneNumber', TelType::class)
            ->add('project', EntityType::class, [
                'class' => Project::class,
                'choice_label' => 'name',
                'required' => false,
            ])
            ->add('birthday', DateType::class, [
                'widget' => 'single_text',
                'required' => true,
            ])
            ->add('skills', TextType::class, [
                'required' => true,
            ])
            ->add('experienceYears', NumberType::class, [
                'required' => true,
            ])
            ->add('hireDate', DateType::class, [
                'widget' => 'single_text',
                'required' => true,
            ])
            ->add('salary', TextType::class, [
                'required' => true,
            ])
           ->add('status', ChoiceType::class, [
               'choices' => [
                   'hired' => 'hired',
                   'on vacation' => 'on vacation',
                   'in project' => 'in project',
                   'free' => 'free',
                   'fired' => 'fired',
               ]
           ])
            ->add('address', TextType::class, [
                'required' => true,
            ])
            ->add('notes', TextType::class, [
                'required' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Developer::class,
        ]);
    }
}
