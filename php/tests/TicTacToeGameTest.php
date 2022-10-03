<?php

declare(strict_types=1);

namespace KataTests;

use Kata\Position;
use Kata\TicTacToeGame;
use PHPUnit\Framework\TestCase;
use RuntimeException;

final class TicTacToeGameTest extends TestCase
{
    /**
     * - [X] X always goes first
     * - [X] A Player can not play twice
     * - [X] Players alternate placing X’s and O’s on the board
     * - [X] Players cannot play on a played position
     * - [ ] A player with 3 X’s (vertically, horizontally or diagonally) wins the game.
     * - [ ] If all 9 squares are filled and neither player achieves 3 in a row, the game is a draw.
     * - [ ] A player with 3 O’s in a row (vertically, horizontally or diagonally) wins the game.
     */

    /**
     * @test
     *
     * @dataProvider playerDataProvider
     */
    public function assert_players_play_alternatively(array $movements): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Invalid current Player');

        $ticTacToeGame = new TicTacToeGame();

        foreach ($movements as $movement) {
            $ticTacToeGame->play(...$movement);
        }
    }

    public function playerDataProvider(): iterable
    {
        yield 'assert_x_always_goes_first' => [
            [
                ['O', new Position(0, 0)],
            ],
        ];

        yield 'assert_a_player_cant_play_twice' => [
            [
                ['X', new Position(0, 0)],
                ['X', new Position(0, 1)],
            ],
        ];

        yield 'assert_a_player_should_play_alternative' => [
            [
                ['X', new Position(0, 0)],
                ['O', new Position(0, 1)],
                ['O', new Position(1, 0)],
            ],
        ];
    }

    /**
     * @test
     */
    public function assert_players_cannot_play_twice_in_same_position(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Player cannot play twice in same position');

        $ticTacToeGame = new TicTacToeGame();

        $ticTacToeGame->play('X', new Position(0, 0));
        $ticTacToeGame->play('O', new Position(0, 0));
    }
}
