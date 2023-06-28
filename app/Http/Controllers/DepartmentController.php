<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    public function manage() {
        if (!Gate::allows('manage-departments')) {
            abort(403);
        }

        return view('departments.manage', ['departments' => Department::latest()->filter(request(['search']))->paginate(10)]);
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

    public function show(Department $department) {
        if (!Gate::allows('manage-single-department', $department)) {
            abort(403);
        }

        // Get Employees
        $empl = User::where('role', '=', 'employeDep')
                    ->where('confirmed', '=', '1')
                    ->where('department_id', '=', $department->id)
                    ->latest()
                    ->get();
        
        //Get ChefsDep
        $chefsDep = User::where('role', '=', 'chefDep')
                        ->where('confirmed', '=', '1')
                        ->where('department_id', '=', $department->id)
                        ->latest()
                        ->get();

        return view('departments.show-users-in-dept', [
            'chefsDep' => $chefsDep,
            'employeesDep' => $empl,
            'department' => $department
        ]);
    }
}
