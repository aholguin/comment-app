<?php

namespace App\Http\Services\CommentService;

use App\Models\Comment;
use Exception;
use Illuminate\Database\Eloquent\Collection;


class CommentService
{

    public function getComments(): Collection
    {
        $commentsCollection = Comment::where('response_to', null)
            ->orderBy('created_at', 'desc')->get();

        foreach ($commentsCollection as $item) {
            $response = Comment::where('response_to', $item->id)
                ->orderBy('created_at', 'desc')->get();
            $item['responses'] = $response;

            foreach ($response as $subItem) {
                $subResponse = Comment::where('response_to', $subItem->id)
                    ->orderBy('created_at', 'desc')->get();
                $subItem['responses'] = $subResponse;
            }
        }

        return $commentsCollection;
    }

    /**
     * @throws Exception
     */
    public function saveComment($data): void
    {
        $comment = new Comment();
        $comment->user_name = $data['user_name'];
        $comment->comment = $data['comment'];
        $comment->response_to = $data['response_to'];

        try {
            $comment->save();
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }
}
