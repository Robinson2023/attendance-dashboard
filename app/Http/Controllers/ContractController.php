<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Employee;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    public function index()
    {
        $contracts = Contract::with('employee')->get();
        return view('contracts.index', compact('contracts'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('contracts.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'type' => 'required|string',
            'salary' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        Contract::create($request->all());

        return redirect()->route('contracts.index')
            ->with('success', 'Contrato creado correctamente.');
    }

    public function edit(Contract $contract)
    {
        $employees = Employee::all();
        return view('contracts.edit', compact('contract', 'employees'));
    }

    public function update(Request $request, Contract $contract)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'type' => 'required|string',
            'salary' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $contract->update($request->all());

        return redirect()->route('contracts.index')
            ->with('success', 'Contrato actualizado correctamente.');
    }

    public function destroy(Contract $contract)
    {
        $contract->delete();
        return redirect()->route('contracts.index')
            ->with('success', 'Contrato eliminado correctamente.');
    }
}
