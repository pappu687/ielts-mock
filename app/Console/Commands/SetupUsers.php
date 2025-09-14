<?php
namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SetupUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:setup {--fresh : Delete existing data and start fresh}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup Application with roles, permissions, and demo users';

    /**
     * Define permissions for the IELTS system
     */
    protected $permissions = [
        // User Management
        'view users',
        'create users',
        'edit users',
        'delete users',

        // Role & Permission Management
        'view roles',
        'create roles',
        'edit roles',
        'delete roles',
        'assign roles',

        // Test Management
        'view tests',
        'create tests',
        'edit tests',
        'delete tests',
        'publish tests',

        // Test Taking
        'take tests',
        'view own results',
        'retake tests',

        // Grading & Results
        'grade tests',
        'view all results',
        'export results',
        'modify results',

        // Content Management
        'manage content',
        'view content',
        'upload materials',

        // System Settings
        'view settings',
        'edit settings',
        'view logs',

        // Reports & Analytics
        'view reports',
        'export reports',
        'view analytics',
     ];

    /**
     * Define roles and their permissions
     */
    protected $rolePermissions = [
        'super-admin' => 'all', // Will get all permissions

        'admin'       => [
            'view users', 'create users', 'edit users', 'delete users',
            'view roles', 'assign roles',
            'view tests', 'create tests', 'edit tests', 'delete tests', 'publish tests',
            'grade tests', 'view all results', 'export results', 'modify results',
            'manage content', 'view content', 'upload materials',
            'view settings', 'edit settings', 'view logs',
            'view reports', 'export reports', 'view analytics',
         ],

        'instructor'  => [
            'view users',
            'view tests', 'create tests', 'edit tests', 'publish tests',
            'grade tests', 'view all results', 'export results',
            'manage content', 'view content', 'upload materials',
            'view reports', 'export reports',
         ],

        'student'     => [
            'take tests', 'view own results', 'retake tests',
            'view content',
         ],

        'guest'       => [
            'take tests', 'view content',
         ],
     ];

    /**
     * Demo users to create
     */
    protected $demoUsers = [
        [
            'first_name' => 'Super',
            'last_name'  => 'Admin',
            'email'      => 'superadmin@ielts.test',
            'password'   => 'password123',
            'role'       => 'super-admin',
         ],
        [
            'first_name' => 'System',
            'last_name'  => 'Admin',
            'email'      => 'admin@ielts.test',
            'password'   => 'password123',
            'role'       => 'admin',
         ],
        [
            'first_name' => 'John',
            'last_name'  => 'Instructor',
            'email'      => 'instructor@ielts.test',
            'password'   => 'password123',
            'role'       => 'instructor',
         ],
        [
            'first_name' => 'Jane',
            'last_name'  => 'Student',
            'email'      => 'student@ielts.test',
            'password'   => 'password123',
            'role'       => 'student',
         ],
        [
            'first_name' => 'Guest',
            'last_name'  => 'User',
            'email'      => 'guest@ielts.test',
            'password'   => 'password123',
            'role'       => 'guest',
         ],
     ];

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🚀 Setting up Application ...');

        if ($this->option('fresh')) {
            $this->handleFreshSetup();
        }

        DB::beginTransaction();

        try {
            // Create permissions
            $this->createPermissions();

            // Create roles
            $this->createRoles();

            // Assign permissions to roles
            $this->assignPermissionsToRoles();

            // Create demo users
            $this->createDemoUsers();

            DB::commit();

            $this->info('✅ Application setup completed successfully!');
            $this->displaySummary();

        } catch (\Exception $e) {
            DB::rollBack();
            $this->error('❌ Setup failed: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }

    /**
     * Handle fresh setup by clearing existing data
     */
    protected function handleFreshSetup()
    {
        if ($this->confirm('This will delete all existing roles, permissions, and demo users. Continue?')) {
            $this->info('🧹 Cleaning existing data...');

            // Delete demo users
            foreach ($this->demoUsers as $userData) {
                User::where('email', $userData[ 'email' ])->delete();
            }

            // Delete roles and permissions
            foreach (array_keys($this->rolePermissions) as $roleName) {
                Role::where('name', $roleName)->delete();
            }

            foreach ($this->permissions as $permissionName) {
                Permission::where('name', $permissionName)->delete();
            }

            $this->info('✅ Cleanup completed');
        } else {
            $this->info('Setup cancelled');
            return 1;
        }
    }

    /**
     * Create permissions if they don't exist
     */
    protected function createPermissions()
    {
        $this->info('📋 Creating permissions...');

        foreach ($this->permissions as $permission) {
            if (! Permission::where('name', $permission)->exists()) {
                Permission::create([ 'name' => $permission, 'guard_name' => 'web' ]);
                $this->line("  ✓ Created permission: {$permission}");
            } else {
                $this->line("  - Permission already exists: {$permission}");
            }
        }
    }

    /**
     * Create roles if they don't exist
     */
    protected function createRoles()
    {
        $this->info('👥 Creating roles...');

        foreach (array_keys($this->rolePermissions) as $roleName) {
            if (! Role::where('name', $roleName)->exists()) {
                Role::create([ 'name' => $roleName, 'guard_name' => 'web' ]);
                $this->line("  ✓ Created role: {$roleName}");
            } else {
                $this->line("  - Role already exists: {$roleName}");
            }
        }
    }

    /**
     * Assign permissions to roles
     */
    protected function assignPermissionsToRoles()
    {
        $this->info('🔐 Assigning permissions to roles...');

        foreach ($this->rolePermissions as $roleName => $permissions) {
            $role = Role::where('name', $roleName)->first();

            if ($permissions === 'all') {
                $role->syncPermissions(Permission::all());
                $this->line("  ✓ Assigned ALL permissions to: {$roleName}");
            } else {
                $role->syncPermissions($permissions);
                $this->line("  ✓ Assigned " . count($permissions) . " permissions to: {$roleName}");
            }
        }
    }

    /**
     * Create demo users
     */
    protected function createDemoUsers()
    {
        $this->info('👤 Creating demo users...');

        foreach ($this->demoUsers as $userData) {
            $user = User::where('email', $userData[ 'email' ])->first();

            if (! $user) {
                $user = User::create([
                    'first_name'        => $userData[ 'first_name' ],
                    'last_name'         => $userData[ 'last_name' ],
                    'email'             => $userData[ 'email' ],
                    'email_verified_at' => now(),
                    'password'          => Hash::make($userData[ 'password' ]),
                 ]);
                $this->line("  ✓ Created user: {$userData[ 'email' ]}");
            } else {
                $this->line("  - User already exists: {$userData[ 'email' ]}");
            }

            // Assign role to user
            if (! $user->hasRole($userData[ 'role' ])) {
                $user->assignRole($userData[ 'role' ]);
                $this->line("    ✓ Assigned role '{$userData[ 'role' ]}' to {$userData[ 'email' ]}");
            }
        }
    }

    /**
     * Display setup summary
     */
    protected function displaySummary()
    {
        $this->newLine();
        $this->info('📊 Setup Summary:');
        $this->table(
            [ 'Component', 'Count', 'Details' ],
            [
                [ 'Permissions', count($this->permissions), 'System permissions created' ],
                [ 'Roles', count($this->rolePermissions), 'User roles with permissions' ],
                [ 'Demo Users', count($this->demoUsers), 'Ready-to-use test accounts' ],
             ]
        );

        $this->newLine();
        $this->info('🔑 Demo User Credentials:');
        $this->table(
            [ 'Email', 'Password', 'Role' ],
            collect($this->demoUsers)->map(function ($user) {
                return [ $user[ 'email' ], $user[ 'password' ], $user[ 'role' ] ];
            })->toArray()
        );

        $this->newLine();
        $this->warn('⚠️  Important: Change default passwords in production!');
        $this->info('💡 Run with --fresh flag to reset everything: php artisan app:setup --fresh');
    }
}
