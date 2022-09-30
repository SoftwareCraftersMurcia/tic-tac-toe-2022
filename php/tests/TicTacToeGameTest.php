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
     * - [X] Players alternate placing X’s and O’s on the board
     * - [ ] Players cannot play on a played position
     * - [ ] A player with 3 X’s (vertically, horizontally or diagonally) wins the game.
     * - [ ] If all 9 squares are filled and neither player achieves 3 in a row, the game is a draw.
     * - [ ] A player with 3 O’s in a row (vertically, horizontally or diagonally) wins the game.
     */

    public function playerDataProvider(): iterable
    {
        yield "assert_x_always_goes_first" => [['O']];
        yield "assert_a_player_cant_play_twice" => [['X', 'X']];
        yield "assert_a_player_should_play_alternative" => [['X', 'O', 'O']];
    }

    /**
     * @test
     * @dataProvider playerDataProvider()
     */
    public function XX(array $players): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Invalid current Player');

        $ticTacToeGame = new TicTacToeGame();

        foreach ($players as $player) {
            $ticTacToeGame->play($player);
        }
    }
}
