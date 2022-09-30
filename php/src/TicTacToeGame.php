<?php

declare(strict_types=1);

namespace Kata;

use RuntimeException;

final class TicTacToeGame
{
    // Board representation:
    // $board = [
    //     'X' => [[1, 1], [0, 0]],
    //     'O' => [1, 0],
    // ];
    private array $board = ['X', 'O'];

    private string $currentPlayer = 'X';

    public function play(string $currentPlayer, array $selectedPosition): bool
    {
        if ($currentPlayer !== $this->currentPlayer) {
            throw new RuntimeException('Invalid current Player');
        }

        $this->checkPositionIsAvailable($selectedPosition);
        $this->board[$currentPlayer][] = $selectedPosition;

        var_dump($this->board);

        // check current status & assert there is some winner...

        $this->switchCurrentPlayer();

        return true;
    }

    private function switchCurrentPlayer(): void
    {
        $this->currentPlayer = ($this->currentPlayer === 'X') ? 'O' : 'X';
    }

    private function checkPositionIsAvailable(array $selectedPosition): void
    {
        foreach ($this->board as $playerPositions) {
            if (isset($playerPositions[$selectedPosition[0]][$selectedPosition[1]])) {
                throw new RuntimeException('Player cannot play twice in same position');
            }
        }
    }
}
