<?php
declare(strict_types=1);
require_once __DIR__ . '/vendor/autoload.php';
use App\Models\Book;
use App\Models\BookCollection;
use App\Utils\LibraryHelper;
use App\Utils\CsvReader;
use App\Utils\ReportWriter;

// Expected output:
$col = new BookCollection();
$col->add(new Book(1,'Dune','Herbert',18.99,3));
$col->add(new Book(2,'1984','Orwell',12.50,0));
echo $col->count();  // 2
echo $col;  // calls __toString
echo $col->findById(1)->getTitle();// returns the Dune book.
// echo $col->findById(99); // returns null.
var_dump($col->findById(99));
$LibraryHelper=new LibraryHelper();
echo LibraryHelper::formatTitle('  dune ala  '); // "Dune"
$orwellBooks = LibraryHelper::filterByAuthor($col->getBooks(),'orwell');// [1984]
foreach ($orwellBooks as $book) {
    echo $book->summary() . "<br>";
} 
$sortByPriceBooks = LibraryHelper::sortByPrice($col->getBooks(),'asc');// cheapest firs
foreach ($sortByPriceBooks as $book) {
    echo $book->summary() . "<br>";
} 
echo LibraryHelper::totalValue($col->getBooks()); // e.g. 87.47
$searchByKeywordBooks = LibraryHelper::searchByKeyword($col->getBooks(),'her');// Dune (Herbert), Other (Hershey)...
foreach ($searchByKeywordBooks as $book) {
    echo $book->summary() . "<br>";
} 
$books = CsvReader::load(__DIR__ . '/data/books.csv');

$collection = new BookCollection();

foreach ($books as $book) {
    $collection->add($book);
}
$availableBooks = array_filter(
    $books,
    fn($book) => $book->isAvailable()
);

$sortedBooks = LibraryHelper::sortByPrice(
    $availableBooks,
    'asc'
);

ReportWriter::write(
    $sortedBooks,
    __DIR__ . '/data/report.txt'
);

echo "Report written.";
?>