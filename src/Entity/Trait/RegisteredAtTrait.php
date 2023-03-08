<?php

namespace App\Entity\Trait;

use Doctrine\ORM\Mapping\Mapping as ORM;

trait RegisteredAtTrait
{
  #[ORM\Column(type: 'datetime_immutable', options: ['default' => 'CURRENT_TIMESTAMP'])]
  private $RegisteredAt;

  public function getRegisteredAt(): ?\DateTimeImmutable
  {
    return $this->RegisteredAt;
  }

  public function setRegisteredAt(\DateTimeImmutable $RegisteredAt): self
  {
    $this->RegisteredAt = $RegisteredAt;

    return $this;
  }

}