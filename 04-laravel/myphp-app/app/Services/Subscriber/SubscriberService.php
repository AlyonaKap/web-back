<?php

namespace App\Services\Subscriber;

use App\Models\Subscriber;

class SubscriberService
{

    public function getAll(array $queryParams)
    {
        $query = Subscriber::with('subscriptions');

        $sortField = $queryParams['sort'] ?? 'id';
        $sortOrder = $queryParams['order'] ?? 'asc';

        $allowedSortFields = ['id', 'name', 'email', 'created_at', 'updated_at'];
        if (in_array($sortField, $allowedSortFields)) {
            $query->orderBy($sortField, $sortOrder === 'desc' ? 'desc' : 'asc');
        }

        $perPage = $queryParams['per_page'] ?? 15;

        return $query->paginate($perPage);
    }

    
    public function findById(int $id): Subscriber
    {
        return Subscriber::with('subscriptions')->findOrFail($id);
    }


    public function create(array $data): Subscriber
    {
        return Subscriber::create($data);
    }


    public function update(int $id, array $data): Subscriber
    {
        $subscriber = Subscriber::findOrFail($id);
        $subscriber->update($data);

        return $subscriber->load('subscriptions');
    }

    public function delete(int $id): void
    {
        $subscriber = Subscriber::findOrFail($id);
        $subscriber->delete();
    }
}
