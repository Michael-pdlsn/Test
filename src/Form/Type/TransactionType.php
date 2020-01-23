<?php


namespace App\Form\Type;

use App\Entity\Transaction;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class TransactionType
 * @package App\Form\Type
 */
class TransactionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('refererUrl', HiddenType::class)
            ->add('callBackUrl', HiddenType::class)
            ->add('cardNumber', TextType::class, ['label' => 'Card Number'])
            ->add('cardCvv', TextType::class, ['label' => 'CVV'])
            ->add('cardHolder', TextType::class, ['label' => 'Card Holder'])
            ->add('send', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Transaction::class,
        ]);
    }

}