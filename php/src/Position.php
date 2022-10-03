<?php

declare(strict_types=1);

namespace Kata;

use RuntimeException;

final class Position
{
    public function __construct(
        private int $x,
        private int $y,
    ) {
        $this->assertPositionLimits();
    }

    private function assertPositionLimits(): void
    {
        if ($this->x < 0 || $this->x >= 3
            || $this->y < 0 || $this->y >= 3
        ) {
            throw new RuntimeException('Invalid position');
        }
    }

    public function __toString(): string
    {
        return sprintf('%d:%d', $this->x, $this->y);
    }
}
