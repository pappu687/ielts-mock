<?php

namespace App\Helpers;

class DataTableHelper
{
    /**
     * Get DataTable columns configuration for a given table
     *
     * @param string $table
     * @return array
     */
    public static function getColumns(string $table): array
    {
        $columns = [
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
                ['data' => 'title', 'name' => 'title', 'title' => 'Title'],
                ['data' => 'description', 'name' => 'description', 'title' => 'Description'],
                ['data' => 'question_count', 'name' => 'question_count', 'title' => 'Questions'],
                ['data' => 'is_active', 'name' => 'is_active', 'title' => 'Status'],
                ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Created At'],
                ['data' => 'actions', 'name' => 'actions', 'title' => 'Actions', 'orderable' => false, 'searchable' => false],
            ],
            'questions' => [
                ['data' => 'id', 'name' => 'id', 'title' => 'ID'],
                ['data' => 'question_text', 'name' => 'question_text', 'title' => 'Question'],
                ['data' => 'question_type', 'name' => 'question_type', 'title' => 'Type'],
                ['data' => 'difficulty', 'name' => 'difficulty', 'title' => 'Difficulty'],
                ['data' => 'is_approved', 'name' => 'is_approved', 'title' => 'Approved'],
                ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Created At'],
                ['data' => 'actions', 'name' => 'actions', 'title' => 'Actions', 'orderable' => false, 'searchable' => false],
            ],
            'reading_passages' => [
                ['data' => 'id', 'name' => 'id', 'title' => 'ID'],
                ['data' => 'title', 'name' => 'title', 'title' => 'Title'],
                ['data' => 'category', 'name' => 'category', 'title' => 'Category'],
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

        return $columns[$table] ?? [];
    }

    /**
     * Get DataTable options configuration
     *
     * @param string $table
     * @param string $ajaxUrl
     * @return array
     */
    public static function getOptions(string $table, string $ajaxUrl): array
    {
        return [
            'processing' => true,
            'serverSide' => true,
            'ajax' => $ajaxUrl,
            'columns' => self::getColumns($table),
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
