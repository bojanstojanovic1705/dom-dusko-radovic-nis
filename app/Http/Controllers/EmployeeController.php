<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();
            
        return view('employees.index', compact('employees'));
    }
}
