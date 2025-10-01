# DataTableHelper Usage Guide

The enhanced `DataTableHelper` now supports dynamic column generation from database tables with caching and column exclusion functionality.

## Features

1. **Dynamic Column Generation**: Automatically fetch columns from database tables
2. **Caching**: Column information is cached for 60 minutes by default
3. **Column Exclusion**: Exclude specific columns from the DataTable
4. **Backward Compatibility**: Static column definitions still work
5. **Custom Columns**: Support for computed columns like actions and counts

## Usage Examples

### 1. Dynamic Columns (Recommended)

```php
// Get all columns dynamically from the database table
$columns = DataTableHelper::getColumns('question_banks', [], true);

// Get dynamic columns with exclusions
$excludeColumns = ['created_by', 'updated_at', 'description'];
$columns = DataTableHelper::getColumns('question_banks', $excludeColumns, true);
```

### 2. Static Columns (Backward Compatibility)

```php
// Get static columns (existing behavior)
$columns = DataTableHelper::getColumns('question_banks');

// Get static columns with exclusions
$columns = DataTableHelper::getColumns('question_banks', ['created_by']);
```

### 3. DataTable Options

```php
// Dynamic columns with options
$options = DataTableHelper::getOptions(
    'question_banks', 
    route('admin.question-banks.list'), 
    ['created_by', 'updated_at'], 
    true
);

// Static columns with options (existing behavior)
$options = DataTableHelper::getOptions('question_banks', route('admin.question-banks.list'));
```

## Controller Implementation

### QuestionBankController Example

```php
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QuestionBank;
use App\Helpers\DataTableHelper;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class QuestionBankController extends Controller
{
    public function index()
    {
        // Option 1: Dynamic columns with exclusions (recommended)
        $excludeColumns = ['updated_at', 'created_by'];
        $columns = DataTableHelper::getColumns('question_banks', $excludeColumns, true);
        
        // Option 2: Static columns (backward compatibility)
        // $columns = DataTableHelper::getColumns('question_banks');
        
        // Option 3: Static columns with exclusions
        // $columns = DataTableHelper::getColumns('question_banks', ['created_by', 'updated_at']);
        
        return view('admin.question-banks.index', compact('columns'));
    }

    public function listQuestionBanks(Request $request)
    {
        if ($request->ajax()) {
            // Select columns that match the dynamic column structure
            $questionBanks = QuestionBank::select([
                'id', 'name', 'description', 'difficulty_level', 
                'skill_type', 'is_active', 'created_at'
            ]);
            
            return DataTables::of($questionBanks)
                ->addColumn('question_count', function ($questionBank) {
                    return $questionBank->questions()->count();
                })
                ->addColumn('is_active', function ($questionBank) {
                    return $questionBank->is_active ? 
                        '<span class="badge badge-success">Active</span>' : 
                        '<span class="badge badge-outline-danger">Inactive</span>';
                })
                ->editColumn('created_at', function ($questionBank) {
                    return $questionBank->created_at->format('Y-m-d H:i:s');
                })
                ->addColumn('actions', function ($questionBank) {
                    $actions = '<div class="btn-group btn-group-sm" role="group">';
                    $actions .= '<a href="#" class="btn btn-sm btn-outline-info">View</a>';
                    $actions .= '<a href="#" class="btn btn-sm btn-outline-primary">Edit</a>';
                    $actions .= '<button type="button" class="btn btn-sm btn-outline-warning" onclick="toggleActive(' . $questionBank->id . ')">Toggle</button>';
                    $actions .= '<button type="button" class="btn btn-sm btn-outline-danger" onclick="deleteQuestionBank(' . $questionBank->id . ')">Delete</button>';
                    $actions .= '</div>';
                    return $actions;
                })
                ->rawColumns(['is_active', 'actions'])
                ->make(true);
        }
    }
}
```

## Cache Management

### Clear Cache for Specific Table

```php
// Clear cache for question_banks table
DataTableHelper::clearColumnsCache('question_banks');
```

### Clear All DataTable Caches

```php
// Clear all DataTable column caches
DataTableHelper::clearAllColumnsCache();
```

### Custom Cache Duration

```php
// Get dynamic columns with custom cache duration (120 minutes)
$columns = DataTableHelper::getDynamicColumns('question_banks', [], 120);
```

## Column Configuration

### Automatic Column Properties

The helper automatically determines:
- **Orderable**: Most columns are orderable except `description`, `notes`, `content`, `body`
- **Searchable**: Most columns are searchable except `password`, `remember_token`, `email_verified_at`
- **Title Formatting**: Snake_case columns are converted to Title Case

### Custom Column Titles

Special cases are handled automatically:
- `id` → "ID"
- `is_active` → "Status"
- `created_at` → "Created At"
- `updated_at` → "Updated At"
- `created_by` → "Created By"

### Custom Columns

Custom columns are automatically added for specific tables:
- `question_banks`: Adds `question_count` and `actions` columns
- `users`: Adds `actions` column
- Other tables: Adds `actions` column by default

## Benefits

1. **Maintainability**: No need to manually update column definitions when database schema changes
2. **Performance**: Cached column information reduces database queries
3. **Flexibility**: Easy to exclude sensitive or unnecessary columns
4. **Consistency**: Automatic title formatting and column properties
5. **Backward Compatibility**: Existing code continues to work without changes

## Migration Guide

To migrate from static to dynamic columns:

1. Update controller method calls:
   ```php
   // Old
   $columns = DataTableHelper::getColumns('question_banks');
   
   // New
   $columns = DataTableHelper::getColumns('question_banks', [], true);
   ```

2. Update DataTable query to match actual table columns
3. Test to ensure all columns display correctly
4. Consider excluding sensitive columns using the exclusion parameter

