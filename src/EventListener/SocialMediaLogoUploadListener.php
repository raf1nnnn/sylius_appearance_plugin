<?php

namespace Dotit\SyliusAppearancePlugin\EventListener;

use Dotit\SyliusAppearancePlugin\Entity\SocialMediaInterface;
use Dotit\SyliusAppearancePlugin\Uploader\SocialMediaUploaderInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Webmozart\Assert\Assert;



final class SocialMediaLogoUploadListener
{
    private SocialMediaUploaderInterface $uploader;

    public function __construct(SocialMediaUploaderInterface $uploader)
    {
        $this->uploader = $uploader;
    }

    public function uploadLogo(GenericEvent $event): void
    {
        $store = $event->getSubject();
        Assert::isInstanceOf($store, SocialMediaInterface::class);

        $this->uploader->upload($store);
    }
}