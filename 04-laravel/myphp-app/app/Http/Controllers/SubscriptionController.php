<?php

namespace App\Http\Controllers;

use App\Http\Resources\SubscriptionResource;
use App\Services\Subscription\SubscriptionService;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    protected SubscriptionService $subscriptionService;

    public function __construct(SubscriptionService $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }

    public function index(Request $request)
    {
        $subscriptions = $this->subscriptionService->getAll($request->query());
        return new SubscriptionResource($subscriptions);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subscriber_id' => 'required|integer|exists:subscribers,id',
            'service' => 'required|string|max:255',
            'topic' => 'required|string|max:255',
            'payload' => 'nullable|array',
            'expired_at' => 'nullable|date',
        ]);

        $subscription = $this->subscriptionService->create($validated);

        return response()->json($subscription, 201);
    }

    public function show(int $id)
    {
        $subscription = $this->subscriptionService->findById($id);
        return response()->json($subscription);
    }

    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'subscriber_id' => 'sometimes|integer|exists:subscribers,id',
            'service' => 'sometimes|string|max:255',
            'topic' => 'sometimes|string|max:255',
            'payload' => 'nullable|array',
            'expired_at' => 'nullable|date',
        ]);

        $subscription = $this->subscriptionService->update($id, $validated);

        return response()->json($subscription);
    }

    public function destroy(int $id)
    {
        $this->subscriptionService->delete($id);
        return response()->json(null, 204);
    }
}
