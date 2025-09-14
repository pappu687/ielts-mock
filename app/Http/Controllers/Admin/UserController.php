<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Helpers\SchemaHelper;
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
                'name'              => $userData[ 'first_name' ] . ' ' . $userData[ 'last_name' ],
                'email'             => $userData[ 'email' ],
                'password'          => Hash::make($tempPassword),
                'date_of_birth'     => $userData[ 'date_of_birth' ] ?? null,
                'phone'             => $userData[ 'phone' ] ?? null,
                'street'            => $userData[ 'street' ] ?? null,
                'landmark'          => $userData[ 'landmark' ] ?? null,
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
                ->with('error', 'Failed to create user. Please try again.');
        }
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
            $users = User::select([ 'id', 'phone','first_name', 'last_name', 'email', 'created_at', 'email_verified_at' ]);

            return DataTables::of($users)
                ->addColumn('status', function ($user) {
                    return $user->email_verified_at ?
                    '<span class="badge bg-success-transparent">Active</span>' :
                    '<span class="badge bg-warning-transparent">Pending</span>';
                })
                ->editColumn('email_verified_at', function ($user) {
                    return $user->email_verified_at ? 'Yes' : 'No';
                })
                ->editColumn('created_at', function ($user) {
                    return $user->created_at->format('Y-m-d H:i:s');
                })
                ->addColumn('actions', function ($user) {
                    $actions = '<div class="btn-group btn-group-sm" role="group">';
                    $actions .= '<a href="' . route('admin.users.show', $user->id) . '" class="btn btn-sm btn-info-light">View</a>';
                    $actions .= '<a href="' . route('admin.users.update', $user->id) . '" class="btn btn-sm btn-primary-light">Edit</a>';
                    $actions .= '<button type="button" class="btn btn-sm btn-warning-light" onclick="suspendUser(' . $user->id . ')">Suspend</button>';
                    $actions .= '<button type="button" class="btn btn-sm btn-danger-light" onclick="deactivateUser(' . $user->id . ')">Deactivate</button>';
                    $actions .= '</div>';
                    return $actions;
                })
                ->rawColumns([ 'status', 'actions', 'email_verified_at', 'created_at' ])
                ->make(true);
        }
    }
}
