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
            $listeningAudios = ListeningAudio::select(['id', 'title', 'duration', 'difficulty_level', 'file_size', 'created_at']);
            
            return DataTables::of($listeningAudios)
                ->addColumn('duration', function ($listeningAudio) {
                    return $listeningAudio->duration ? gmdate('i:s', $listeningAudio->duration) : 'N/A';
                })
                ->addColumn('file_size', function ($listeningAudio) {
                    return $listeningAudio->file_size ? number_format($listeningAudio->file_size / 1024, 2) . ' KB' : 'N/A';
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
                ->rawColumns(['actions', 'duration', 'file_size', 'created_at'])
                ->make(true);
        }
    }
}
