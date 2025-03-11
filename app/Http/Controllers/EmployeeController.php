<?php
namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $employees = Employee::latest()->paginate(5);
        return view('employees.index', compact('employees'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'position' => 'required',
            'salary' => 'required|numeric',
        ]);

        Employee::create($request->all());

        return redirect()->route('employees.index')
                        ->with('success', 'Employee created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  Employee  $employee
     * @return View
     */
    public function show(Employee $employee): View
    {
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Employee  $employee
     * @return View
     */
    public function edit(Employee $employee): View
    {
        return view('employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Employee  $employee
     * @return RedirectResponse
     */
    public function update(Request $request, Employee $employee): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'position' => 'required',
            'salary' => 'required|numeric',
        ]);

        $employee->update($request->all());

        return redirect()->route('employees.index')
                        ->with('success', 'Employee updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Employee  $employee
     * @return RedirectResponse
     */
    public function destroy(Employee $employee): RedirectResponse
    {
        $employee->delete();

        return redirect()->route('employees.index')
                        ->with('success', 'Employee deleted successfully');
    }
}
