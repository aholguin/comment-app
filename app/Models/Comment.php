<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $user_name
 * @property string $comment
 * @property ?int $response_to
 */
class Comment extends Model
{
    use HasFactory;
}
