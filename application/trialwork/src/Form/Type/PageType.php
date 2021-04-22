<?php
namespace App\Form\Type;

use App\Entity\Page;
use App\Entity\Portal;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Contracts\Translation\TranslatorInterface;

class PageType extends AbstractType
{
    public $translator;

    /**
     * Autowire the translator service
     */
    public function __construct(TranslatorInterface  $translator)
    {
        $this->translator = $translator;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('portal', EntityType::class, [
                'class' => Portal::class
            ])
            ->add('content',TextareaType::class, [])
            ->add('save', SubmitType::class, [
                'label' => $this->translator->trans('forms.portal.buttonCreate')
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Page::class,
        ]);

    }
}