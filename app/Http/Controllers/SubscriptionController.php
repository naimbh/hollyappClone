<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function subscribe(Request $request, $subscriptionId)
    {
        $user = User::find(auth()->user()->id);

        $user->update([
            'is_paid' => true,
            'subscriptionId' => $request->subscriptionId,
        ]);

        return ['status' => 'success'];
    }
}
