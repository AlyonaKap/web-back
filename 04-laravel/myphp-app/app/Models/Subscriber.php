<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email'];

    /**
     * Get all subscriptions for the subscriber.
     */
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
