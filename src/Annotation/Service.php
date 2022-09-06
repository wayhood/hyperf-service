<?php

declare(strict_types=1);

namespace Wayhood\Service\Annotation;

use Attribute;
use Hyperf\Di\Annotation\AbstractAnnotation;

#[Attribute(Attribute::TARGET_CLASS)]
class Service extends AbstractAnnotation
{
    public function __construct(
    ) {
    }
}
