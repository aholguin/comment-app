<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property string $user_name
 * @property string $comment
 * @property ?int $response_to
 * @method static where(string $string, int|null $responseTo)
 */
class Comment extends Model
{
    use HasFactory;

    public function getCreatedAtAttribute($value): string
    {
        return Carbon::parse($value)->ago();
    }
}
