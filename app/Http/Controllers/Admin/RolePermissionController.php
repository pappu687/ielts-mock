<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class RolePermissionController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    public function storeRole(Request $request)
    {
        return view('admin.roles.store');
    }

    public function updateRole(Request $request, $role)
    {
        return view('admin.roles.update', compact('role'));
    }

    public function assignPermissions(Request $request)
    {
        return view('admin.permissions.assign');
    }
}
