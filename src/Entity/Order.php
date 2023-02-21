<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\Column(length: 100)]
  private ?string $Token = null;

  #[ORM\Column(type: Types::SMALLINT, nullable: true)]
  private ?int $Status = null;

  #[ORM\Column(nullable: true)]
  private ?float $SubTotal = null;

  #[ORM\Column(nullable: true)]
  private ?float $ItemDiscount = null;

  #[ORM\Column(nullable: true)]
  private ?float $Tax = null;

  #[ORM\Column(nullable: true)]
  private ?float $Shipping = null;

  #[ORM\Column(nullable: true)]
  private ?float $Total = null;

  #[ORM\Column(length: 50, nullable: true)]
  private ?string $Promo = null;

  #[ORM\Column(nullable: true)]
  private ?float $Discount = null;

  #[ORM\Column(nullable: true)]
  private ?float $GrandTotal = null;

  #[ORM\Column(length: 50, nullable: true)]
  private ?string $FirstName = null;

  #[ORM\Column(length: 50, nullable: true)]
  private ?string $MiddleName = null;

  #[ORM\Column(length: 50, nullable: true)]
  private ?string $LastName = null;

  #[ORM\Column(length: 15, nullable: true)]
  private ?string $Mobile = null;

  #[ORM\Column(length: 50, nullable: true)]
  private ?string $Email = null;

  #[ORM\Column(length: 50, nullable: true)]
  private ?string $Line1 = null;

  #[ORM\Column(length: 50, nullable: true)]
  private ?string $Line2 = null;

  #[ORM\Column(length: 50, nullable: true)]
  private ?string $City = null;

  #[ORM\Column(length: 50, nullable: true)]
  private ?string $Province = null;

  #[ORM\Column]
  private ?\DateTimeImmutable $CreatedAt = null;

  #[ORM\Column(nullable: true)]
  private ?\DateTimeImmutable $UpdatedAt = null;

  #[ORM\Column(type: Types::TEXT, nullable: true)]
  private ?string $Content = null;

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getToken(): ?string
  {
    return $this->Token;
  }

  public function setToken(string $Token): self
  {
    $this->Token = $Token;

    return $this;
  }

  public function getStatus(): ?int
  {
    return $this->Status;
  }

  public function setStatus(?int $Status): self
  {
    $this->Status = $Status;

    return $this;
  }

  public function getSubTotal(): ?float
  {
    return $this->SubTotal;
  }

  public function setSubTotal(?float $SubTotal): self
  {
    $this->SubTotal = $SubTotal;

    return $this;
  }

  public function getItemDiscount(): ?float
  {
    return $this->ItemDiscount;
  }

  public function setItemDiscount(?float $ItemDiscount): self
  {
    $this->ItemDiscount = $ItemDiscount;

    return $this;
  }

  public function getTax(): ?float
  {
    return $this->Tax;
  }

  public function setTax(?float $Tax): self
  {
    $this->Tax = $Tax;

    return $this;
  }

  public function getShipping(): ?float
  {
    return $this->Shipping;
  }

  public function setShipping(?float $Shipping): self
  {
    $this->Shipping = $Shipping;

    return $this;
  }

  public function getTotal(): ?float
  {
    return $this->Total;
  }

  public function setTotal(?float $Total): self
  {
    $this->Total = $Total;

    return $this;
  }

  public function getPromo(): ?string
  {
    return $this->Promo;
  }

  public function setPromo(?string $Promo): self
  {
    $this->Promo = $Promo;

    return $this;
  }

  public function getDiscount(): ?float
  {
    return $this->Discount;
  }

  public function setDiscount(?float $Discount): self
  {
    $this->Discount = $Discount;

    return $this;
  }

  public function getGrandTotal(): ?float
  {
    return $this->GrandTotal;
  }

  public function setGrandTotal(?float $GrandTotal): self
  {
    $this->GrandTotal = $GrandTotal;

    return $this;
  }

  public function getFirstName(): ?string
  {
    return $this->FirstName;
  }

  public function setFirstName(?string $FirstName): self
  {
    $this->FirstName = $FirstName;

    return $this;
  }

  public function getMiddleName(): ?string
  {
    return $this->MiddleName;
  }

  public function setMiddleName(?string $MiddleName): self
  {
    $this->MiddleName = $MiddleName;

    return $this;
  }

  public function getLastName(): ?string
  {
    return $this->LastName;
  }

  public function setLastName(?string $LastName): self
  {
    $this->LastName = $LastName;

    return $this;
  }

  public function getMobile(): ?string
  {
    return $this->Mobile;
  }

  public function setMobile(?string $Mobile): self
  {
    $this->Mobile = $Mobile;

    return $this;
  }

  public function getEmail(): ?string
  {
    return $this->Email;
  }

  public function setEmail(?string $Email): self
  {
    $this->Email = $Email;

    return $this;
  }

  public function getLine1(): ?string
  {
    return $this->Line1;
  }

  public function setLine1(?string $Line1): self
  {
    $this->Line1 = $Line1;

    return $this;
  }

  public function getLine2(): ?string
  {
    return $this->Line2;
  }

  public function setLine2(?string $Line2): self
  {
    $this->Line2 = $Line2;

    return $this;
  }

  public function getCity(): ?string
  {
    return $this->City;
  }

  public function setCity(?string $City): self
  {
    $this->City = $City;

    return $this;
  }

  public function getProvince(): ?string
  {
    return $this->Province;
  }

  public function setProvince(?string $Province): self
  {
    $this->Province = $Province;

    return $this;
  }

  public function getCreatedAt(): ?\DateTimeImmutable
  {
    return $this->CreatedAt;
  }

  public function setCreatedAt(\DateTimeImmutable $CreatedAt): self
  {
    $this->CreatedAt = $CreatedAt;

    return $this;
  }

  public function getUpdatedAt(): ?\DateTimeImmutable
  {
    return $this->UpdatedAt;
  }

  public function setUpdatedAt(?\DateTimeImmutable $UpdatedAt): self
  {
    $this->UpdatedAt = $UpdatedAt;

    return $this;
  }

  public function getContent(): ?string
  {
    return $this->Content;
  }

  public function setContent(?string $Content): self
  {
    $this->Content = $Content;

    return $this;
  }
}
