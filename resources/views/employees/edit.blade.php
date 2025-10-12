@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6 bg-white shadow rounded">
    <h1 class="text-2xl font-bold mb-6 text-blue-600">Editar Empleado</h1>

    <form action="{{ route('employees.update', $employee) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="grid grid-cols-2 gap-4">

            <div><x-label value="Nombres" /><x-input name="first_name" value="{{ $employee->first_name }}" required /></div>
            <div><x-label value="Apellidos" /><x-input name="last_name" value="{{ $employee->last_name }}" required /></div>

            <div>
                <label for="document_type" class="block font-medium text-sm text-gray-700">Tipo Documento</label>
                <select name="document_type" id="document_type" class="w-full border rounded px-2 py-1">
                    <option value="CC">CC</option>
                    <option value="CE">CE</option>
                    <option value="TI">TI</option>
                </select>
            </div>
            <div><x-label value="Número Documento" /><x-input name="document_number" value="{{ $employee->document_number }}" required /></div>

            <div><x-label value="Fecha de Nacimiento" /><x-input type="date" name="birth_date" value="{{ $employee->birth_date }}" /></div>
            <div><x-label value="Lugar de Nacimiento" /><x-input name="birth_place" value="{{ $employee->birth_place }}" /></div>

            <div>
                <label for="gender" class="block font-medium text-sm text-gray-700">Genero</label>
                <select name="gender" id="gender" class="w-full border rounded px-2 py-1">
                    <option value="Masculino">Masculino</option>
                    <option value="Femenino">Femenino</option>
                    <option value="Otro">Otro</option>
                </select>
            </div>

            <div>
                <label for="marital_status" class="block font-medium text-sm text-gray-700">Estado civil</label>
                <select name="Estado civil" id="Estado civil" class="w-full border rounded px-2 py-1">
                    <option value="Soltero">Soltero</option>
                    <option value="Casado">Casado</option>
                    <option value="Unión libre">Unión libre</option>
                    <option value="Divorciado">Divorciado</option>
                </select>
            </div>

            <div><x-label value="Dirección" /><x-input name="address" value="{{ $employee->address }}" /></div>
            <div><x-label value="Teléfono" /><x-input name="phone" value="{{ $employee->phone }}" /></div>
            <div><x-label value="Correo" /><x-input type="email" name="email" value="{{ $employee->email }}" /></div>

            <div><x-label value="Cargo" /><x-input name="position" value="{{ $employee->position }}" /></div>
            <div><x-label value="Departamento" /><x-input name="department" value="{{ $employee->department }}" /></div>
            <div>
                <label for="cotizante_type" class="block font-medium text-sm text-gray-700">Tipo de Cotizante</label>
                <select name="Tipo de Cotizante" id="Tipo de Cotizante" class="w-full border rounded px-2 py-1">
                    <option value="Cotizante">Cotizante</option>
                    <option value="Beneficiario">Beneficiario</option>
                </select>
            </div>
            <div><x-label value="Fecha de Ingreso" /><x-input type="date" name="hire_date" value="{{ $employee->hire_date }}" /></div>
            <div><x-label value="Fecha de Retiro" /><x-input type="date" name="termination_date" value="{{ $employee->termination_date }}" /></div>
            <div><x-label value="Salario" /><x-input type="number" step="0.01" name="salary" value="{{ $employee->salary }}" /></div>
            <div><x-label value="Horario" /><x-input name="schedule" value="{{ $employee->schedule }}" /></div>

            <div><x-label value="EPS" /><x-input name="eps" value="{{ $employee->eps }}" /></div>
            <div><x-label value="Fondo de Pensiones" /><x-input name="pension_fund" value="{{ $employee->pension_fund }}" /></div>
            <div><x-label value="Fondo de Cesantías" /><x-input name="cesantias_fund" value="{{ $employee->cesantias_fund }}" /></div>
            <div><x-label value="ARL" /><x-input name="arl" value="{{ $employee->arl }}" /></div>
            <div><x-label value="Caja de Compensación" /><x-input name="compensation_fund" value="{{ $employee->compensation_fund }}" /></div>
            <div>
                <label for="cotizante_type" class="block font-medium text-sm text-gray-700">Tipo de Cotizante</label>
                <select name="Tipo de Cotizante" id="Tipo de Cotizante" class="w-full border rounded px-2 py-1">
                    <option value="Cotizante">Cotizante</option>
                    <option value="Beneficiario">Beneficiario</option>
                </select>
            </div>

            <div><x-label value="Contacto Emergencia (Nombre)" /><x-input name="emergency_contact_name" value="{{ $employee->emergency_contact_name }}" /></div>
            <div><x-label value="Parentesco" /><x-input name="emergency_contact_relationship" value="{{ $employee->emergency_contact_relationship }}" /></div>
            <div><x-label value="Teléfono Emergencia" /><x-input name="emergency_contact_phone" value="{{ $employee->emergency_contact_phone }}" /></div>

            <div><x-label value="Banco" /><x-input name="bank" value="{{ $employee->bank }}" /></div>
            <div>
                <label for="account_type" class="block font-medium text-sm text-gray-700">Tipo de Cuenta</label>
                <select name="Tipo de Cuenta" id="Tipo de Cuenta" class="w-full border rounded px-2 py-1">
                    <option value="Ahorros">Ahorros</option>
                    <option value="Corriente">Corriente</option>
                </select>
            </div>
            <div><x-label value="Número Cuenta" /><x-input name="account_number" value="{{ $employee->account_number }}" /></div>

            <div><x-label value="Talla Camisa" /><x-input name="shirt_size" value="{{ $employee->shirt_size }}" /></div>
            <div><x-label value="Talla Pantalón" /><x-input name="pants_size" value="{{ $employee->pants_size }}" /></div>
            <div><x-label value="Talla Zapatos" /><x-input name="shoe_size" value="{{ $employee->shoe_size }}" /></div>

            <div class="col-span-2"><x-label value="Certificados de Capacitación" /><x-textarea name="training_certificates">{{ $employee->training_certificates }}</x-textarea></div>

            <div><x-label value="Número Carnet Interno" /><x-input name="internal_card_number" value="{{ $employee->internal_card_number }}" /></div>
            <div><x-label value="Foto" /><x-input type="file" name="photo" /></div>
        </div>

        <div class="mt-6 flex justify-end space-x-2">
            <a href="{{ route('employees.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancelar</a>
            <x-button>Actualizar</x-button>
        </div>
    </form>
</div>
@endsection
