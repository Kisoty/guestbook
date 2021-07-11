<?php

declare(strict_types=1);


namespace App\Message;


class NewCommentMessage
{
    private int $id;

    private string $host;

    public function __construct(int $id, string $host)
    {
        $this->id = $id;
        $this->host = $host;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getHost(): string
    {
        return $this->host;
    }
}
