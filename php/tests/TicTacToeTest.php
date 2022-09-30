<?php declare(strict_types=1);

namespace KataTests;

use Kata\TicTacToe;
use PHPUnit\Framework\TestCase;

final class TicTacToeTest extends TestCase
{
    public function test_x_always_goes_first(): void
    {
        $game = new TicTacToe();

        self::assertSame(TicTacToe::PLAYER_X, $game->play(0, 0));
    }

    public function test_o_always_goes_second(): void
    {
        $game = new TicTacToe();
        $game->play(0, 0);

        self::assertSame(TicTacToe::PLAYER_O, $game->play(0, 1));
    }

    /**
     * @dataProvider provideCheckBoardLimits
     */
    public function test_check_board_limits(int $posX, int $posY): void
    {
        $this->expectExceptionMessage('Out of board limits');

        $game = new TicTacToe();
        $game->play($posX, $posY);
    }

    public function provideCheckBoardLimits(): iterable
    {
        yield 'posX too low' => [-1, 0];
        yield 'posY too low' => [0, -1];

        yield 'posX too big' => [3, 0];
        yield 'posY too big' => [0, 3];
    }

    public function test_two_players_cannot_play_the_same_position(): void
    {
        $this->expectExceptionMessage('This position is occupied');

        $game = new TicTacToe();
        $game->play(0, 0);
        $game->play(0, 0);
    }

    public function test_horizontal_first_line_wins_the_game(): void
    {
        $this->expectExceptionMessage('X is the winner');

        $game = new TicTacToe();
        $game->play(0, 0);
        $game->play(0, 2);
        $game->play(1, 0);
        $game->play(1, 2);
        $game->play(2, 0);
    }
}
