<?php

declare(strict_types=1);

namespace Dotit\SyliusAppearancePlugin\Menu;

use Dotit\SyliusAppearancePlugin\Entity\FooterListInterface;
use Dotit\SyliusAppearancePlugin\Event\FooterListFormMenuBuilderEvent;
use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Dotit\SyliusAppearancePlugin\Entity\Socialmediainterface;
use Dotit\SyliusAppearancePlugin\Event\StoreFormMenuBuilderEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

final class FooterListFormMenuBuilder
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
        if (!array_key_exists('footer_list', $options) || !$options['footer_list'] instanceof FooterListInterface) {

            return $menu;
        }
        $menu
            ->addChild('details')
            ->setAttribute('template', '@DotitSyliusAppearancePlugin/Admin/footer_list/Tab/_details.html.twig')
            ->setLabel('sylius.ui.details')
            ->setCurrent(true)
        ;

       

        $this->eventDispatcher->dispatch(
            new FooterListFormMenuBuilderEvent($this->factory, $menu, $options['footer_list'])
        );

        return $menu;
    }
}
