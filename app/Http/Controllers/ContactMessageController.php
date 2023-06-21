<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;

class ContactMessageController extends Controller
{
    public function index() {
        if (!Gate::allows('view-messages')) {
            abort(403);
        }

        return view('messages.index', [
            'messages' => ContactMessage::latest()->filter(request(['search']))->get(),
        ]);
    }

    public function store(Request $request) {
        $validator = Validator::make(request()->all(), [
            'full_name' => 'required',
            'email' => 'required',
            'objet' => 'required',
            'message' => 'required'
        ], [
            'full_name.required' => 'Le nom ne peut pas être vide',
            'email.required' => 'L\'email ne peut pas être vide',
            'objet.required' => 'L\'objet ne peut pas être vide',
            'message.required' => 'Le message ne peut pas être vide',
        ]);

        if ($validator->fails()) {
            return redirect('/#contacternous')
                    ->withErrors($validator)
                    ->withInput();
        }
        ContactMessage::create($request->all());
        return redirect('/#contacternous')->with('message', 'Message envoyé!');
    }
}
