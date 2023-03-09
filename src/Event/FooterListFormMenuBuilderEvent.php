<?php

namespace Dotit\SyliusAppearancePlugin\Event;

use Dotit\SyliusAppearancePlugin\Entity\FooterListInterface;
use Dotit\SyliusAppearancePlugin\Entity\Socialmediainterface;
use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;
class FooterListFormMenuBuilderEvent extends MenuBuilderEvent
{
    private FooterListInterface $socialMedia;

    public function __construct(FactoryInterface $factory, ItemInterface $menu, FooterListInterface $socialMedia)
    {
        parent::__construct($factory, $menu);

        $this->socialMedia = $socialMedia;
    }

    public function getStore(): FooterListInterface
    {
        return $this->socialMedia;
    }
}