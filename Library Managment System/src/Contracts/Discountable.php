<?php
declare(strict_types=1);
namespace App\Contracts;
interface Discountable{
  public function applyDiscount(float $pct): float;
}