<?php

declare(strict_types=1);

namespace Dotit\SyliusAppearancePlugin\Form\Type;

use Dotit\SyliusAppearancePlugin\Entity\SocialMedia;
use Dotit\SyliusAppearancePlugin\Entity\SocialMediaInterface;
use Odiseo\SyliusVendorPlugin\Entity\VendorInterface;
use Sylius\Bundle\ChannelBundle\Form\Type\ChannelChoiceType;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Sylius\Bundle\ResourceBundle\Form\Type\ResourceTranslationsType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class SocialMediaType extends AbstractResourceType
{
    public function __construct()
    {
        parent::__construct(SocialMedia::class);
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('name', TextType::class, [
                'label' => 'sylius.ui.name',
            ])
            ->add('slug', TextType::class, [
                'label' => 'dotit_sylius_appearance_plugin.form.store.slug',
            ])
            ->add('url', TextType::class, [
                'label' => 'dotit_sylius_appearance_plugin.form.store.url',
            ])
            ->add('enabled', CheckboxType::class, [
                'label' => 'sylius.ui.enabled',
            ])

            ->add('logoFile', FileType::class, [
                'label' => 'dotit_sylius_appearance_plugin.form.store.logo',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults([
            'validation_groups' => function (FormInterface $form): array {
                /** @var SocialMediaInterface|null $socialMedia */
                $socialMedia = $form->getData();
                if (!$socialMedia instanceof SocialMediaInterface || null === $socialMedia->getId()) {

                    return array_merge($this->validationGroups, ['dotit_logo_create']);
                }
                return $this->validationGroups;
            },
        ]);
    }

    public function getBlockPrefix(): string
    {
        return 'dotit_social_media';
    }
}
