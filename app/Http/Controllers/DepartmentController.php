<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    public function get()
    {
        return Department::withCount('employees')
            ->withMax('employees', 'salary')
            ->paginate(10);
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'string|required|unique:departments']);
        return Department::create($request->all());
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'integer|required',
            'name' => 'string|required|unique:departments',
        ]);
    
        $department = Department::find($request->id);

        if(!$department)
            return response()->json([
                'message' => 'Отдел не найден'
            ]);

        $department->update($request->all());

        return response()->json(['message' => 'Отдел обновлен', 'department' => $department]);
    }
    

    public function destroy(Request $request)
    {
        $department = Department::find($request->id);

        if(!$department)
            return response()->json([
                'message' => 'Отдел не найден'
            ]);

        if ($department->employees()->exists()) 
            return response()->json(['error' => 'Нельзя удалить отдел с сотрудниками'], 400);
        

        $department->delete();
        return response()->json(['message' => 'Отдел удалён']);
    }
}
