<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SubscriberResource extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return  $this->resource->transform(function ($subscriber) {
            return [
                'id' => $subscriber->id,
                'name' => $subscriber->name,
                'email' => $subscriber->email,
                'subscriptions' => $subscriber->subscriptions,
                'created_at' => $subscriber->created_at->format('Y-m-d H:i:s'),
                'updated_at' => $subscriber->updated_at->format('Y-m-d H:i:s'),
            ];
        })->toArray();
    }
}
