<?php

namespace App\Http\Services;

use App\Http\Repositories\CommentRepository;
use Exception;
use Throwable;


class CommentService
{
    public function __construct(
        private readonly CommentRepository $commentRepository
    ) {
    }

    /**
     * @return array
     */
    public function getComments(): array
    {
        $comments = $this->commentRepository->getCommentsByLastDate(null);
        array_walk($comments, function (&$item) {
            $item['responses'] = $this->commentRepository->getCommentsByLastDate($item['id']);
            array_walk($item['responses'], function (&$subItem) {
                $subItem['responses'] = $this->commentRepository->getCommentsByLastDate($subItem['id']);
            });
        });

        return $comments;
    }

    /**
     * @throws Exception
     */
    public function saveComment($data): void
    {
        try {
            $this->commentRepository->saveComment($data);
        } catch (Throwable $t) {
            throw new Exception($t);
        }
    }
}
