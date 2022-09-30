<?php

declare(strict_types = 1);

namespace Kata;

use RuntimeException;

final class TicTacToe
{
    private int $count = 0;

    /**
     * Plays the current player in the position coordinates
     * and return the player's name.
     */
    public function play(int $posX, int $posY): string
    {
        if ($posX < 0 || $posX > 2 || $posY < 0 || $posY > 2) {
            throw new RuntimeException('Out of board limits');
        }

        $this->count++;

        return $this->count % 2 === 1 ? 'X' : 'O';
    }
}
