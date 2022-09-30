<?php declare(strict_types=1);

namespace KataTests;

use Kata\TicTacToe;
use PHPUnit\Framework\TestCase;

final class TicTacToeTest extends TestCase
{
    public function test_x_always_goes_first(): void
    {
        $game = new TicTacToe();

        self::assertSame('X', $game->play(0, 0));
    }

    public function test_o_always_goes_second(): void
    {
        $game = new TicTacToe();
        $game->play(0, 0);

        self::assertSame('O', $game->play(0, 1));
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
}
