<?php

namespace App\Services;

use App\Entity\Boat;
use App\Entity\Tile;
use App\Repository\TileRepository;

class MapManager
{
  private $tileRepository;

  public function __construct(TileRepository $tileRepository)
  {
    $this->tileRepository = $tileRepository;
  }

  public function tileExists(int $x, int $y): bool
  {
    $tile = $this->tileRepository->findOneBy([
      'coordX' => $x,
      'coordY' => $y,
    ]);
    return $tile ? true : false;
  }

  public function getRandomIsland(): Tile
  {
    $tiles = $this->tileRepository->findBy([
      'type' => 'island',
    ]);
    
    return $tiles[array_rand($tiles)];
  }

  public function checkTreasure(Boat $boat): bool
  {
    $tile = $this->tileRepository->findOneBy([
      'coordX'      => $boat->getCoordX(),
      'coordY'      => $boat->getCoordY(),
      'hasTreasure' => true,
    ]);

    return $tile ? true : false;
  }
}
