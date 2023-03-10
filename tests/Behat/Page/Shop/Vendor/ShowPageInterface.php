<?php

declare(strict_types=1);

namespace Tests\Dotit\SyliusStorePlugin\Behat\Page\Shop\Vendor;

use FriendsOfBehat\PageObjectExtension\Page\SymfonyPageInterface;

interface ShowPageInterface extends SymfonyPageInterface
{
    /**
     * @param string $name
     * @return bool
     * @throws \Behat\Mink\Exception\ElementNotFoundException
     */
    public function hasName(string $name): bool;
}
