<?php

namespace App\Form;
use SebastianBergmann\CodeCoverage\Report\Text;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use App\Entity\Draw;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;

class DrawFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('post', FileType::class,[
                'required' => false,
                'mapped' => false,
                'constraints' => [
                            new Image(['maxSize' => '1024k'])
                        ],
                    ])
            ->add('name',null,[
            'label' =>'your name'])
            ->add('description')
            ->add('Submit', SubmitType::class

            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Draw::class,
        ])

        ;
    }

}
