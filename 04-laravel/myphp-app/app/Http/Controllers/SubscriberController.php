<?php

namespace App\Http\Controllers;

use App\Http\Resources\SubscriberResource;
use App\Services\Subscriber\SubscriberService;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    protected SubscriberService $subscriberService;

    public function __construct(SubscriberService $subscriberService)
    {
        $this->subscriberService = $subscriberService;
    }

    public function index(Request $request)
    {
        $subscribers = $this->subscriberService->getAll($request->query());
        return new SubscriberResource($subscribers);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:subscribers,email',
        ]);

        $subscriber = $this->subscriberService->create($validated);

        return response()->json($subscriber->load('subscriptions'), 201);
    }

    public function show(int $id)
    {
        $subscriber = $this->subscriberService->findById($id);
        return response()->json($subscriber);
    }

    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:subscribers,email,' . $id,
        ]);

        $subscriber = $this->subscriberService->update($id, $validated);

        return response()->json($subscriber);
    }

    public function destroy(int $id)
    {
        $this->subscriberService->delete($id);
        return response()->json(null, 204);
    }
}
