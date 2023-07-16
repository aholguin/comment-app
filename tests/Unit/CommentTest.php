<?php

namespace Tests\Unit;

use App\Http\Repositories\CommentRepository;
use App\Http\Services\CommentService;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;
use Throwable;

class CommentTest extends TestCase
{
    /**
     * @test
     * @throws Exception
     */
    public function itGivesProperFormatToCommentResponse()
    {
        $commentRepositoryMock = $this->createMock(CommentRepository::class);

        $commentRepositoryMock->method('getCommentsByLastDate')->willReturn(
            [
                [
                    'id' => 1,
                    'user_name' => '',
                    "comment" => '',
                    'response_to' => null,
                    'created_at' => '',
                    'updated_at' => ''
                ],
            ]
        );

        $commentService = new CommentService($commentRepositoryMock);
        $comments = $commentService->getComments();
        $expected =
            [
                [
                    'id' => 1,
                    'user_name' => '',
                    'comment' => '',
                    'response_to' => null,
                    'created_at' => '',
                    'updated_at' => '',
                    'responses' =>
                        [
                            [
                                'id' => 1,
                                'user_name' => '',
                                'comment' => '',
                                'response_to' => null,
                                'created_at' => '',
                                'updated_at' => '',
                                'responses' =>
                                    [
                                        [
                                            'id' => 1,
                                            'user_name' => '',
                                            'comment' => '',
                                            'response_to' => null,
                                            'created_at' => '',
                                            'updated_at' => '',
                                        ],
                                    ],
                            ],
                        ],
                ],
            ];
        $this->assertEquals($expected, $comments);
    }

    /**
     * @test
     * @throws Exception|Throwable
     */
    public function itCatchesThrowableFromModelToSendExceptionToTheController(): void
    {
        $commentRepositoryMock = $this->createMock(CommentRepository::class);

        $commentService = new CommentService($commentRepositoryMock);
        $commentRepositoryMock->method('saveComment')->willThrowException(
            new \Exception('Something Wrong with the Query')
        );

        $this->expectException(\Exception::class);
        $commentService->saveComment([]);
    }
}
