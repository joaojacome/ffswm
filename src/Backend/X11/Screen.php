<?php

declare(strict_types=1);

namespace FFSWM\Backend\X11;

class Screen
{
    public function __construct(
        public readonly Connection $connection,
        public readonly int $screen
    ) {
    }

}
