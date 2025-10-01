<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class DataTableHelper
{
    /**
     * Get DataTable columns configuration for a given table
     * This method now supports both static and dynamic column generation
     *
     * @param string $table
     * @param array $excludeColumns
     * @param bool $useDynamicColumns
     * @return array
     */
    public static function getColumns(string $table, array $excludeColumns = [], bool $useDynamicColumns = false): array
    {
        if ($useDynamicColumns) {
            return self::getDynamicColumns($table, $excludeColumns);
        }

        // Fallback to static columns for backward compatibility
        $staticColumns = [
            'users' => [
                ['data' => 'id', 'name' => 'id', 'title' => 'ID'],
                ['data' => 'name', 'name' => 'name', 'title' => 'Name'],
                ['data' => 'email', 'name' => 'email', 'title' => 'Email'],
                ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Created At'],
                ['data' => 'status', 'name' => 'status', 'title' => 'Status'],
                ['data' => 'actions', 'name' => 'actions', 'title' => 'Actions', 'orderable' => false, 'searchable' => false],
            ],
            'question_banks' => [
                ['data' => 'id', 'name' => 'id', 'title' => 'ID'],
                ['data' => 'name', 'name' => 'name', 'title' => 'Name'],
                ['data' => 'description', 'name' => 'description', 'title' => 'Description'],
                ['data' => 'difficulty_level', 'name' => 'difficulty_level', 'title' => 'Difficulty'],
                ['data' => 'skill_type', 'name' => 'skill_type', 'title' => 'Skill Type'],
                ['data' => 'question_count', 'name' => 'question_count', 'title' => 'Questions'],
                ['data' => 'is_active', 'name' => 'is_active', 'title' => 'Status'],
                ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Created At'],
                ['data' => 'actions', 'name' => 'actions', 'title' => 'Actions', 'orderable' => false, 'searchable' => false],
            ],
            'questions' => [
                ['data' => 'id', 'name' => 'id', 'title' => 'ID'],
                ['data' => 'question_text', 'name' => 'question_text', 'title' => 'Question'],
                ['data' => 'question_type', 'name' => 'question_type', 'title' => 'Type'],                
                ['data' => 'is_approved', 'name' => 'is_approved', 'title' => 'Approved'],
                ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Created At'],
                ['data' => 'actions', 'name' => 'actions', 'title' => 'Actions', 'orderable' => false, 'searchable' => false],
            ],
            'reading_passages' => [
                ['data' => 'id', 'name' => 'id', 'title' => 'ID'],
                ['data' => 'title', 'name' => 'title', 'title' => 'Title'],
                ['data' => 'topic_category', 'name' => 'topic_category', 'title' => 'Category'],
                ['data' => 'word_count', 'name' => 'word_count', 'title' => 'Word Count'],
                ['data' => 'difficulty_level', 'name' => 'difficulty_level', 'title' => 'Difficulty'],
                ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Created At'],
                ['data' => 'actions', 'name' => 'actions', 'title' => 'Actions', 'orderable' => false, 'searchable' => false],
            ],
            'listening_audios' => [
                ['data' => 'id', 'name' => 'id', 'title' => 'ID'],
                ['data' => 'title', 'name' => 'title', 'title' => 'Title'],
                ['data' => 'duration', 'name' => 'duration', 'title' => 'Duration'],
                ['data' => 'difficulty_level', 'name' => 'difficulty_level', 'title' => 'Difficulty'],
                ['data' => 'file_size', 'name' => 'file_size', 'title' => 'File Size'],
                ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Created At'],
                ['data' => 'actions', 'name' => 'actions', 'title' => 'Actions', 'orderable' => false, 'searchable' => false],
            ],
            'writing_prompts' => [
                ['data' => 'id', 'name' => 'id', 'title' => 'ID'],
                ['data' => 'title', 'name' => 'title', 'title' => 'Title'],
                ['data' => 'task_type', 'name' => 'task_type', 'title' => 'Task Type'],
                ['data' => 'difficulty_level', 'name' => 'difficulty_level', 'title' => 'Difficulty'],
                ['data' => 'word_limit', 'name' => 'word_limit', 'title' => 'Word Limit'],
                ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Created At'],
                ['data' => 'actions', 'name' => 'actions', 'title' => 'Actions', 'orderable' => false, 'searchable' => false],
            ],
            'speaking_questions' => [
                ['data' => 'id', 'name' => 'id', 'title' => 'ID'],
                ['data' => 'question_text', 'name' => 'question_text', 'title' => 'Question'],
                ['data' => 'part', 'name' => 'part', 'title' => 'Part'],
                ['data' => 'difficulty_level', 'name' => 'difficulty_level', 'title' => 'Difficulty'],
                ['data' => 'preparation_time', 'name' => 'preparation_time', 'title' => 'Prep Time'],
                ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Created At'],
                ['data' => 'actions', 'name' => 'actions', 'title' => 'Actions', 'orderable' => false, 'searchable' => false],
            ],
            'exam_types' => [
                ['data' => 'id', 'name' => 'id', 'title' => 'ID'],
                ['data' => 'name', 'name' => 'name', 'title' => 'Name'],
                ['data' => 'description', 'name' => 'description', 'title' => 'Description'],
                ['data' => 'duration', 'name' => 'duration', 'title' => 'Duration'],
                ['data' => 'price', 'name' => 'price', 'title' => 'Price'],
                ['data' => 'is_active', 'name' => 'is_active', 'title' => 'Status'],
                ['data' => 'actions', 'name' => 'actions', 'title' => 'Actions', 'orderable' => false, 'searchable' => false],
            ],
        ];

        $columns = $staticColumns[$table] ?? [];
        
        // Filter out excluded columns
        if (!empty($excludeColumns)) {
            $columns = array_filter($columns, function ($column) use ($excludeColumns) {
                return !in_array($column['data'], $excludeColumns);
            });
        }

        return array_values($columns);
    }

    /**
     * Get columns dynamically from database table with caching
     *
     * @param string $table
     * @param array $excludeColumns
     * @param int $cacheMinutes
     * @return array
     */
    public static function getDynamicColumns(string $table, array $excludeColumns = [], int $cacheMinutes = 60): array
    {
        $cacheKey = "datatable_columns_{$table}";
        
        return Cache::remember($cacheKey, $cacheMinutes, function () use ($table, $excludeColumns) {
            try {
                // Get table columns from database schema
                $columns = Schema::getColumnListing($table);
                
                if (empty($columns)) {
                    return [];
                }

                $dataTableColumns = [];
                
                foreach ($columns as $column) {
                    // Skip excluded columns
                    if (in_array($column, $excludeColumns)) {
                        continue;
                    }

                    $dataTableColumns[] = [
                        'data' => $column,
                        'name' => $column,
                        'title' => self::formatColumnTitle($column),
                        'orderable' => self::isOrderable($column),
                        'searchable' => self::isSearchable($column),
                    ];
                }

                // Add custom columns (like actions, counts, etc.)
                $customColumns = self::getCustomColumns($table);
                $dataTableColumns = array_merge($dataTableColumns, $customColumns);

                return $dataTableColumns;
                
            } catch (\Exception $e) {
                // Fallback to static columns if dynamic fails
                \Log::warning("Failed to get dynamic columns for table {$table}: " . $e->getMessage());
                return self::getColumns($table, $excludeColumns, false);
            }
        });
    }

    /**
     * Format column name to a human-readable title
     *
     * @param string $column
     * @return string
     */
    private static function formatColumnTitle(string $column): string
    {
        // Handle special cases
        $specialCases = [
            'id' => 'ID',
            'is_active' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
        ];

        if (isset($specialCases[$column])) {
            return $specialCases[$column];
        }

        // Convert snake_case to Title Case
        return ucwords(str_replace(['_', '-'], ' ', $column));
    }

    /**
     * Determine if a column should be orderable
     *
     * @param string $column
     * @return bool
     */
    private static function isOrderable(string $column): bool
    {
        $nonOrderableColumns = ['description', 'notes', 'content', 'body'];
        return !in_array($column, $nonOrderableColumns);
    }

    /**
     * Determine if a column should be searchable
     *
     * @param string $column
     * @return bool
     */
    private static function isSearchable(string $column): bool
    {
        $nonSearchableColumns = ['password', 'remember_token', 'email_verified_at'];
        return !in_array($column, $nonSearchableColumns);
    }

    /**
     * Get custom columns that are not in the database table
     *
     * @param string $table
     * @return array
     */
    private static function getCustomColumns(string $table): array
    {
        $customColumns = [
            'question_banks' => [
                [
                    'data' => 'question_count',
                    'name' => 'question_count',
                    'title' => 'Questions',
                    'orderable' => false,
                    'searchable' => false,
                ],
                [
                    'data' => 'actions',
                    'name' => 'actions',
                    'title' => 'Actions',
                    'orderable' => false,
                    'searchable' => false,
                ],
            ],
            'users' => [
                [
                    'data' => 'actions',
                    'name' => 'actions',
                    'title' => 'Actions',
                    'orderable' => false,
                    'searchable' => false,
                ],
            ],
        ];

        return $customColumns[$table] ?? [
            [
                'data' => 'actions',
                'name' => 'actions',
                'title' => 'Actions',
                'orderable' => false,
                'searchable' => false,
            ],
        ];
    }

    /**
     * Clear cache for a specific table's columns
     *
     * @param string $table
     * @return void
     */
    public static function clearColumnsCache(string $table): void
    {
        Cache::forget("datatable_columns_{$table}");
    }

    /**
     * Clear all DataTable column caches
     *
     * @return void
     */
    public static function clearAllColumnsCache(): void
    {
        // This is a simple approach - in production you might want to use cache tags
        $tables = ['question_banks', 'users', 'questions', 'reading_passages', 'listening_audios', 'writing_prompts', 'speaking_questions', 'exam_types'];
        
        foreach ($tables as $table) {
            self::clearColumnsCache($table);
        }
    }

    /**
     * Get DataTable options configuration
     *
     * @param string $table
     * @param string $ajaxUrl
     * @param array $excludeColumns
     * @param bool $useDynamicColumns
     * @return array
     */
    public static function getOptions(string $table, string $ajaxUrl, array $excludeColumns = [], bool $useDynamicColumns = false): array
    {
        return [
            'processing' => true,
            'serverSide' => true,
            'ajax' => $ajaxUrl,
            'columns' => self::getColumns($table, $excludeColumns, $useDynamicColumns),
            'order' => [[0, 'desc']],
            'pageLength' => 25,
            'lengthMenu' => [[10, 25, 50, 100], [10, 25, 50, 100]],
            'dom' => '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' .
                     '<"row"<"col-sm-12"tr>>' .
                     '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
            'language' => [
                'processing' => 'Loading...',
                'lengthMenu' => 'Show _MENU_ entries',
                'zeroRecords' => 'No matching records found',
                'info' => 'Showing _START_ to _END_ of _TOTAL_ entries',
                'infoEmpty' => 'Showing 0 to 0 of 0 entries',
                'infoFiltered' => '(filtered from _MAX_ total entries)',
                'search' => 'Search:',
                'paginate' => [
                    'first' => 'First',
                    'last' => 'Last',
                    'next' => 'Next',
                    'previous' => 'Previous'
                ]
            ]
        ];
    }
}
