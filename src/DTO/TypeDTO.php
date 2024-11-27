<?php
class TypeDTO
{
  public function __construct(
    public int $id,
    public string $name,
    public string $slug,
  ) {}
}
