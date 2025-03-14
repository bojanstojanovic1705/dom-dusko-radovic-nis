<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $employees = Employee::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();
            
        return view('about.index', compact('employees'));
    }
}
