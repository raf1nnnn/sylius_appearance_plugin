<?php

declare(strict_types=1);

namespace Dotit\SyliusAppearancePlugin\Serializer;

use Dotit\SyliusAppearancePlugin\Entity\FooterListInterface;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Webmozart\Assert\Assert;

final class FooterListNormalizer implements ContextAwareNormalizerInterface, NormalizerAwareInterface
{
    private NormalizerInterface $normalizer;

    public function __construct(NormalizerInterface $normalizer)
    {
        $this->normalizer = $normalizer;
    }

    private const ALREADY_CALLED = 'footer_list_normalizer_already_called';

    public function normalize($object, $format = null, array $context = [])
    {
        Assert::isInstanceOf($object, FooterListInterface::class);
        Assert::keyNotExists($context, self::ALREADY_CALLED);

        $context[self::ALREADY_CALLED] = true;

        $data = $this->normalizer->normalize($object, $format, $context);

         foreach ($data['footerListDetails'] as $key => $value) {
            if (!$value['enabled']) {
                    unset($data['footerListDetails'][$key]);
            }
        }
        
        $data['footerListDetails'] = array_values($data['footerListDetails']);

        return $data;
    }

    public function supportsNormalization($data, $format = null, $context = []): bool
    {
        if (isset($context[self::ALREADY_CALLED])) {
            return false;
        }

        return $data instanceof FooterListInterface;
    }

    /**
     * @param NormalizerInterface $normalizer
     */
    public function setNormalizer(NormalizerInterface $normalizer): void
    {
        $this->normalizer = $normalizer;
    }
}
