package com.katas;

import org.junit.jupiter.api.BeforeEach;
import org.junit.jupiter.api.Test;

import static org.assertj.core.api.Assertions.assertThatThrownBy;

public class TicTacToeGameShould {

  private TicTacToeGame ticTacToeGame;

  @BeforeEach
  public void init() {
    ticTacToeGame = new TicTacToeGame();
  }

  @Test
  public void throw_an_exception_when_O_player_goes_first() {
    assertThatThrownBy(() -> {
      ticTacToeGame.play(Player.O, 0, 0);
    })
      .isInstanceOf(XPlayerShouldGoFirstException.class);
  }

  @Test
  public void not_throw_an_exception_when_X_player_goes_first() {
    ticTacToeGame.play(Player.X, 0, 0);
  }

  @Test
  public void throw_an_exception_when_X_player_play_twice() {
    ticTacToeGame.play(Player.X, 0, 0);

    assertThatThrownBy(() -> ticTacToeGame.play(Player.X, 0, 1))
      .isInstanceOf(PlayerCannotPlayTwiceException.class);
  }

  @Test
  public void throw_an_exception_when_O_player_play_twice() {
    ticTacToeGame.play(Player.X, 0, 0);
    ticTacToeGame.play(Player.O, 0, 1);

    assertThatThrownBy(() -> ticTacToeGame.play(Player.O, 0, 2))
      .isInstanceOf(PlayerCannotPlayTwiceException.class);
  }
}
