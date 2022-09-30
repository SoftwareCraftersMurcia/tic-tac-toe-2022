package com.katas;

public class TicTacToeGame {

  private Player currentPlayer;
  private int currentTurn;

  public TicTacToeGame() {
    this.currentPlayer = Player.X;
    this.currentTurn = 0;
  }

  public void play(Player player, int row, int column) {
    if (player == Player.O && currentTurn == 0) {
      throw new XPlayerShouldGoFirstException();
    }

    if (player != currentPlayer) {
      throw new PlayerCannotPlayTwiceException();
    }

    if (currentPlayer == Player.X) {
      currentPlayer = Player.O;
    } else {
      currentPlayer = Player.X;
    }

    currentTurn++;
  }
}

