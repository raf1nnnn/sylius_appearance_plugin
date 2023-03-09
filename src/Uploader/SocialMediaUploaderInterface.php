<?php

declare(strict_types=1);

namespace Dotit\SyliusAppearancePlugin\Uploader;

use Dotit\SyliusAppearancePlugin\Entity\Socialmediainterface;

interface SocialMediaUploaderInterface
{
    public function upload(Socialmediainterface $store): void;

    public function remove(string $path): bool;
}
