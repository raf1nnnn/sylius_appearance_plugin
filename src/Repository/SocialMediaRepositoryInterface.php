<?php

declare(strict_types=1);

namespace Dotit\SyliusAppearancePlugin\Repository;

use Doctrine\ORM\QueryBuilder;
use Dotit\SyliusAppearancePlugin\Entity\Socialmediainterface;
use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;

interface SocialMediaRepositoryInterface extends RepositoryInterface
{
    public function createShopListQueryBuilder(
        ChannelInterface $channel,
        array $sorting = []
    ): QueryBuilder;

    public function findByEnabledQueryBuilder(?ChannelInterface $channel): QueryBuilder;

    public function findByChannel(ChannelInterface $channel): array;

    public function findOneBySlug(string $slug, string $locale): ?Socialmediainterface;
}
