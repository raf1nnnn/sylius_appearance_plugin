<?php

declare(strict_types=1);

namespace Dotit\SyliusAppearancePlugin\Uploader;

use Gaufrette\FilesystemInterface;
use Dotit\SyliusAppearancePlugin\Entity\SocialMediaInterface;
use Symfony\Component\HttpFoundation\File\File;

final class SocialMediaUploader implements SocialMediaUploaderInterface
{
    private FilesystemInterface $filesystem;

    public function __construct(
        FilesystemInterface $filesystem
    )
    {
        $this->filesystem = $filesystem;
    }

    public function upload(SocialMediaInterface $socialMedia): void
    {
        if ($socialMedia->getLogoFile() === null) {
            return;
        }

        /** @var File $file */
        $file = $socialMedia->getLogoFile();

        if (null !== $socialMedia->getLogoName() && $this->has($socialMedia->getLogoName())) {
            $this->remove($socialMedia->getLogoName());
        }

//        do {
//            $path = $this->name($file);
//        } while ($this->isAdBlockingProne($path) || $this->filesystem->has($path));
        $path = $this->name($file);

        $socialMedia->setLogoName($path);

        if ($socialMedia->getLogoName() === null) {
            return;
        }

        if (file_get_contents($file->getPathname()) === false) {
            return;
        }

        $this->filesystem->write(
            $socialMedia->getLogoName(),
            file_get_contents($file->getPathname()),
            true
        );
    }

    public function remove(string $path): bool
    {
        if ($this->filesystem->has($path)) {
            return $this->filesystem->delete($path);
        }

        return false;
    }

    private function has(string $path): bool
    {
        return $this->filesystem->has($path);
    }

    private function name(File $file): string
    {
        $name = \str_replace('.', '', \uniqid('', true));
        $extension = $file->guessExtension();

        if (\is_string($extension) && '' !== $extension) {
            $name = \sprintf('%s.%s', $name, $extension);
        }

        return $name;
    }

    private function isAdBlockingProne(string $path): bool
    {
        return strpos($path, 'ad') !== false;
    }
}
