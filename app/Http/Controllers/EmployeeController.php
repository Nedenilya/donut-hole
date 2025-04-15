<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

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
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'middle_name' => 'required|string',
            'gender' => 'required|in:male,female',
            'salary' => 'required|integer',
            'departments' => 'required|array|min:1'
        ]);

        $employee = Employee::create($request->all());
        $employee->departments()->sync($request->departments);

        return $employee;
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'middle_name' => 'required|string',
            'gender' => 'required|in:male,female',
            'salary' => 'required|integer',
            'departments' => 'required|array|min:1'
        ]);

        $employee = Employee::find($request->id);

        if(!$employee)
            return response()->json([
                'message' => 'Содрудник не найден'
            ]);

        $employee->update($request->all());
        $employee->departments()->sync($request->departments);

        return response()->json(['message' => 'Сотрудник обновлен', 'employee' => $employee]);
    }

    public function destroy(Request $request)
    {
        $employee = Employee::find($request->id); 

        if(!$employee)
            return response()->json([
                'message' => 'Содрудник не найден'
            ]);

        $employee->departments()->detach();
        $employee->delete();
        
        return response()->json(['message' => 'Сотрудник удалён']);
    }
}
