<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ListeningAudio;
use App\Helpers\DataTableHelper;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ListeningAudioController extends Controller
{
    public function index()
    {
        $columns = DataTableHelper::getColumns('listening_audios');
        return view('admin.listening-audios.index', compact('columns'));
    }

    public function store(Request $request)
    {
        return view('admin.listening-audios.store');
    }

    public function update(Request $request, ListeningAudio $listeningAudio)
    {
        return view('admin.listening-audios.update', compact('listeningAudio'));
    }

    public function updateTranscript(Request $request, ListeningAudio $listeningAudio)
    {
        return view('admin.listening-audios.transcript', compact('listeningAudio'));
    }

    /**
     * Get listening audios data for DataTable
     */
    public function listListeningAudios(Request $request)
    {
        if ($request->ajax()) {
            $listeningAudios = ListeningAudio::select(['id', 'title', 'duration_seconds', 'difficulty_level', 'question_count', 'created_at']);
            
            return DataTables::of($listeningAudios)
                ->addColumn('duration_seconds', function ($listeningAudio) {
                    return $listeningAudio->duration_seconds ? gmdate('i:s', $listeningAudio->duration_seconds) : 'N/A';
                })
                ->addColumn('question_count', function ($listeningAudio) {
                    return $listeningAudio->question_count ? number_format($listeningAudio->question_count) : 'N/A';
                })
                ->editColumn('created_at', function ($listeningAudio) {
                    return $listeningAudio->created_at->format('Y-m-d H:i:s');
                })
                ->addColumn('actions', function ($listeningAudio) {
                    $actions = '<div class="btn-group btn-group-sm" role="group">';
                    $actions .= '<a href="#" class="btn btn-sm btn-outline-info">View</a>';
                    $actions .= '<a href="#" class="btn btn-sm btn-outline-primary">Edit</a>';
                    $actions .= '<button type="button" class="btn btn-sm btn-outline-warning" onclick="updateTranscript(' . $listeningAudio->id . ')">Transcript</button>';
                    $actions .= '<button type="button" class="btn btn-sm btn-outline-danger" onclick="deleteAudio(' . $listeningAudio->id . ')">Delete</button>';
                    $actions .= '</div>';
                    return $actions;
                })
                ->rawColumns(['actions', 'duration_seconds', 'question_count', 'created_at'])
                ->make(true);
        }
    }
}
