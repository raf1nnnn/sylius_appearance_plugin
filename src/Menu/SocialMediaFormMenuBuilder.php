<?php

declare(strict_types=1);

namespace Dotit\SyliusAppearancePlugin\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Dotit\SyliusAppearancePlugin\Entity\Socialmediainterface;
use Dotit\SyliusAppearancePlugin\Event\StoreFormMenuBuilderEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

final class SocialMediaFormMenuBuilder
{
    private FactoryInterface $factory;
    private EventDispatcherInterface $eventDispatcher;

    public function __construct(FactoryInterface $factory, EventDispatcherInterface $eventDispatcher)
    {
        $this->factory = $factory;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function createMenu(array $options = []): ItemInterface
    {
        $menu = $this->factory->createItem('root');

        if (!array_key_exists('social_media', $options) || !$options['social_media'] instanceof Socialmediainterface) {
            return $menu;
        }
        $menu
            ->addChild('details')
            ->setAttribute('template', '@DotitSyliusAppearancePlugin/Admin/social_media/Tab/_details.html.twig')
            ->setLabel('sylius.ui.details')
            ->setCurrent(true)
        ;

        $menu
            ->addChild('media')
            ->setAttribute('template', '@DotitSyliusAppearancePlugin/Admin/social_media/Tab/_media.html.twig')
            ->setLabel('sylius.ui.media')
        ;

        $this->eventDispatcher->dispatch(
            new StoreFormMenuBuilderEvent($this->factory, $menu, $options['social_media'])
        );


        return $menu;
    }
}
