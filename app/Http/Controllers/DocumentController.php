<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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

        $disk_private = storage_path('app/private/') . $document->path;
        if(Storage::disk('private')->exists($document->path)){
            $response = response()->file($disk_private);

            $response->headers->set('Content-Disposition', 'inline; filename="' . $document->objet . '.pdf"' );
        
            return $response;
        }
        abort(404);
    }

    public function create() {
        if (!Gate::allows('create-documents')) {
            abort(403);
        }

        return view('documents.create',  ['departments' => DB::table('Departments')->get()]);
    }

    public function store(Request $request) {
        if (!Gate::allows('create-documents')) {
            abort(403);
        }

        $validator = Validator::make(request()->all(), [
            'objet' => 'required',
            'sender' => 'required',
            'receiver' => 'required',
            'date_transmission' => 'required',
            'keywords' => 'required',
            'doc' => ['required', 'mimes:pdf', 'max: 10240']
        ], [
            'objet.required' => 'L\'objet ne peut pas être vide',
            'sender.required' => 'Le destinateur ne peut pas être vide',
            'receiver.required' => 'Le destinataire ne peut pas être vide',
            'date_transmission.required' => 'Veuillez selectionner une date',
            'keywords.required' => 'Les mots clés ne peuvent pas être vides',
            'doc.required' => 'Veuillez selectionner un document',
            'doc.mimes' => 'Le document doit être un PDF',
            'doc.max' => 'Le document ne peut pas dépasser 10 Mo',
        ]);

        if ($validator->fails()) {
            return back()
                    ->withErrors($validator)
                    ->withInput();
        }

        $department = auth()->user()->department;

        if (auth()->user()->role == 'admin') {
            $department = Department::where('id', $request->all()['department_id'])->first();
        }

        $arrKeywords = explode(',', $request->all()['keywords']);
        $trimmedKeywordsArr = array_map('trim', $arrKeywords);
        $trimmedKeywordsStr = implode(',', $trimmedKeywordsArr);

        $request->merge([
            'path' => $request->file('doc')->store($department->name, 'private'),
            'user_id' => auth()->user()->id,
            'department_id' => $department->id,
            'keywords' => $trimmedKeywordsStr
        ]);

        Document::create($request->all());
        return redirect('/documents')->with('message', 'Document ajouté avec succès');
    }
}
