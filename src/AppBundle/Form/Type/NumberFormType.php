<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 21.09.17
 * Time: 20:20
 */

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NumberFormType extends AbstractType
{
//    public function buildForm(FormBuilderInterface $builder, array $options)
//    {
//        $builder
//            ->add('integer', IntegerType::class)
////            ->add('number', NumberType::class, [
////                'scale' => 3,
////                'attr' => [
////                    'step' => 0.001,
////                    'min' => 10,
////                    'max' => 20
////                ]
////            ])
//            ->add('number', NumberType::class)
//            ->add('float', FloatType::class)
//            ->add('save', SubmitType::class);
//
//    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('range', RangeType::class,[
                'attr' => [
                    'min' => 10,
                    'max' => 20,
                    'step' => 2,
                ]
            ])
            ->add('save', SubmitType::class);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Number',
            'csrf_protection' => false
        ]);
    }
}