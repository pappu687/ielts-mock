<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FutureEnhancementController extends Controller
{
    public function configureAIStudyPlans(Request $request)
    {
        return view('admin.future.ai-study-plans');
    }

    public function aiStudyPlanEffectiveness()
    {
        return view('admin.future.ai-study-plans.effectiveness');
    }

    public function vrSettings(Request $request)
    {
        return view('admin.future.vr-settings');
    }

    public function blockchainCertificates(Request $request)
    {
        return view('admin.future.blockchain-certificates');
    }

    public function verifyCertificates()
    {
        return view('admin.future.blockchain-certificates.verify');
    }

    public function manageTutoring(Request $request)
    {
        return view('admin.future.live-tutoring');
    }

    public function monitorTutoring()
    {
        return view('admin.future.live-tutoring.monitor');
    }

    public function configureGroupStudy(Request $request)
    {
        return view('admin.future.group-study');
    }
}
