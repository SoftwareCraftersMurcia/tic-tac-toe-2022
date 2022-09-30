package com.katas;

public class TicTacToeGame {

  private Player currentPlayer;

  public TicTacToeGame() {
    this.currentPlayer = Player.X;
  }

  public void play(Player player, int row, int column) {
    if (player == Player.O) {
      throw new XPlayerShouldGoFirstException();
    }

    if (player != currentPlayer) {
      throw new PlayerCannotPlayTwiceException();
    }

    currentPlayer = Player.O;
  }
}

