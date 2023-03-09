<?php

declare(strict_types=1);

namespace Dotit\SyliusAppearancePlugin;

use Sylius\Bundle\CoreBundle\Application\SyliusPluginTrait;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class DotitSyliusAppearancePlugin extends Bundle
{
    use SyliusPluginTrait;
}
