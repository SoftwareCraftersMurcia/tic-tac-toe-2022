<?php

declare(strict_types=1);

namespace Kata;

use RuntimeException;

final class TicTacToeGame
{
    private const SOLUTIONS = [
        // Horizontal
        ['0:0', '0:1', '0:2'],
        ['1:0', '1:1', '1:2'],
        ['2:0', '2:1', '2:2'],
        // Vertical
        ['0:0', '1:0', '2:0'],
        ['0:1', '1:1', '2:1'],
        ['0:2', '1:2', '2:2'],
        // Diagonal
        ['0:0', '1:1', '2:2'],
        ['2:0', '1:1', '0:2'],
    ];

    public const STATUS_IN_PROGRESS = 'In progress';

    public const STATUS_DRAW = 'Draw';

    public const STATUS_PLAYER_WINS = [
        'X' => 'X wins',
        'O' => 'O wins',
    ];

    // Board representation:
    // $board = [
    //     'X' => [[1, 1], [0, 0]],
    //     'O' => [[1, 0]],
    // ];
    private array $board = ['X' => [], 'O' => []];

    private string $currentPlayer = 'X';

    public function play(string $currentPlayer, Position $selectedPosition): string
    {
        $this->checkCurrentPlayer($currentPlayer);

        $this->checkPositionIsAvailable($selectedPosition);

        $this->addPositionToBoard($selectedPosition);

        if ($this->checkPlayerWins()) {
            return self::STATUS_PLAYER_WINS[$this->currentPlayer];
        }

        if ($this->checkIfDraw()) {
            return self::STATUS_DRAW;
        }

        $this->switchCurrentPlayer();

        return self::STATUS_IN_PROGRESS;
    }

    private function checkIfDraw(): bool
    {
        return count($this->board['X']) + count($this->board['O']) === 9;
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

    private function addPositionToBoard(Position $selectedPosition): void
    {
        $this->board[$this->currentPlayer][] = $selectedPosition;
    }

    private function checkPlayerWins(): bool
    {
        $positions = $this->board[$this->currentPlayer];
        if (count($positions) < 3) {
            return false;
        }

        return $this->calculateIfPlayerWins($positions);
    }

    /**
     * @param list<Position> $positions
     */
    private function calculateIfPlayerWins(array $positions): bool
    {
        foreach (self::SOLUTIONS as $possibleSolution) {
            $matches = 0;
            foreach ($positions as $position) {
                if (!in_array($position->__toString(), $possibleSolution)) {
                    continue;
                }
                $matches++;
            }

            if ($matches === 3) {
                return true;
            }
        }

        return false;
    }

    private function switchCurrentPlayer(): void
    {
        $this->currentPlayer = ($this->currentPlayer === 'X') ? 'O' : 'X';
    }
}
