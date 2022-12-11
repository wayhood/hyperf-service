<?php

declare(strict_types=1);

namespace Wayhood\Service\Annotation;

use Attribute;
use Hyperf\Di\Annotation\AbstractAnnotation;

#[Attribute(Attribute::TARGET_CLASS)]
class Service extends AbstractAnnotation
{
    public int $order = 0;

    public function __construct(
        ?int $order = null
    ) {
        if (is_null($order)) {
            $this->order = 0;
        } else {
            $this->order = intval($order);
        }
    }
}
