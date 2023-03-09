<?php

declare(strict_types=1);

namespace Dotit\SyliusAppearancePlugin\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Channel\Model\ChannelInterface;
use Sylius\Component\Product\Model\ProductInterface;
use Sylius\Component\Resource\Model\TimestampableTrait;
use Sylius\Component\Resource\Model\ToggleableTrait;
use Sylius\Component\Resource\Model\TranslatableTrait;
use Sylius\Component\Resource\Model\TranslationInterface;
use Symfony\Component\HttpFoundation\File\File;

class SocialMedia implements SocialMediaInterface
{

    use TimestampableTrait;
    use ToggleableTrait;

    protected ?int $id = null;
    protected ?string $name = null;
    protected ?string $slug = null;
    protected ?string $url = null;
    protected ?File $logoFile = null;
    protected ?string $logoName = null;
    protected ?string $logoPath = null;



    public function __construct()
    {

        $this->createdAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug = null): void
    {
        $this->slug = $slug;
    }



    public function setLogoFile(?File $file): void
    {
        $this->logoFile = $file;

        $this->setUpdatedAt(new \DateTime());
    }

    public function getLogoFile(): ?File
    {
        return $this->logoFile;
    }

    public function setLogoName(?string $logoName): void
    {
        $this->logoName = $logoName;
    }

    public function getLogoName(): ?string
    {
        return $this->logoName;
    }



    public function getLogoPath(): string
    {
        return '/media/social-media-logo/' . $this->logoName;
    }


    public function getUrl(): ?string
    {
        return $this->url;
    }



    public function setUrl(?string $url): void
    {
        $this->url = $url;
    }
}
