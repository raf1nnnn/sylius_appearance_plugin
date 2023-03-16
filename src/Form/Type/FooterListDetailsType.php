<?php

namespace Dotit\SyliusAppearancePlugin\Form\Type;

use Dotit\SyliusAppearancePlugin\Entity\FooterListDetails;
use Dotit\SyliusAppearancePlugin\Entity\FooterListDetailsInterface;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormError;

class FooterListDetailsType extends AbstractResourceType
{
    public function __construct()
    {
        parent::__construct(FooterListDetails::class);
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('enabled', CheckboxType::class, [
                'label' => 'sylius.ui.enabled',
            ])
            ->add('name', TextType::class, [
                'label' => 'sylius.ui.name',
            ])
            ->add('url', TextType::class, [
                'label' => 'dotit_sylius_appearance_plugin.form.footer_list.url',
            ])
            ->add('slug', TextType::class, [
                'label' => 'sylius.ui.slug',
            ]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults([
            'validation_groups' => function (FormInterface $form): array {
                /** @var FooterListDetailsInterface|null $socialMedia */
                $socialMedia = $form->getData();
                if ($socialMedia) {
                    $footerList = $socialMedia->getFooterList();

                    $slugs = array();
                    $names = array();
                    foreach ($footerList->getFooterListDetails() as $detail) {
                        if (in_array($detail->getSlug(), $slugs)) {
                            $form->get('slug')->addError(new FormError('The slug is duplicated.'));
                        }
                        if (in_array($detail->getName(), $names)) {
                            $form->get('name')->addError(new FormError('The name is duplicated.'));
                        }
                        if($detail->getUrl()== null){
                            $form->get('url')->addError(new FormError('The Url cannot be empty.'));

                        }
                        $slugs[] = $detail->getSlug();
                        $names[] = $detail->getName();
                    }
                }
                if (!$socialMedia instanceof FooterListDetailsInterface || null === $socialMedia->getId()) {
                    return array_merge($this->validationGroups, ['dotit_list_create']);
                }
                return $this->validationGroups;
            },
        ]);
    }

    public function getBlockPrefix(): string
    {
        return 'dotit_footer_detail';
    }
}