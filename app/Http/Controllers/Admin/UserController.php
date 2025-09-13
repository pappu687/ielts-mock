<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Helpers\DataTableHelper;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index()
    {
        $columns = DataTableHelper::getColumns('users');
        return view('admin.users.index', compact('columns'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        return view('admin.users.store');
    }
    
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        return view('admin.users.update', compact('user'));
    }

    public function suspend(User $user)
    {
        return view('admin.users.suspend', compact('user'));
    }

    public function deactivate(User $user)
    {
        return view('admin.users.deactivate', compact('user'));
    }

    public function profile(User $user)
    {
        return view('admin.users.profile', compact('user'));
    }

    public function recentActivity()
    {
        return view('admin.users.recent-activity');
    }

    /**
     * Get users data for DataTable
     */
    public function listUsers(Request $request)
    {
        if ($request->ajax()) {
            $users = User::select(['id', 'name', 'email', 'created_at', 'email_verified_at']);
            
            return DataTables::of($users)
                ->addColumn('status', function ($user) {
                    return $user->email_verified_at ? 
                        '<span class="badge badge-success">Active</span>' : 
                        '<span class="badge badge-outline-warning">Pending</span>';
                })
                ->editColumn('email_verified_at', function ($user) {
                    return $user->email_verified_at ? 'Yes' : 'No';
                })
                ->editColumn('created_at', function ($user) {
                    return $user->created_at->format('Y-m-d H:i:s');
                })
                ->addColumn('actions', function ($user) {
                    $actions = '<div class="btn-group btn-group-sm" role="group">';
                    $actions .= '<a href="' . route('admin.users.show', $user->id) . '" class="btn btn-sm btn-outline-info">View</a>';
                    $actions .= '<a href="' . route('admin.users.update', $user->id) . '" class="btn btn-sm btn-outline-primary">Edit</a>';
                    $actions .= '<button type="button" class="btn btn-sm btn-outline-warning" onclick="suspendUser(' . $user->id . ')">Suspend</button>';
                    $actions .= '<button type="button" class="btn btn-sm btn-outline-danger" onclick="deactivateUser(' . $user->id . ')">Deactivate</button>';
                    $actions .= '</div>';
                    return $actions;
                })
                ->rawColumns(['status', 'actions', 'email_verified_at', 'created_at'])
                ->make(true);
        }
    }
}
