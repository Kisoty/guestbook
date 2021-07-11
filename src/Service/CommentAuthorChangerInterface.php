<?php

declare(strict_types=1);


namespace App\Service;


use App\Entity\Comment;

interface CommentAuthorChangerInterface
{
    public function changeIfNeeded(Comment $comment, string $commentHost): bool;
}
