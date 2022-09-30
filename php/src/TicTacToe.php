<?php

declare(strict_types = 1);

namespace Kata;

use RuntimeException;

final class TicTacToe
{
    private int $count = 0;
    private array $board = [];

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

        $currentPlayer = $this->count % 2 === 1 ? 'X' : 'O';

        if (isset($this->board[$posX][$posY])) {
            throw new RuntimeException('This position is occupied');
        }

        $this->board[$posX][$posY] = $currentPlayer;

        return $currentPlayer;
    }
}
