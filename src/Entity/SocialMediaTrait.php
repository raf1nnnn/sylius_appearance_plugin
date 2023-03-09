<?php

declare(strict_types=1);

namespace Dotit\SyliusAppearancePlugin\Entity;

trait SocialMediaTrait
{
    protected ?Socialmediainterface $Store = null;

    public function getStore(): ?Socialmediainterface
    {
        return $this->Store;
    }

    public function setStore(?Socialmediainterface $Store): void
    {
        $this->Store = $Store;
    }
}
