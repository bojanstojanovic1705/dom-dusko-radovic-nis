<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::orderBy('sort_order')
            ->orderBy('name')
            ->paginate(10);
            
        return view('admin.employees.index', compact('employees'));
    }

    public function create()
    {
        return view('admin.employees.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'position' => 'required|max:255',
            'bio' => 'nullable',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('employees', 'public');
            $validated['image'] = $path;
        }

        Employee::create($validated);

        return redirect()
            ->route('admin.employees.index')
            ->with('success', 'Zaposleni je uspešno dodat.');
    }

    public function edit(Employee $employee)
    {
        return view('admin.employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'position' => 'required|max:255',
            'bio' => 'nullable',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean'
        ]);

        if ($request->hasFile('image')) {
            // Brisanje stare slike
            if ($employee->image) {
                Storage::disk('public')->delete($employee->image);
            }
            
            $path = $request->file('image')->store('employees', 'public');
            $validated['image'] = $path;
        }

        $employee->update($validated);

        return redirect()
            ->route('admin.employees.index')
            ->with('success', 'Podaci o zaposlenom su uspešno ažurirani.');
    }

    public function destroy(Employee $employee)
    {
        if ($employee->image) {
            Storage::disk('public')->delete($employee->image);
        }
        
        $employee->delete();

        return redirect()
            ->route('admin.employees.index')
            ->with('success', 'Zaposleni je uspešno obrisan.');
    }
}
