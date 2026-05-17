<?php
declare(strict_types=1);
namespace App\Utils;

use App\Models\Book;

class LibraryHelper{
  public static function formatTitle(string $title):string{
    $title = trim($title);

    $title = preg_replace('/\s+/', ' ', $title);

    return ucwords($title);
 }
 public static function filterByAuthor(array $books, string $author): array{
  return array_filter($books, fn($book) => strtolower($book->getAuthor()) === strtolower($author));
 }
 public static function sortByPrice(array $books , string $dir='asc'):array{
    usort(
            $books,
            function (Book $a, Book $b) use ($dir) {

                return $dir === 'desc'
                    ? $b->getPrice() <=> $a->getPrice()
                    : $a->getPrice() <=> $b->getPrice();
            }
        );
  return $books;
 }
  public static function totalValue(array $books): float
    {
        return array_reduce(
            $books,
            fn(float $carry, Book $book) =>
                $carry + ($book->getPrice() * $book->getStock()),
            0
        );
    }
    
    public static function searchByKeyword(array $books, string $kw): array
    {
        $kw = strtolower($kw);
        return array_values(
            array_filter(
                $books,
                function (Book $book) use ($kw) {

                    return str_contains(strtolower($book->getTitle()), $kw)
                        || str_contains(strtolower($book->getAuthor()), $kw);
                }
            )
        );
    }
  

}
  