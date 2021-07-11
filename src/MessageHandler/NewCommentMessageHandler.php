<?php

declare(strict_types=1);


namespace App\MessageHandler;


use App\Entity\Comment;
use App\Message\NewCommentMessage;
use App\Repository\CommentRepository;
use App\Service\CommentAuthorChangerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class NewCommentMessageHandler implements MessageHandlerInterface
{
    private CommentRepository $commentRepository;
    private EntityManagerInterface $em;
    private CommentAuthorChangerInterface $authorChanger;

    public function __construct(
        EntityManagerInterface $em, CommentRepository $commentRepository,
        CommentAuthorChangerInterface $authorChanger
    ) {
        $this->commentRepository = $commentRepository;
        $this->em = $em;
        $this->authorChanger = $authorChanger;
    }

    public function __invoke(NewCommentMessage $message)
    {
        $comment = $this->commentRepository->find($message->getId());

        if (!$comment) {
            return;
        }

        if ($this->authorChanger->changeIfNeeded($comment, $message->getHost())) {
            $this->em->persist($comment);
            $this->em->flush();
        }
    }
}
