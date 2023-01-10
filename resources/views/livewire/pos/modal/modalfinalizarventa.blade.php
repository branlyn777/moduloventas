<div wire:ignore.self class="modal fade" id="modalfinalizarventa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header bg-primary">
            <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">
                <p class="text-sm mb-0">
                    FINALIZAR VENTA
                </p>
            </h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            {{-- <input type="image" src="{{ asset('storage/icons/' . $logoempresa) }}" style="border: double;" height="80" width="170"/>  --}}
            <div class="row">



                <div class="col-sm-12">
                    <div class="connect-sorting">
                        <h5 class="text-sm mb-0 text-center"><b>MONEDAS - DENOMINACIONES</b></h5>
                        <div style="padding: 10px;">
                            <div class="row">
                                @foreach ($denominations as $d)



                                    @if($d->value > 0)
                                    
                                        <div class="col-sm-4 mt-1 px-1">
                                            <button wire:click.prevent="sumar({{ $d->value }})" class="btn btn-primary" style="width: 100%">
                                                <p class="text-xs mb-0">
                                                    {{ number_format($d->value, 2, '.', '')}}
                                                </p>
                                            </button>
                                        </div>

                                    @else

                                        <div class="col-sm-4 mt-1 px-1">
                                            <button wire:click.prevent="sumar({{ $d->value }})" class="btn btn-add mb-0" style="background-color: #2e48dc; color: white;width: 100%">
                                                <p class="text-xs mb-0">
                                                    Exacto
                                                </p>
                                            </button>
                                        </div>

                                    @endif



                                @endforeach
                                    
                                    
                            </div>
                        </div>


                        <div class="connect-sorting-content mt-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="text-center">TOTAL VENTA</h5>
                                    <h5 class="text-center">
                                        <b>{{ number_format($this->total_bs, 2, ",", ".")}} Bs</b>
                                    </h5>
                                    <div class="input-group input-group-md mb-3">
                                        <div class="input-group-append">
                                            <span class="input-group-text form-control" style="background-color: #e9e9e9; color: rgb(0, 0, 0);">
                                                Bs Recibido
                                            </span>
                                        </div>
                                        <input type="number" id="cash" wire:model="dinero_recibido" class="form-control text-center">

                                            
                                        <div class="input-group-append">
                                            <span wire:click="$set('dinero_recibido',0)" class="input-group-text ml-2" title="Borrar Todo"
                                            style="background-color: #5e72e4; color: white; cursor: pointer;">
                                                <i class="fas fa-backspace fa-2x"></i>
                                            </span>

                                        </div>
                                    </div>

                                    @if ($dinero_recibido >= $total_bs && $total_bs>0)
                                    <h4 class="text-center">CAMBIO: Bs <b>{{ number_format($cambio, 2) }}</b></h4>
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="col-1 text-center">
                                    </div>
                                    <div class="col-10 text-center">
                                        {{ucwords(strtolower($nombrecliente))}}
                                        <br>
                                        <h5>
                                            {{ucwords(strtolower($nombrecartera))}}
                                        </h5>
                                    </div>
                                    <div class="col-1">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>



        </div>
        <div class="">
            <div class="row">
                <div class="col-4 text-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <p class="text-sm mb-0">
                            Cancelar
                        </p>
                    </button>
                </div>
                <div class="col-4 text-center">
                    <h5>Generar PDF</h5>
                    <label class="switch" >
                        <input type="checkbox" wire:change="pdfsino()" {{ $pdf ? 'checked' : '' }}>
                        <span class="slider round"></span>
                    </label>
                </div>
                <div class="col-4 text-center">
                    @if ($dinero_recibido >= $total_bs && $total_bs>0)
                        <div wire:loading.remove>


                            <button wire:click.prevent="savesale()" class="btn btn-success mb-0">
                                <p class="text-sm mb-0">
                                    Vender
                                </p>
                            </button>





                        </div>

                        <div id="preloader_3" wire:loading>
                            <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
                        </div>


                    @endif
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>