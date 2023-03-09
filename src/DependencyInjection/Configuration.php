<?php

declare(strict_types=1);

namespace Dotit\SyliusAppearancePlugin\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('dotit_sylius_appearance_plugin');

        $treeBuilder->getRootNode();

        return $treeBuilder;
    }
}
