<?php

declare(strict_types=1);


namespace App\Service;


use App\Entity\Comment;

class CommentAuthorChanger implements CommentAuthorChangerInterface
{
    private bool $changed = false;

    /**
     * Sets comment author if needed
     * @return bool true if changed author, false otherwise
     */
    public function changeIfNeeded(Comment $comment, string $commentHost): bool
    {
        $this->changeCommentIfAuthorCaban($comment);
        $this->changeCommentIfLocalhost($comment, $commentHost);

        return $this->changed;
    }

    private function changeCommentIfAuthorCaban(Comment $comment)
    {
        if (str_contains($comment->getAuthor(), 'caban')) {
            $comment->setAuthor('COBAN');

            $this->changed = true;
        }
    }

    private function changeCommentIfLocalhost(Comment $comment, string $host)
    {
        if ($host === 'localhost' || $host === '127.0.0.1') {
            $comment->setAuthor('Domawnii ' . $comment->getAuthor());

            $this->changed = true;
        }
    }
}
