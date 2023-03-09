<?php

namespace Dotit\SyliusAppearancePlugin\Form\Type;

use Dotit\SyliusAppearancePlugin\Entity\FooterList;
use Dotit\SyliusAppearancePlugin\Entity\FooterListDetailsInterface;
use Dotit\SyliusAppearancePlugin\Entity\FooterListInterface;
use Dotit\SyliusAppearancePlugin\Entity\SocialMedia;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;

use Odiseo\SyliusVendorPlugin\Entity\VendorInterface;
use Sylius\Bundle\ChannelBundle\Form\Type\ChannelChoiceType;
use Sylius\Bundle\ResourceBundle\Form\Type\ResourceTranslationsType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FooterListType extends AbstractResourceType
{
    public function __construct()
    {
        parent::__construct(FooterList::class);
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('name', TextType::class, [
                'label' => 'sylius.ui.name',
            ])
            ->add('slug', TextType::class, [
                'label' => 'sylius.ui.slug',
            ])
            ->add('description', TextType::class, [
                'label' => 'sylius.ui.description',
            ])
            ->add('enabled', CheckboxType::class, [
                'label' => 'sylius.ui.enabled',
            ])
            ->add('footerListDetails', CollectionType::class, [
                'label' => 'dotit_sylius_appearance_plugin.form.footer_list.footer_list_details',
                'entry_type' => FooterListDetailsType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'required' => false,
            ]);
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults([
            'validation_groups' => function (FormInterface $form): array {
                /** @var FooterListInterface|null $socialMedia */
                $socialMedia = $form->getData();
                if ($socialMedia instanceof FooterListInterface || null === $socialMedia->getId()) {
                    $this->validationGroups= array_merge($this->validationGroups, ['dotit_logo_create']);
                    $this->validationGroups= array_merge($this->validationGroups, ['dotit_list_create']);
                    return $this->validationGroups;
                }
                return $this->validationGroups;
            },
        ]);
    }

    public function getBlockPrefix(): string
    {
        return 'dotit_footer';
    }

}