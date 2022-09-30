package com.katas;

public class TicTacToeGame {

  private Player currentPlayer;
  private int currentTurn;

  public TicTacToeGame() {
    this.currentPlayer = Player.X;
    this.currentTurn = 0;
  }

  public void play(Player player, int row, int column) {
    if (isFirstTurn() && player.isO()) {
      throw new XPlayerShouldGoFirstException();
    }

    if (player != currentPlayer) {
      throw new PlayerCannotPlayTwiceException();
    }

    currentPlayer = player.opposite();

    currentTurn++;
  }

  private boolean isFirstTurn() {
    return currentTurn == 0;
  }
}

