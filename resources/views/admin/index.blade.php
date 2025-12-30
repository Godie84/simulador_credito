@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="mb-4">Solicitudes de Crédito</h3>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Fecha</th>
                    <th>Nombre</th>
                    <th>Tipo Documento</th>
                    <th>No. Documento</th>
                    <th>Valor solicitado</th>
                    <th>No. Cuotas</th>
                    <th>Estado Solicitud</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($loans as $loan)
                    <tr>
                        <td>{{ $loan->created_at->format('Y-m-d') }}</td>
                        <td>
                            {{ $loan->customer->first_name ?? '' }}
                            {{ $loan->customer->last_name ?? '' }}
                        </td>
                        <td>{{ $loan->customer->documentType->name ?? '' }}</td>
                        <td>{{ $loan->customer->document_number ?? '' }}</td>

                        <td>${{ number_format($loan->requested_amount, 0, ',', '.') }}</td>
                        <td>{{ $loan->number_of_installments }}</td>
                        <td>
                        @php
                            $status = $loan->status->name ?? '';
                            $badge = match($status) {
                                'pendiente' => 'bg-warning',
                                'aprobada' => 'bg-success',
                                'rechazada' => 'bg-danger',
                                default => 'bg-secondary'
                            };
                        @endphp
                        <span class="badge {{ $badge }}">{{ ucfirst($status) }}</span>
                    </td>
                        <td>
                            @if ($loan->status->name === 'pendiente')
                                <form method="POST" action="{{ route('admin.approve', $loan->id) }}" class="d-inline">
                                    @csrf
                                    <button class="btn btn-success btn-sm">Aprobar</button>
                                </form>

                                <form method="POST" action="{{ route('admin.reject', $loan->id) }}" class="d-inline">
                                    @csrf
                                    <button class="btn btn-danger btn-sm">Rechazar</button>
                                </form>
                            @else
                                —
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No hay solicitudes registradas</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
