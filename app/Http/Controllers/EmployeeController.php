<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    /** Listar empleados */
    public function index()
    {
        // usa paginate solo si quieres paginación; si no, ->get()
        $employees = Employee::orderBy('first_name')->paginate(10);
        return view('employees.index', compact('employees'));
    }

    /** Formulario de creación */
    public function create()
    {
        return view('employees.create');
    }

    /** Guardar nuevo empleado */
    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name'               => 'required|string|max:255',
        'last_name'                => 'required|string|max:255',
        'document_type'            => 'required|string|max:50',
        'document_number'          => 'required|string|max:50',
        'birth_date'               => 'nullable|date',
        'birth_place'              => 'nullable|string|max:255',
        'gender'                   => 'nullable|string|max:20',
        'marital_status'           => 'nullable|string|max:50',
        'address'                  => 'nullable|string|max:255',
        'phone'                    => 'nullable|string|max:20',
        'email'                    => 'nullable|email|max:255',
        'photo'                    => 'nullable|image|max:2048',
        'position'                 => 'nullable|string|max:100',
        'department'               => 'nullable|string|max:100',
        'contract_type'            => 'nullable|string|max:100',
        'hire_date'                => 'nullable|date',
        'termination_date'         => 'nullable|date',
        'salary'                   => 'nullable|numeric',
        'schedule'                 => 'nullable|string|max:100',
        'eps'                      => 'nullable|string|max:100',
        'pension_fund'             => 'nullable|string|max:100',
        'cesantias_fund'           => 'nullable|string|max:100',
        'arl'                      => 'nullable|string|max:100',
        'compensation_fund'        => 'nullable|string|max:100',
        'cotizante_type'           => 'nullable|string|max:100',
        'emergency_contact_name'   => 'nullable|string|max:255',
        'emergency_contact_relationship' => 'nullable|string|max:100',
        'emergency_contact_phone'  => 'nullable|string|max:20',
        'bank'                     => 'nullable|string|max:100',
        'account_type'             => 'nullable|string|max:50',
        'account_number'           => 'nullable|string|max:100',
        'shirt_size'               => 'nullable|string|max:10',
        'pants_size'               => 'nullable|string|max:10',
        'shoe_size'                => 'nullable|string|max:10',
        'training_certificates'    => 'nullable|string',
        'internal_card_number'     => 'nullable|string|max:50',
            // agrega aquí otros campos opcionales si quieres
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('empleados', 'public');
        }

        Employee::create($data);

        // Redirigir al listado con mensaje
        return redirect()
            ->route('employees.index')
            ->with('success', 'Empleado creado correctamente');
    }

    /** Editar */
    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    /** Actualizar */
    public function update(Request $request, Employee $employee)
    {
        $data = $request->validate([
            'first_name'               => 'required|string|max:255',
        'last_name'                => 'required|string|max:255',
        'document_type'            => 'required|string|max:50',
        'document_number'          => 'required|string|max:50',
        'birth_date'               => 'nullable|date',
        'birth_place'              => 'nullable|string|max:255',
        'gender'                   => 'nullable|string|max:20',
        'marital_status'           => 'nullable|string|max:50',
        'address'                  => 'nullable|string|max:255',
        'phone'                    => 'nullable|string|max:20',
        'email'                    => 'nullable|email|max:255',
        'photo'                    => 'nullable|image|max:2048',
        'position'                 => 'nullable|string|max:100',
        'department'               => 'nullable|string|max:100',
        'contract_type'            => 'nullable|string|max:100',
        'hire_date'                => 'nullable|date',
        'termination_date'         => 'nullable|date',
        'salary'                   => 'nullable|numeric',
        'schedule'                 => 'nullable|string|max:100',
        'eps'                      => 'nullable|string|max:100',
        'pension_fund'             => 'nullable|string|max:100',
        'cesantias_fund'           => 'nullable|string|max:100',
        'arl'                      => 'nullable|string|max:100',
        'compensation_fund'        => 'nullable|string|max:100',
        'cotizante_type'           => 'nullable|string|max:100',
        'emergency_contact_name'   => 'nullable|string|max:255',
        'emergency_contact_relationship' => 'nullable|string|max:100',
        'emergency_contact_phone'  => 'nullable|string|max:20',
        'bank'                     => 'nullable|string|max:100',
        'account_type'             => 'nullable|string|max:50',
        'account_number'           => 'nullable|string|max:100',
        'shirt_size'               => 'nullable|string|max:10',
        'pants_size'               => 'nullable|string|max:10',
        'shoe_size'                => 'nullable|string|max:10',
        'training_certificates'    => 'nullable|string',
        'internal_card_number'     => 'nullable|string|max:50',
        ]);

        if ($request->hasFile('photo')) {
            // eliminar foto anterior si existe
            if ($employee->photo) {
                Storage::disk('public')->delete($employee->photo);
            }
            $data['photo'] = $request->file('photo')->store('empleados', 'public');
        }

        $employee->update($data);

        return redirect()
            ->route('employees.index')
            ->with('success','Empleado actualizado correctamente');
    }

    /** Eliminar */
    public function destroy(Employee $employee)
    {
        if ($employee->photo) {
            Storage::disk('public')->delete($employee->photo);
        }
        $employee->delete();

        return redirect()
            ->route('employees.index')
            ->with('success','Empleado eliminado correctamente');
    }

    /** Ver detalle (opcional) */
    public function show(Employee $employee)
    {
    return view('employees.show', compact('employee'));
    }
}
