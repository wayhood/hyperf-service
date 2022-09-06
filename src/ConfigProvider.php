<?php

declare(strict_types=1);

namespace Wayhood\Service;

use Wayhood\Service\Listener\BootListener;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'listeners' => [
                BootListener::class,
            ],
        ];
    }
}
