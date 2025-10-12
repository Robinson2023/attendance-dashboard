@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6 bg-white shadow rounded">
    <h1 class="text-2xl font-bold mb-6 text-blue-600">Detalles del Empleado</h1>

    {{-- ==== Datos personales ==== --}}
    <h2 class="text-xl font-semibold mb-2">Datos personales</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <x-input name="first_name" label="Nombres" value="{{ $employee->first_name }}" readonly/>
        <x-input name="last_name" label="Apellidos" value="{{ $employee->last_name }}" readonly/>
        <x-input name="document_type" label="Tipo documento" value="{{ $employee->document_type }}" readonly/>
        <x-input name="document_number" label="Número documento" value="{{ $employee->document_number }}" readonly/>
        <x-input name="birth_date" label="Fecha de nacimiento" value="{{ $employee->birth_date }}" readonly/>
        <x-input name="birth_place" label="Lugar de nacimiento" value="{{ $employee->birth_place }}" readonly/>
        <x-input name="gender" label="Género" value="{{ $employee->gender }}" readonly/>
        <x-input name="marital_status" label="Estado civil" value="{{ $employee->marital_status }}" readonly/>
        <x-input name="address" label="Dirección" value="{{ $employee->address }}" readonly/>
        <x-input name="phone" label="Teléfono" value="{{ $employee->phone }}" readonly/>
        <x-input name="email" label="Correo electrónico" value="{{ $employee->email }}" readonly/>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Foto</label>
            @if($employee->photo)
                <img src="{{ asset('storage/'.$employee->photo) }}" class="w-28 h-28 object-cover rounded">
            @else
                <span class="text-gray-500">Sin foto</span>
            @endif
        </div>
    </div>

    {{-- ==== Información laboral ==== --}}
    <h2 class="text-xl font-semibold mt-8 mb-2">Información laboral</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <x-input name="position" label="Cargo" value="{{ $employee->position }}" readonly/>
        <x-input name="department" label="Departamento" value="{{ $employee->department }}" readonly/>
        <x-input name="contract_type" label="Tipo de contrato" value="{{ $employee->contract_type }}" readonly/>
        <x-input name="hire_date" label="Fecha de ingreso" value="{{ $employee->hire_date }}" readonly/>
        <x-input name="termination_date" label="Fecha de retiro" value="{{ $employee->termination_date }}" readonly/>
        <x-input name="salary" label="Salario" value="{{ number_format($employee->salary, 0, ',', '.') }}" readonly/>
        <x-input name="schedule" label="Horario" value="{{ $employee->schedule }}" readonly/>
        <x-input name="internal_card_number" label="N° Carnet interno" value="{{ $employee->internal_card_number }}" readonly/>
    </div>

    {{-- ==== Seguridad social ==== --}}
    <h2 class="text-xl font-semibold mt-8 mb-2">Seguridad social</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <x-input name="eps" label="EPS" value="{{ $employee->eps }}" readonly/>
        <x-input name="pension_fund" label="Fondo pensión" value="{{ $employee->pension_fund }}" readonly/>
        <x-input name="cesantias_fund" label="Fondo cesantías" value="{{ $employee->cesantias_fund }}" readonly/>
        <x-input name="arl" label="ARL" value="{{ $employee->arl }}" readonly/>
        <x-input name="compensation_fund" label="Caja compensación" value="{{ $employee->compensation_fund }}" readonly/>
        <x-input name="cotizante_type" label="Tipo cotizante" value="{{ $employee->cotizante_type }}" readonly/>
        <x-input name="emergency_contact_name" label="Contacto emergencia" value="{{ $employee->emergency_contact_name }}" readonly/>
        <x-input name="emergency_contact_relationship" label="Parentesco" value="{{ $employee->emergency_contact_relationship }}" readonly/>
        <x-input name="emergency_contact_phone" label="Teléfono contacto" value="{{ $employee->emergency_contact_phone }}" readonly/>
    </div>

    {{-- ==== Bancaria y Dotación ==== --}}
    <h2 class="text-xl font-semibold mt-8 mb-2">Bancaria y Dotación</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <x-input name="bank" label="Banco" value="{{ $employee->bank }}" readonly/>
        <x-input name="account_type" label="Tipo cuenta" value="{{ $employee->account_type }}" readonly/>
        <x-input name="account_number" label="Número de cuenta" value="{{ $employee->account_number }}" readonly/>
        <x-input name="shirt_size" label="Talla camisa" value="{{ $employee->shirt_size }}" readonly/>
        <x-input name="pants_size" label="Talla pantalón" value="{{ $employee->pants_size }}" readonly/>
        <x-input name="shoe_size" label="Talla zapatos" value="{{ $employee->shoe_size }}" readonly/>
        <x-textarea name="training_certificates" label="Certificados / Estudios" readonly>
            {{ $employee->training_certificates }}
        </x-textarea>
    </div>

    <div class="mt-6 flex justify-between">
        <a href="{{ route('employees.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">⬅ Volver</a>
        <a href="{{ route('employees.edit', $employee) }}" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">✏️ Editar</a>
    </div>
</div>
@endsection
