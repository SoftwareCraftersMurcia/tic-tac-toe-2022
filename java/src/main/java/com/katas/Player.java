package com.katas;

public enum Player {
  X,
  O;

  public Player opposite() {
    if (this == Player.X) {
      return Player.O;
    } else {
      return Player.X;
    }
  }

  public boolean isO() {
    return this == Player.O;
  }
}
