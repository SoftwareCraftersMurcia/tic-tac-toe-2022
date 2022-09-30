<?php declare(strict_types=1);

namespace Kata;

final class TicTacToe
{
    private int $count = 0;

    /**
     * Plays the current player in the position coordinates
     * and return the player's name.
     */
    public function play(int $posX, int $posY): string
    {
        $this->count++;

        return $this->count % 2 === 1 ? 'X' : 'O';
    }
}
