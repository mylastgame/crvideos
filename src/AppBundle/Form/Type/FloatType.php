<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 23.09.17
 * Time: 18:34
 */

namespace AppBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FloatType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'scale' => 3,
            'attr' => [
                'step' => 0.3,
                'min' => 10,
                'max' => 20
            ]
        ]);
    }

    public function getParent()
    {
        return NumberType::class;
    }
}