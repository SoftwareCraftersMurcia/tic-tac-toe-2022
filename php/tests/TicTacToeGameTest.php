<?php

declare(strict_types=1);

namespace KataTests;

use Kata\TicTacToeGame;
use PHPUnit\Framework\TestCase;
use RuntimeException;

final class TicTacToeGameTest extends TestCase
{
    /**
     * - [x] X always goes first
     * - [X] A Player can not play twice
     * - [ ] Players alternate placing X’s and O’s on the board
     * - [ ] Players cannot play on a played position
     * - [ ] A player with 3 X’s (vertically, horizontally or diagonally) wins the game.
     * - [ ] If all 9 squares are filled and neither player achieves 3 in a row, the game is a draw.
     * - [ ] A player with 3 O’s in a row (vertically, horizontally or diagonally) wins the game.
     */

    /** @test */
    public function assert_x_always_goes_first(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Invalid current Player');

        (new TicTacToeGame())->play('O');
    }

    /** @test */
    public function assert_a_player_cant_play_twice(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Invalid current Player');

        $ticTacToeGame = new TicTacToeGame();
        $ticTacToeGame->play('X');
        $ticTacToeGame->play('X');
    }
}
