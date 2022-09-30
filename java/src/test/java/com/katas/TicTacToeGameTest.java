package com.katas;

import org.junit.jupiter.api.Test;

import static org.assertj.core.api.Assertions.assertThatThrownBy;

public class TicTacToeGameTest {

  @Test
  public void should_throw_exception_when_O_user_plays_first() {
    assertThatThrownBy(() -> {
      TicTacToeGame ticTacToeGame = new TicTacToeGame();

      ticTacToeGame.play("O", 0, 0);
    })
      .isInstanceOf(XUserShouldGoFirstException.class);
  }

  @Test
  public void should_not_throw_exception_when_X_user_plays_first() {
    TicTacToeGame ticTacToeGame = new TicTacToeGame();

    ticTacToeGame.play("X", 0, 0);
  }



}
