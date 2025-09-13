<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function plans()
    {
        return view('admin.payments.plans');
    }

    public function storePlan(Request $request)
    {
        return view('admin.payments.plans.store');
    }

    public function updatePlan(Request $request, $plan)
    {
        return view('admin.payments.plans.update', compact('plan'));
    }

    public function history()
    {
        return view('admin.payments.history');
    }

    public function refund(Request $request)
    {
        return view('admin.payments.refunds');
    }

    public function handleFailures(Request $request)
    {
        return view('admin.payments.failures');
    }

    public function createCoupon(Request $request)
    {
        return view('admin.payments.coupons.create');
    }

    public function couponUsage()
    {
        return view('admin.payments.coupons.usage');
    }
}
