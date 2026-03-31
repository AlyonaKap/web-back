<?php

namespace App\Services\Subscription;

use App\Models\Subscription;

class SubscriptionService
{

    public function getAll(array $queryParams)
    {
        $query = Subscription::query();

        $sortField = $queryParams['sort'] ?? 'id';
        $sortOrder = $queryParams['order'] ?? 'asc';

        $allowedSortFields = ['id', 'service', 'topic', 'expired_at', 'created_at', 'updated_at'];
        if (in_array($sortField, $allowedSortFields)) {
            $query->orderBy($sortField, $sortOrder === 'desc' ? 'desc' : 'asc');
        }

        $perPage = $queryParams['per_page'] ?? 15;

        return $query->paginate($perPage);
    }


    public function findById(int $id): Subscription
    {
        return Subscription::findOrFail($id);
    }

    public function create(array $data): Subscription
    {
        return Subscription::create($data);
    }


    public function update(int $id, array $data): Subscription
    {
        $subscription = Subscription::findOrFail($id);
        $subscription->update($data);

        return $subscription->fresh();
    }

    public function delete(int $id): void
    {
        $subscription = Subscription::findOrFail($id);
        $subscription->delete();
    }
}
