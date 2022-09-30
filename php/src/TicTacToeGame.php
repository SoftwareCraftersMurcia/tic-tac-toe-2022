<?php

declare(strict_types=1);

namespace Kata;

use RuntimeException;

final class TicTacToeGame
{
    // Board representation:
    // $board = [
    //     'X' => [[1, 1], [0, 0]],
    //     'O' => [[1, 0]],
    // ];
    private array $board = ['X' => [], 'O' => []];

    private string $currentPlayer = 'X';

    public function play(string $currentPlayer, Position $selectedPosition): bool
    {
        $this->checkCurrentPlayer($currentPlayer);
        $this->checkPositionIsAvailable($selectedPosition);
        $this->board[$currentPlayer][] = $selectedPosition;

        // check current status & assert there is some winner...

        $this->switchCurrentPlayer();

        return true;
    }

    private function switchCurrentPlayer(): void
    {
        $this->currentPlayer = ($this->currentPlayer === 'X') ? 'O' : 'X';
    }

    private function checkCurrentPlayer(string $currentPlayer): void
    {
        if ($currentPlayer !== $this->currentPlayer) {
            throw new RuntimeException('Invalid current Player');
        }
    }

    private function checkPositionIsAvailable(Position $selectedPosition): void
    {
        foreach ($this->board as $playerPositions) {
            foreach ($playerPositions as $position) {
                if ($position->__toString() === $selectedPosition->__toString()) {
                    throw new RuntimeException('Player cannot play twice in same position');
                }
            }
        }
    }
}
