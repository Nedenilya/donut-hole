<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function get()
    {
        return Employee::selectRaw("id, CONCAT(first_name, ' ', last_name, ' ', middle_name) AS full_name, gender, salary")
            ->paginate(10);
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'middle_name' => 'required',
            'gender' => 'required|in:male,female',
            'salary' => 'required|integer',
            'departments' => 'required|array|min:1'
        ]);

        $employee = Employee::create($request->all());
        $employee->departments()->sync($request->departments);

        return $employee;
    }

    public function destroy(Request $request)
    {
        $employee = Employee::find($request->id);
        
        if($employee){
            $employee->delete();
            return response()->json(['message' => 'Сотрудник удалён']);
        }

        return response()->json(['message' => 'Сотрудник не найден']);
    }
}
