<?php
declare(strict_types=1);
namespace App\Utils;
use App\Models\Book;
class ReportWriter
{
    public static function write(array $books, string $path): void
    {
        $content = "";

        foreach ($books as $book) {
            $content .= $book->summary() . PHP_EOL;
        }

        $total = LibraryHelper::totalValue($books);

        $content .= PHP_EOL;
        $content .= "Total inventory value: $" . number_format($total, 2);

        file_put_contents($path, $content);
    }
}