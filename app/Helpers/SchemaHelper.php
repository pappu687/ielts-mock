<?php
// app/Helpers/SchemaHelper.php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class SchemaHelper
{
    /**
     * Get the list of columns for a given table.
     *
     * @param string $tableName The name of the table
     * @return array List of column names
     * @throws \Exception If the table does not exist
     */
    public static function getTableColumns(string $tableName): array
    {
        try {
            // Check if table exists
            if (! Schema::hasTable($tableName)) {
                throw new \Exception("Table {$tableName} does not exist in the database.");
            }

            // Get column listing using Schema facade
            $columns = Schema::getColumnListing($tableName);

            // Filter out any sensitive columns if needed (e.g., password, remember_token)
            $excludedColumns = [ 'password', 'remember_token' ];
            $columns         = array_diff($columns, $excludedColumns);

            return array_values($columns);
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error("Failed to retrieve columns for table {$tableName}: {$e->getMessage()}");
            return [  ];
        }
    }

    /**
     * Get columns with their data types for a given table.
     *
     * @param string $tableName The name of the table
     * @return array Associative array of column names and their data types
     */
    public static function getTableColumnsWithTypes(string $tableName): array
    {
        try {
            if (! Schema::hasTable($tableName)) {
                throw new \Exception("Table {$tableName} does not exist in the database.");
            }

            // Use DB facade to get column details with types
            $columns = DB::getSchemaBuilder()->getColumns($tableName);

            $result = [  ];
            foreach ($columns as $column) {
                // Skip sensitive columns
                if (in_array($column[ 'name' ], [ 'password', 'remember_token' ])) {
                    continue;
                }
                $result[ $column[ 'name' ] ] = $column[ 'type' ];
            }

            return $result;
        } catch (\Exception $e) {
            Log::error("Failed to retrieve columns with types for table {$tableName}: {$e->getMessage()}");
            return [  ];
        }
    }

    /**
     * Convert field mapping to DataTable columns format
     *
     * @param array $fieldMapping
     * @return array
     */
    public static function convertFieldMappingToDataTableColumns(array $fieldMapping): array
    {
        $columns = [  ];
        foreach ($fieldMapping as $field => $config) {
            if ($config[ 'visible' ]) {
                $column = [
                    'data'  => $field,
                    'name'  => $field,
                    'title' => $config[ 'title' ],
                 ];

                if (isset($config[ 'orderable' ]) && ! $config[ 'orderable' ]) {
                    $column[ 'orderable' ] = false;
                }

                if (isset($config[ 'searchable' ]) && ! $config[ 'searchable' ]) {
                    $column[ 'searchable' ] = false;
                }

                $columns[  ] = $column;
            }
        }
        return $columns;
    }
}
