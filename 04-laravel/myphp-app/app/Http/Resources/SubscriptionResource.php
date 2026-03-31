<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SubscriptionResource extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return  $this->resource->transform(function ($subscription) {
          return [
            'id' => $subscription->id,
            'subscriber_id' => $subscription->subscriber_id,
            'service' => $subscription->service,
            'topic' => $subscription->topic,
            'payload' => $subscription->payload,
            'expired_at' => $subscription->expired_at->format('Y-m-d H:i:s'),
            'created_at' => $subscription->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $subscription->updated_at->format('Y-m-d H:i:s'),
        ];
    })->toArray();

}
}
