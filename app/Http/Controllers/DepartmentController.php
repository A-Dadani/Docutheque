<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    public function manage() {
        return view('Departments.manage', ['departments' => Department::latest()->filter(request(['search']))->paginate(10)]);
    }

    public function destroy(Department $department) {
        if (!Gate::allows('delete-department')) {
            abort(403);
        }

        $depName = $department->name;
        $department->delete();
        return redirect('/departments/manage')->with('message', 'Département ' . $depName . ' supprimé avec succès');
    }

    public function store(Request $request) {
        if (!Gate::allows('add-department')) {
            abort(403);
        }

        $validator = Validator::make(request()->all(), [
            'name' => 'required'
        ], [
            'name.required' => 'Le nom du département ne peut pas être vide'
        ]);

        if ($validator->fails()) {
            return redirect('/departments/manage')
                ->withErrors($validator)
                ->withInput();
        }

        Department::create($request->all());
        return redirect('/departments/manage')->with('message', 'Le département ' . $request->all()['name'] . ' a été ajouté avec succès');
    }
}
