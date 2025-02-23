<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Employee;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'news' => [
                'total' => News::count(),
                'featured' => News::where('is_featured', true)->count(),
                'latest' => News::latest()->take(5)->get()
            ],
            'employees' => [
                'total' => Employee::count(),
                'active' => Employee::where('is_active', true)->count(),
                'latest' => Employee::latest()->take(5)->get()
            ]
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
