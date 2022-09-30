<?php

declare(strict_types=1);

namespace Kata;

use RuntimeException;

final class TicTacToeGame
{
    private string $currentPlayer = 'X';

    public function play(string $currentPlayer): bool
    {
        if ($currentPlayer !== $this->currentPlayer) {
            throw new RuntimeException('Invalid current Player');
        }

        return true;
    }
}
