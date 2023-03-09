<?php

namespace Dotit\SyliusAppearancePlugin\Event;

use Dotit\SyliusAppearancePlugin\Entity\Socialmediainterface;
use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;
class StoreFormMenuBuilderEvent extends MenuBuilderEvent
{
    private Socialmediainterface $socialMedia;

    public function __construct(FactoryInterface $factory, ItemInterface $menu, Socialmediainterface $socialMedia)
    {
        parent::__construct($factory, $menu);

        $this->socialMedia = $socialMedia;
    }

    public function getStore(): Socialmediainterface
    {
        return $this->socialMedia;
    }
}