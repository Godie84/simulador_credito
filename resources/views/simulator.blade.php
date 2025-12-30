@extends('layouts.app')

@section('content')
    <div class="card shadow p-4">
        <h4 class="mb-3">Simulador de Crédito</h4>

        <form id="simulatorForm">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="requested_amount" class="form-label">Valor solicitado</label>
                    <input type="number" class="form-control" id="requested_amount" min="100000" max="100000000" required>
                </div>
                <div class="col-md-6">
                    <label for="number_of_installments" class="form-label">Número de cuotas</label>
                    <select id="number_of_installments" class="form-select" required>
                        @for ($i = 2; $i <= 24; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Simular</button>
        </form>

        <hr>

        <div id="result" class="mt-4" style="display:none;">
            <h5>Plan de pagos</h5>
            <table class="table table-bordered mt-2">
                <thead>
                    <tr>
                        <th># Cuota</th>
                        <th>Valor de Cuota</th>
                        <th>Saldo Pendiente</th>
                    </tr>
                </thead>
                <tbody id="tableBody"></tbody>
            </table>
            <button id="wantBtn" class="btn btn-success mt-3" data-bs-toggle="modal" data-bs-target="#registerModal">
                ¡Lo quiero!
            </button>
        </div>
    </div>

    <!-- Modal de registro -->
    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="registerForm" action="{{ url('/loan-requests') }}" method="POST">
                    @csrf
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Registro de Solicitud</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label>Tipo de Documento</label>
                                <select class="form-select" name="document_type_id" required>
                                    <option value="">Seleccione tipo de documento</option>
                                    <option value="1">CC</option>
                                    <option value="2">CE</option>
                                    <option value="3">TI</option>
                                    <option value="4">NIT</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>Número de Documento</label>
                                <input type="number" name="document_number" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label>Nombres</label>
                                <input type="text" name="first_name" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label>Apellidos</label>
                                <input type="text" name="last_name" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label>Género</label>
                                <select class="form-select" name="gender" required>
                                    <option value="M">Masculino</option>
                                    <option value="F">Femenino</option>
                                    <option value="O">Otro</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>Fecha de Nacimiento</label>
                                <input type="date" name="birth_date" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label>Celular</label>
                                <input type="text" name="phone" class="form-control" required pattern="\d{10,13}"
                                    maxlength="13" title="El número de celular debe tener entre 10 y 13 dígitos">
                            </div>
                            <div class="col-md-6">
                                <label>Correo electrónico</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Registrar Solicitud</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/simulator.js') }}"></script>
@endsection
