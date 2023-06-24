<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login() {
        return view('Users.login');
    }

    public function authenticate(Request $request) {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (auth()->attempt($formFields)) {
            $request->session()->regenerate();
            if (!auth()->user()->confirmed) {
                auth()->logout();
        
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect('/login')->withErrors(['email' => 'Votre compte n\'est pas encore vérifié. Contactez votre adiministrateur pour plus d\'informations.'])->onlyInput('email');
            }
            return redirect('/')->with('message', 'Vous êtes connecté(e)s!');
        }

        return back()->withErrors(['email' => 'Email ou mot de passe invalide'])->onlyInput('email');
    }

    public function store(Request $request) {
        if (!($request->all()['department_id'] ?? false)) {
            $request->merge([
                'department_id' => DB::table('Departments')->where('name', '=', 'blank')->first()->id,
            ]);
        } else {
            $request->merge([
                'department_id' => intval($request->all()['department_id']),
            ]);
        }
        $request->merge([
            'confirmed' => false
        ]);

        $validator = Validator::make(request()->all(), [
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', 'min:8'],
            'role' => 'required',
            'department_id' => 'required',
            'confirmed' => 'required'
        ], [
            'name.required' => 'Le nom ne peut pas être vide',
            'email.required' => 'L\'email ne peut pas être vide',
            'email.email' => 'Le format de l\'email est invalide',
            'email.unique' => 'Un utilisateur existe déjà avec le même email',
            'password.required' => 'Le mot de passe ne peut pas être vide',
            'password.confirmed' => 'Le mot de passe est la confirmation ne sont pas identiques',
            'password.min' => 'Le mot de passe doit contenir au moin 8 caractères',
            'role.required' => 'Veuillez selectionner un rôle',
            'department_id' => 'Veuillez selectionner un departement',
        ]);

        if ($validator->fails()) {
            return redirect('/register')
                    ->withErrors($validator)
                    ->withInput();
        }

        $request->merge([
            'password' => bcrypt($request->all()['password'])
        ]);

        User::create($request->all());
        return redirect('/')->with('message', 'Votre demande a été enregistrée');
    }

    public function logout(Request $request) {
        auth()->logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'Vous êtes déconnecté(e)s!');
    }
    
    public function register() {
        return view('Users.register', ['departments' => DB::table('Departments')->get()]);
    }

    public function indexRegistrationRequests() {
        if (!Gate::allows('view-registration-requests')) {
            abort(403);
        }

        $sqlReq = User::where('confirmed', '=', '0');
        
        if (request()->get('search') ?? false) {
            $searchTerm = request()->get('search');
            $sqlReq->where('name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('email', 'like', '%' . $searchTerm . '%');
        }

        return view('Users.RegistrationRequests', [
            'requests' => $sqlReq->paginate(10)
        ]);
    }

    public function destroy(User $user) {
        if (!Gate::allows('delete-registration-requests')) {
            abort(403);
        }

        $name = $user->name;
        $user->delete();
        return redirect('/users/requests')->with('message', 'Demande de ' . $name . ' supprimée avec succès');
    }

    public function confirm(User $user) {
        if (!Gate::allows('confirm-user')) {
            abort(403);
        }

        if ($user->confirmed) {
            abort(400);
        }

        User::where('id', $user->id)->update(['confirmed' => true]);
        return redirect('/users/requests')->with('message', 'Demande de ' . $user->name . ' acceptée avec succès');
    }
}
