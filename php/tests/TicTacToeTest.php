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
}
