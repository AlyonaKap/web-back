<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = ['subscriber_id', 'service', 'topic', 'payload', 'expired_at'];

    protected function casts(): array
    {
        return [
            'payload' => 'array',
            'expired_at' => 'datetime',
        ];
    }

    /**
     * Get the subscriber that owns the subscription.
     */
    public function subscriber()
    {
        return $this->belongsTo(Subscriber::class);
    }
}
