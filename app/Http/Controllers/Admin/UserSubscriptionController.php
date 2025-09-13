<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\UserSubscription;

class UserSubscriptionController extends Controller
{
    public function index()
    {
        return view('admin.subscriptions.index');
    }

    public function storePlan(Request $request)
    {
        return view('admin.subscriptions.plans.store');
    }

    public function updatePlan(Request $request, $plan)
    {
        return view('admin.subscriptions.plans.update', compact('plan'));
    }

    public function show(UserSubscription $subscription)
    {
        return view('admin.subscriptions.show', compact('subscription'));
    }

    public function handlePaymentIssues(Request $request)
    {
        return view('admin.subscriptions.payment-issues');
    }
}
