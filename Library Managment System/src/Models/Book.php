<?php
declare(strict_types=1);
namespace App\Models;
use App\Traits\Timestampable;
use App\Contracts\Discountable;
class Book implements Discountable{
  
  use Timestampable;
  
  
  public function __construct(private readonly int $id,
  private string $title,
  private string $author,
  private float $price,
  private int $stock =0){
    $this->initTimestamps();
  }

  public function getId():int{
    return $this->id;
  }
  public function getTitle():string{
    return $this->title;
  }
  public function getAuthor():string{
    return $this->author;
  }
  public function getPrice():float{
    return $this->price;
  }
  public function getStock():int{
    return $this->stock;
  }
  
  public function summary():string{
    return "[{$this->id}]{$this->title} by {$this->author} - {$this->price} in stock: {$this->stock}";
  }
  public function isAvailable():bool{
    return $this->stock > 0;
  }

  public function checkOut():void{
    if($this->stock > 0){
      $this->stock--;
    }
    else{
      throw new \RuntimeException('Out of stock');
    }
  }
   public function applyDiscount(float $pct): float{
    return $this->price * (1 - $pct / 100);
    }
}
