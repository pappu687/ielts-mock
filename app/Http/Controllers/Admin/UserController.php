<?php
namespace App\Http\Controllers\Admin;

use App\Helpers\SchemaHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    protected static $field_mapping = [
        'id'         => [ 'title' => 'ID', 'visible' => false, 'orderable' => false, 'searchable' => false ],
        'first_name' => [ 'title' => 'First Name', 'visible' => true, 'orderable' => true, 'searchable' => true ],
        'last_name'  => [ 'title' => 'Last Name', 'visible' => true, 'orderable' => true, 'searchable' => true ],
        'email'      => [ 'title' => 'Email', 'visible' => true, 'orderable' => true, 'searchable' => true ],
        'phone'      => [ 'title' => 'Phone', 'visible' => true, 'orderable' => true, 'searchable' => true ],
        'created_at' => [ 'title' => 'Created At', 'visible' => true, 'orderable' => true, 'searchable' => true ],
        'status'     => [ 'title' => 'Status', 'visible' => true, 'orderable' => true, 'searchable' => true ],
        'actions'    => [ 'title' => 'Actions', 'visible' => true, 'orderable' => false, 'searchable' => false ],
     ];

    public function index()
    {
        $columns = SchemaHelper::convertFieldMappingToDataTableColumns(self::$field_mapping);

        return view('admin.users.index', compact('columns'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(StoreUserRequest $request)
    {
        try {
            // Prepare user data
            $userData = $request->validated();

            // Generate a temporary password
            $tempPassword = Str::random(12);

            // Create the user
            $user = User::create([
                'first_name'        => $userData[ 'first_name' ],
                'last_name'         => $userData[ 'last_name' ],
                'email'             => $userData[ 'email' ],
                'password'          => Hash::make($tempPassword),
                'date_of_birth'     => $userData[ 'date_of_birth' ] ?? null,
                'phone'             => $userData[ 'phone' ] ?? null,
                'street'            => $userData[ 'street' ] ?? null,
                'city'              => $userData[ 'city' ] ?? null,
                'state'             => $userData[ 'state' ] ?? null,
                'postal_code'       => $userData[ 'postal_code' ] ?? null,
                'country'           => $userData[ 'country' ] ?? null,
                'email_verified_at' => null, // User needs to verify email
             ]);

            // Send activation email if requested
            if ($request->has('send_activation_email') && $request->send_activation_email) {
                // TODO: Implement email sending logic here
                // For now, we'll just log that it was requested
                \Log::info("Activation email requested for user: {$user->email}");
            }

            return redirect()->route('admin.users.index')
                ->with('success', 'User created successfully!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create user. Please try again.' . $e->getMessage());
        }
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('admin.users.update', compact('user'));
    }

    public function trashed()
    {
        $columns = SchemaHelper::convertFieldMappingToDataTableColumns(self::$field_mapping);
        return view('admin.users.trashed', compact('columns'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            $data = $request->validated();

            $user->update([
                'first_name'    => $data[ 'first_name' ],
                'last_name'     => $data[ 'last_name' ],
                'email'         => $data[ 'email' ],
                'date_of_birth' => $data[ 'date_of_birth' ] ?? null,
                'phone'         => $data[ 'phone' ] ?? null,
                'street'        => $data[ 'street' ] ?? null,
                'city'          => $data[ 'city' ] ?? null,
                'state'         => $data[ 'state' ] ?? null,
                'postal_code'   => $data[ 'postal_code' ] ?? null,
                'country'       => $data[ 'country' ] ?? null,
             ]);

            return redirect()->route('admin.users.show', $user->id)
                ->with('success', 'User updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to update user. Please try again.' . $e->getMessage());
        }
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
            $users = User::select([ 'id', 'first_name', 'last_name', 'phone', 'email', 'created_at', 'email_verified_at', 'suspended_at', 'deactivated_at' ])
                ->with('roles:name');

            if ($request->boolean('trashed')) {
                $users->onlyTrashed();
            }

            return DataTables::of($users)
                ->addColumn('status', function ($user) {
                    if ($user->deactivated_at) {
                        return '<span class="badge fw-normal bg-danger-transparent">Deactivated</span>';
                    } elseif ($user->suspended_at) {
                        return '<span class="badge fw-normal bg-warning-transparent">Suspended</span>';
                    } elseif ($user->email_verified_at) {
                        return '<span class="badge fw-normal bg-success-transparent">Active</span>';
                    } else {
                        return '<span class="badge fw-normal bg-secondary-transparent">Pending</span>';
                    }
                })
                ->editColumn('roles', function ($user) {
                    $role_pass = "";
                    foreach ($user->roles as $role) {
                        $role_pass = $role_pass . ucfirst($role->name) . ", ";
                    }
                    return '<span class="badge bg-indigo fs-10 fw-normal">' . ucfirst(rtrim($role_pass, ", ")) . '</span>';
                })
                ->editColumn('email_verified_at', function ($user) {
                    return $user->email_verified_at ? 'Yes' : 'No';
                })
                ->editColumn('created_at', function ($user) {
                    return $user->created_at->format('M d,Y');
                })
                ->addColumn('actions', function ($user) use ($request) {
                    $actions = '<div class="btn-group btn-group-sm">';

                    // Primary action button (View)
                    $actions .= '<a href="' . route('admin.users.show', $user->id) . '" class="btn btn-primary">View</a>';

                    // Dropdown toggle button
                    $actions .= '<button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split me-2" data-bs-toggle="dropdown" aria-expanded="false">';
                    $actions .= '<span class="visually-hidden">Toggle Dropdown</span>';
                    $actions .= '</button>';

                    // Dropdown menu
                    $actions .= '<ul class="dropdown-menu dropdown-menu-end">';

                    if ($request->boolean('trashed')) {
                        // Trashed actions
                        $actions .= '<li><a class="dropdown-item" href="javascript:void(0);" onclick="restoreUser(' . $user->id . ')">Restore</a></li>';
                        $actions .= '<li><a class="dropdown-item text-danger" href="javascript:void(0);" onclick="forceDeleteUser(' . $user->id . ')">Delete Permanently</a></li>';
                    } else {
                        // Edit option (only if user is not deactivated)
                        if (! $user->deactivated_at) {
                            $actions .= '<li><a class="dropdown-item" href="' . route('admin.users.edit', $user->id) . '">Edit</a></li>';
                        }
                        // Only show suspend/delete options if not current user
                        if ($user->id !== auth()->id()) {
                            if (! $user->suspended_at) {
                                $actions .= '<li><a class="dropdown-item" href="javascript:void(0);" onclick="suspendUser(' . $user->id . ')">Suspend</a></li>';
                            }
                            $actions .= '<li><a class="dropdown-item text-danger" href="javascript:void(0);" onclick="deleteUser(' . $user->id . ')">Delete</a></li>';
                        }
                    }

                    $actions .= '</ul>';
                    $actions .= '</div>';

                    return $actions;
                })
                ->rawColumns([ 'status', 'roles', 'actions', 'email_verified_at', 'created_at' ])
                ->make(true);
        }
    }

}
