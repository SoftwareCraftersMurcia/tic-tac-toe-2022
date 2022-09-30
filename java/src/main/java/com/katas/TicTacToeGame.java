package com.katas;

public class TicTacToeGame {

  public void play(Player player, int row, int column) {
    if (player == Player.O) {
      throw new XPlayerShouldGoFirstException();
    }
  }
}
