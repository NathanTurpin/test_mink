<?php
class RaceDTO

{



  public function __construct(
    public int $id,
    public string $name,
    public string $slug,
    public ?TypeDTO $type,
  ) {}
}
