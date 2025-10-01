<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReadingPassage;
use App\Helpers\DataTableHelper;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ReadingPassageController extends Controller
{
    public function index()
    {
        $columns = DataTableHelper::getColumns('reading_passages');
        return view('admin.reading-passages.index', compact('columns'));
    }

    public function store(Request $request)
    {
        return view('admin.reading-passages.store');
    }

    public function update(Request $request, ReadingPassage $readingPassage)
    {
        return view('admin.reading-passages.update', compact('readingPassage'));
    }

    public function categorize(Request $request, ReadingPassage $readingPassage)
    {
        return view('admin.reading-passages.categorize', compact('readingPassage'));
    }

    /**
     * Get reading passages data for DataTable
     */
    public function listReadingPassages(Request $request)
    {
        if ($request->ajax()) {
            $readingPassages = ReadingPassage::select(['id', 'title', 'topic_category', 'word_count', 'difficulty_level', 'created_at']);
            
            return DataTables::of($readingPassages)
                ->addColumn('word_count', function ($readingPassage) {
                    return number_format($readingPassage->word_count ?? 0);
                })
                ->editColumn('created_at', function ($readingPassage) {
                    return $readingPassage->created_at->format('Y-m-d H:i:s');
                })
                ->addColumn('actions', function ($readingPassage) {
                    $actions = '<div class="btn-group btn-group-sm" role="group">';
                    $actions .= '<a href="#" class="btn btn-sm btn-outline-info">View</a>';
                    $actions .= '<a href="#" class="btn btn-sm btn-outline-primary">Edit</a>';
                    $actions .= '<button type="button" class="btn btn-sm btn-outline-warning" onclick="categorizePassage(' . $readingPassage->id . ')">Categorize</button>';
                    $actions .= '<button type="button" class="btn btn-sm btn-outline-danger" onclick="deletePassage(' . $readingPassage->id . ')">Delete</button>';
                    $actions .= '</div>';
                    return $actions;
                })
                ->rawColumns(['actions', 'word_count', 'created_at'])
                ->make(true);
        }
    }
}
