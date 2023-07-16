<?php

namespace App\Http\Controllers;

use App\Http\Services\CommentService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CommentController extends Controller
{
    public function __construct(
        private readonly CommentService $commentService
    ) {
    }

    public function getComments(): JsonResponse
    {
        $comments = $this->commentService->getComments();

        return response()->json($comments, Response::HTTP_OK);
    }

    public function newComment(Request $request): JsonResponse
    {
        $data = $request->validate([
            'user_name' => ['required', 'max:255'],
            'comment' => ['required'],
            'response_to' => ['nullable'],
        ]);

        try {
            $this->commentService->saveComment($data);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }

        return response()->json(['message' => 'created'], Response::HTTP_OK);
    }
}
