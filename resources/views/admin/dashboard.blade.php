@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">📊 Panel de Administración</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped table-bordered">
        <thead class="table-primary">
            <tr>
                <th>Cliente</th>
                <th>Documento</th>
                <th>Monto solicitado</th>
                <th>Cuotas</th>
                <th>Estado</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($loans as $loan)
                <tr>
                    <td>{{ $loan->customer->first_name }} {{ $loan->customer->last_name }}</td>
                    <td>{{ $loan->customer->document_number }}</td>
                    <td>${{ number_format($loan->requested_amount, 0, ',', '.') }}</td>
                    <td>{{ $loan->number_of_installments }}</td>
                    <td>
                        <span class="badge
                            @if($loan->status->name == 'Aprobada') bg-success
                            @elseif($loan->status->name == 'Rechazada') bg-danger
                            @else bg-warning text-dark
                            @endif">
                            {{ $loan->status->name }}
                        </span>
                    </td>
                    <td>{{ $loan->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        @if($loan->status->name == 'Pendiente')
                            <form action="{{ route('admin.approve', $loan->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                <button class="btn btn-success btn-sm">✅ Aprobar</button>
                            </form>
                            <form action="{{ route('admin.reject', $loan->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                <button class="btn btn-danger btn-sm">❌ Rechazar</button>
                            </form>
                        @else
                            <small>Sin acciones</small>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
