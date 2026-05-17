<?php
declare(strict_types=1);
namespace App\Utils;
use App\Models\Book;

class CsvReader{
    public static function load(string $path): array
    {
        $books = [];

        if (!file_exists($path)) {
            return $books;
        }

        $handle = fopen($path, 'r');

        if ($handle) {

            fgetcsv($handle);

            while (($row = fgetcsv($handle)) !== false) {

                $books[] = new Book(
                    (int)$row[0],
                    $row[1],
                    $row[2],
                    (float)$row[4],
                    (int)$row[5]
                );
            }

            fclose($handle);
        }

        return $books;
    }
}