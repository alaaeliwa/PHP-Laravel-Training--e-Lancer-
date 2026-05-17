<?php
declare(strict_types=1);

namespace App\Traits;

trait Timestampable
{
    private string $createdAt;

    public function initTimestamps(): void
    {
        $this->createdAt = date('Y-m-d H:i:s');
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }
}