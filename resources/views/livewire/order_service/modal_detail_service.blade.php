<div wire:ignore.self class="modal fade" id="detailservice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white text-sm" id="exampleModalLabel">DETALLES DE LA ÓRDEN DE SERVICIO:
                    {{ $this->id_order_service }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 text-center">
                        <div class="numbers">
                          <div class="box-detail {{$this->status_service}}">
                            SERVICIO {{$this->status_service}}
                          </div>
                            <h5 class="font-weight-bolder">
                                {{ $this->s_client_name }}
                            </h5>
                            <p class="mb-0">
                                {{ $this->s_client_cell }} {{ $this->s_client_phone }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="row text-center">
                            <div class="col-md-12">
                                <h6 class="mb-0">
                                    {{$this->s_name_type_work}} {{ $this->s_cps }} {{ $this->s_mark }} {{ $this->s_model_detail }}
                                </h6>
                            </div>
                            <div class="col-md-12">
                                <small class="me-2">Fecha de Entrega</small>
                                <i class="far fa-calendar-alt me-2" aria-hidden="true"></i>
                                <small>{{ $this->s_estimated_delivery_date }}</small>
                            </div>
                        </div>
                    </div>
                    <div class="card h-100">
                        <div class="card-body p-3">
                            <ul class="list-group">
                                <div class="row mb-3">
                                    <div class="col-4 text-center">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ $this->s_price }} Bs</h6>
                                            <p class="mb-0 text-xs">Precio Servicio</p>
                                        </div>
                                    </div>
                                    <div class="col-4 text-center">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ $this->s_on_account }} Bs</h6>
                                            <p class="mb-0 text-xs">Dejado a Cuenta</p>
                                        </div>
                                    </div>
                                    <div class="col-4 text-center">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ $this->s_balance }} Bs</h6>
                                            <p class="mb-0 text-xs">Monto a Cobrar</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-12 text-center">
                                        <div class="d-flex flex-column justify-content-center">
                                            @if ($this->s_cost == 0)
                                                <p class="mb-0 text-xs">El servicio no tubo ningun costo</p>
                                            @else
                                                <p class="mb-0 text-xs">Costo del Servicio: <b>{{ $this->s_cost }} Bs</b> Motivo: {{ $this->s_cost_detail }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <h6>
                                        Falla Según Cliente:
                                    </h6>
                                    <span class="text-sm">
                                      {{ $this->s_fail_client }}
                                    </span>
                                </div>
                                <div class="text-center">
                                    <h6>
                                        Diagnostico Previo:
                                    </h6>
                                    <span class="text-sm">
                                        {{ $this->s_diagnostic }}
                                    </span>
                                </div>
                                <div class="text-center">
                                    <h6>
                                        Solución:
                                    </h6>
                                    <span class="text-sm">
                                        {{ $this->s_solution }}
                                        <br>
                                    </span>
                                </div>
                            </ul>
                        </div>
                        <div class="row mb-4">
                            <div class="col-2 text-center">
                                
                            </div>
                            <div class="col-8 text-center">
                                <a href="informetecnico/pdf/{{$this->id_service}}" target="_blank" class="btn-formless-technical">
                                    Informe Técnico
                                </a>
                                <p class="text-xs mt-2">Tipo de Servicio: {{$this->s_name_type_service}}</p>
                            </div>
                            <div class="col-2 text-center">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
