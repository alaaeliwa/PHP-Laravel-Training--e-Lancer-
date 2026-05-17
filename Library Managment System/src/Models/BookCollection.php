<?php
declare(strict_types=1);
namespace App\Models;
class BookCollection{
  private array $books =[];
  public function getBooks():array{
    return $this->books;
  }
  public function add(Book $book):void{
    $this->books[] = $book;
  }

  public function findById(int $id): ?Book{
    foreach ($this->books as $book){
      if($book->getId() === $id){
        return $book;
      }
    }
    return null;
  }
  public function count():int{
    return count($this->books);
  }
  public function __toString():string{
    return implode(
    "\n",
    array_map(fn($book) => $book->summary(), $this->books)
);
  }
}
