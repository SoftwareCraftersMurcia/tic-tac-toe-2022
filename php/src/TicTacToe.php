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
        $this->checkConstraints($posX, $posY);

        $currentPlayer = $this->currentPlayer();
        $this->board[$posX][$posY] = $currentPlayer;
        $this->checkWinner();
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

    private function checkConstraints(int $posX, int $posY): void
    {
        $this->checkBoundaries($posX, $posY);
        $this->checkFreePosition($posX, $posY);
    }

    private function checkBoundaries(int $posX, int $posY): void
    {
        if ($posX < 0 || $posX > 2 || $posY < 0 || $posY > 2) {
            throw new RuntimeException('Out of board limits');
        }
    }

    private function checkFreePosition(int $posX, int $posY): void
    {
        if (isset($this->board[$posX][$posY])) {
            throw new RuntimeException('This position is occupied');
        }
    }

    private function checkWinner(): void
    {
        if ($this->count > 4) {
            throw new RuntimeException('X is the winner');
        }
    }
}
