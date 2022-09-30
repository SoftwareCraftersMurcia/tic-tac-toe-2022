package com.katas;

import org.junit.jupiter.api.BeforeEach;
import org.junit.jupiter.api.Test;

import static org.assertj.core.api.Assertions.assertThatThrownBy;

public class TicTacToeGameTest {

  private TicTacToeGame ticTacToeGame;

  @BeforeEach
  public void init() {
    ticTacToeGame = new TicTacToeGame();
  }

  @Test
  public void should_throw_exception_when_O_user_plays_first() {
    assertThatThrownBy(() -> {
      ticTacToeGame.play(Player.O, 0, 0);
    })
      .isInstanceOf(XUserShouldGoFirstException.class);
  }

  @Test
  public void should_not_throw_exception_when_X_user_plays_first() {
    ticTacToeGame.play(Player.X, 0, 0);
  }
}
