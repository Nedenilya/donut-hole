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
        $request->validate(['name' => 'required|unique:departments']);
        return Department::create($request->all());
    }

    public function destroy(Request $request)
    {
        $department = Department::find($request->id);

        if ($department->employees()->exists()) {
            return response()->json(['error' => 'Нельзя удалить отдел с сотрудниками'], 400);
        }
        
        $department->delete();
        return response()->json(['message' => 'Отдел удалён']);
    }
}
