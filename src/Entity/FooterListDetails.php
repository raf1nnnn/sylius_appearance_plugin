<?php

namespace Dotit\SyliusAppearancePlugin\Entity;

use Sylius\Component\Resource\Model\TimestampableTrait;
use Sylius\Component\Resource\Model\ToggleableTrait;

class FooterListDetails implements FooterListDetailsInterface
{
    use TimestampableTrait;
    use ToggleableTrait;

    protected ?int $id = null;
    protected ?string $name = null;
    protected ?string $slug = null;
    protected ?string $description = null;
    protected ?FooterListInterface $footerList = null;

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

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }
    public function setFooterList(?FooterListInterface $footerList)
    {
        $this->footerList = $footerList;
    }

    public function getFooterList():FooterListInterface{
        return $this->footerList;
    }

}