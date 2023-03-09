<?php

declare(strict_types=1);

namespace Dotit\SyliusAppearancePlugin\Entity;

use Doctrine\Common\Collections\Collection;
use Sylius\Component\Channel\Model\ChannelsAwareInterface;
use Sylius\Component\Product\Model\ProductInterface;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\SlugAwareInterface;
use Sylius\Component\Resource\Model\TimestampableInterface;
use Sylius\Component\Resource\Model\ToggleableInterface;
use Sylius\Component\Resource\Model\TranslatableInterface;
use Sylius\Component\Resource\Model\TranslationInterface;
use Symfony\Component\HttpFoundation\File\File;

interface SocialMediaInterface extends
    ResourceInterface,
    SlugAwareInterface,
    ToggleableInterface,
    TimestampableInterface

{
    public function getName(): ?string;

    public function setName(?string $name): void;



    public function setLogoFile(?File $file): void;

    public function getLogoFile(): ?File;

    public function setLogoName(?string $logoName): void;

    public function getLogoName(): ?string;


}
