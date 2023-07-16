<?php

namespace App\Http\Repositories;

use App\Models\Comment;
use Throwable;

class CommentRepository
{
    public function getCommentsByLastDate(?int $responseTo): array
    {
        return Comment::where('response_to', $responseTo)
            ->orderBy('created_at', 'desc')->get()->toArray();
    }

    /**
     * @param $data
     * @return void
     * @throws Throwable
     */
    public function saveComment($data): void
    {
        $comment = new Comment();
        $comment->user_name = $data['user_name'];
        $comment->comment = $data['comment'];
        $comment->response_to = $data['response_to'];
        $comment->saveOrFail();
    }

}
