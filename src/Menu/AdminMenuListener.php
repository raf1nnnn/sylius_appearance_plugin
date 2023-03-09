<?php

namespace Dotit\SyliusAppearancePlugin\Menu;
use Knp\Menu\ItemInterface;
use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;

final class AdminMenuListener
{
    public function addAdminMenuItems(MenuBuilderEvent $event): void
    {
        $menu = $event->getMenu();

        /** @var ItemInterface $item */
        $item = $menu->getChild('configuration');
        if (null == $item) {
            $item = $menu;
        }
        $item->addChild('Social Media', ['route' => 'dotit_sylius_appearance_plugin_admin_social_media_index'])
            ->setLabel('dotit_sylius_appearance_plugin.menu.admin.social_media')
            ->setLabelAttribute('icon', 'star')
        ;
        $item->addChild('Footer List', ['route' => 'dotit_sylius_appearance_plugin_admin_footer_list_index'])
            ->setLabel('dotit_sylius_appearance_plugin.menu.admin.footer_list')
            ->setLabelAttribute('icon', 'edit outline')
        ;
    }
}