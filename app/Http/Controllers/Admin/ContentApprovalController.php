<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContentApprovalController extends Controller
{
    public function pending()
    {
        return view('admin.content-approval.pending');
    }

    public function approve(Request $request)
    {
        return view('admin.content-approval.approve');
    }

    public function reject(Request $request)
    {
        return view('admin.content-approval.reject');
    }

    public function approved()
    {
        return view('admin.content-approval.approved');
    }

    public function revert(Request $request)
    {
        return view('admin.content-approval.revert');
    }

    public function rejected()
    {
        return view('admin.content-approval.rejected');
    }
}
