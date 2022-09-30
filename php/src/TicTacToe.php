<?php

declare(strict_types = 1);

namespace Kata;

use RuntimeException;

final class TicTacToe
{
    public const PLAYER_X = 'X';
    public const PLAYER_O = 'O';

    private int $count = 1;
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

        $currentPlayer = $this->currentPlayer();

        if (isset($this->board[$posX][$posY])) {
            throw new RuntimeException('This position is occupied');
        }

        $this->board[$posX][$posY] = $currentPlayer;

        $this->changePlayer();

        return $currentPlayer;
    }

    private function currentPlayer(): string
    {
        return $this->count % 2 === 1 ? self::PLAYER_X : self::PLAYER_O;
    }

    private function changePlayer(): void
    {
        $this->count++;
    }
}
