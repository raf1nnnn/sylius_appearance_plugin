<?php

namespace Dotit\SyliusAppearancePlugin\Entity;

use Sylius\Component\Resource\Model\TimestampableTrait;
use Sylius\Component\Resource\Model\ToggleableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
class FooterList implements FooterListInterface
{
    use TimestampableTrait;
    use ToggleableTrait;


    protected ?int $id = null;
    protected ?string $name = null;
    protected ?string $slug = null;
    protected ?string $description = null;
    /**
     * @psalm-var Collection<array-key, FooterListDetailsInterface>
     */
    protected Collection $footerListDetails;
    public function __construct()
    {

        $this->createdAt = new \DateTime();
        $this->footerListDetails = new ArrayCollection();

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

    public function getFooterListDetails(): Collection
    {
        return $this->footerListDetails;
    }

    public function hasFooterListDetail(FooterListDetailsInterface $footerListDetail): bool
    {
        return $this->footerListDetails->contains($footerListDetail);
    }

    public function addFooterListDetail(FooterListDetailsInterface $footerListDetail): void
    {
        if (!$this->hasFooterListDetail($footerListDetail)) {
            $this->footerListDetails->add($footerListDetail);
            $footerListDetail->setFooterList($this);
        }
    }

    public function removeFooterListDetail(FooterListDetailsInterface $footerListDetail): void
    {
        if ($this->hasFooterListDetail($footerListDetail)) {
            $this->footerListDetails->removeElement($footerListDetail);
            $footerListDetail->setFooterList(null);
        }
    }
}