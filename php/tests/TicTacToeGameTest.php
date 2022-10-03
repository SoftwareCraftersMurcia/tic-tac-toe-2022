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
     * - [X] A player with 3 X’s (vertically, horizontally or diagonally) wins the game.
     * - [X] A player with 3 O’s (vertically, horizontally or diagonally) wins the game.
     * - [X] If all 9 squares are filled and neither player achieves 3 in a row, the game is a draw.
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

    /**
     *   ___ ___ ___
     *  | x | x | x |
     *  | o |   |   |
     *  | o |   |   |
     *   ¯¯¯ ¯¯¯ ¯¯¯
     *
     * @test
     */
    public function assert_x_player_with_three_in_a_row_wins(): void
    {
        $ticTacToeGame = new TicTacToeGame();

        $ticTacToeGame->play('X', new Position(0, 0));
        $ticTacToeGame->play('O', new Position(1, 0));
        $ticTacToeGame->play('X', new Position(0, 1));
        $ticTacToeGame->play('O', new Position(2, 0));
        $status = $ticTacToeGame->play('X', new Position(0, 2));

        self::assertSame(TicTacToeGame::STATUS_PLAYER_WINS['X'], $status);
    }

    /**
     *   ___ ___ ___
     *  | o | o | o |
     *  | x | x |   |
     *  | x |   |   |
     *   ¯¯¯ ¯¯¯ ¯¯¯
     *
     * @test
     */
    public function assert_o_player_with_three_in_a_row_wins(): void
    {
        $ticTacToeGame = new TicTacToeGame();

        $ticTacToeGame->play('X', new Position(1, 0));
        $ticTacToeGame->play('O', new Position(0, 0));
        $ticTacToeGame->play('X', new Position(1, 1));
        $ticTacToeGame->play('O', new Position(0, 1));
        $ticTacToeGame->play('X', new Position(2, 0));
        $status = $ticTacToeGame->play('O', new Position(0, 2));

        self::assertSame(TicTacToeGame::STATUS_PLAYER_WINS['O'], $status);
    }

    /**
     *   ___ ___ ___
     *  | o | x | o |
     *  | x | o | x |
     *  | x | o | x |
     *   ¯¯¯ ¯¯¯ ¯¯¯
     *
     * @test
     */
    public function assert_draw(): void
    {
        $ticTacToeGame = new TicTacToeGame();

        $ticTacToeGame->play('X', new Position(0, 1));
        $ticTacToeGame->play('O', new Position(0, 0));
        $ticTacToeGame->play('X', new Position(1, 0));
        $ticTacToeGame->play('O', new Position(0, 2));
        $ticTacToeGame->play('X', new Position(1, 2));
        $ticTacToeGame->play('O', new Position(1, 1));
        $ticTacToeGame->play('X', new Position(2, 0));
        $ticTacToeGame->play('O', new Position(2, 1));
        $status = $ticTacToeGame->play('X', new Position(2, 2));

        self::assertSame(TicTacToeGame::STATUS_DRAW, $status);
    }

    /**
     * @test
     *
     * @dataProvider winPositionsDataProvider
     */
    public function assert_win_positions(array $movements): void
    {
        $ticTacToeGame = new TicTacToeGame();

        $result = '';
        $movement = '';
        foreach ($movements as $movement) {
            $result = $ticTacToeGame->play(...$movement);
        }

        self::assertSame($result, TicTacToeGame::STATUS_PLAYER_WINS[$movement[0]]);
    }

    public function winPositionsDataProvider(): iterable
    {
        yield 'horizontal 1st row' => [
            [
                ['X', new Position(0, 0)],
                ['O', new Position(1, 0)],
                ['X', new Position(0, 1)],
                ['O', new Position(2, 0)],
                ['X', new Position(0, 2)],
            ],
        ];

        yield 'horizontal 2nd row' => [
            [
                ['X', new Position(1, 0)],
                ['O', new Position(0, 0)],
                ['X', new Position(1, 1)],
                ['O', new Position(2, 0)],
                ['X', new Position(1, 2)],
            ],
        ];

        yield 'horizontal 3rd row' => [
            [
                ['X', new Position(2, 0)],
                ['O', new Position(0, 0)],
                ['X', new Position(2, 1)],
                ['O', new Position(1, 2)],
                ['X', new Position(2, 2)],
            ],
        ];

        yield 'vertical 1st row' => [
            [
                ['X', new Position(0, 0)],
                ['O', new Position(2, 0)],
                ['X', new Position(0, 1)],
                ['O', new Position(1, 2)],
                ['X', new Position(0, 2)],
            ],
        ];

        yield 'vertical 2nd row' => [
            [
                ['X', new Position(0, 1)],
                ['O', new Position(0, 0)],
                ['X', new Position(1, 1)],
                ['O', new Position(2, 0)],
                ['X', new Position(2, 1)],
            ],
        ];

        yield 'vertical 3rd row' => [
            [
                ['X', new Position(0, 2)],
                ['O', new Position(0, 0)],
                ['X', new Position(1, 2)],
                ['O', new Position(1, 0)],
                ['X', new Position(2, 2)],
            ],
        ];

        yield 'diagonal X' => [
            [
                ['X', new Position(0, 0)],
                ['O', new Position(0, 1)],
                ['X', new Position(1, 1)],
                ['O', new Position(1, 0)],
                ['X', new Position(2, 2)],
            ],
        ];

        yield 'diagonal Y' => [
            [
                ['X', new Position(2, 0)],
                ['O', new Position(0, 0)],
                ['X', new Position(1, 1)],
                ['O', new Position(1, 0)],
                ['X', new Position(0, 2)],
            ],
        ];
    }
}
