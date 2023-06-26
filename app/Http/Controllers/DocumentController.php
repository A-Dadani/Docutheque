<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index() {
        if (!Gate::allows('view-documents')) {
            abort(403);
        }

        $req = Document::latest();

        if (auth()->user()->department->name != 'blank') {
            $req->where('department_id', '=', auth()->user()['department_id']);
        }

        return view('documents.index', [
            'documents' => $req->filterBySender(request(['sender']))
                                ->filterByReceiver(request(['receiver']))
                                ->filterByObjet(request(['objet']))
                                ->filterByKeywords(request(['keywords']))
                                ->filterByDepartment(request(['department']))->paginate(10)
        ]);
    }

    public function destroy(Document $document) {
        if (!Gate::allows('delete-documents')) {
            abort(403);
        }

        if (auth()->user()->department->name != 'blank' 
            && auth()->user()['department_id'] != $document['department_id']) 
        {
            abort(403);
        }

        $document->delete();
        return back()->with('message', 'Document supprimé avec succès');
    }

    public function show(Document $document) {
        if (!Gate::allows('access-specific-document', $document)) {
            abort(403);
        }

        $path = $document->department->name .'/'. $document->id . '.pdf';
        $disk_private = storage_path('app/private/') . $path;
        if(Storage::disk('private')->exists($path)){
            $headers = [
                'Content-Type' => 'application/pdf'
            ];
            return response()->download($disk_private, "Teste File", $headers, 'inline');
        }
        abort(404);
    }
}
