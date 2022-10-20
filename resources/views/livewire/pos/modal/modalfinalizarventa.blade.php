
<div wire:ignore.self class="modal fade" id="modalfinalizarventa" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header" style="background-color: #02b1ce; color: white;">
            <h5 class="modal-title" id="exampleModalLongTitle">Finalizar Venta</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            {{-- <input type="image" src="{{ asset('storage/icons/' . $logoempresa) }}" style="border: double;" height="80" width="170"/>  --}}
            <div class="row">
                <div class="col-sm-12">
                    <div class="connect-sorting">
                        <h5 class="text-center"><b>MONEDAS - DENOMINACIONES</b></h5>
                        <div class="container">
                            <div class="row">
                                @foreach ($denominations as $d)
                                    <div class="col-sm mt-2">
                                        <button wire:click.prevent="sumar({{ $d->value }})" class="btn btn btn-block den" style="background-color: #02b1ce; color: white;">
                                            {{ $d->value > 0 ? 'Bs '. number_format($d->value, 2, '.', '') : 'Exacto'}}
                                        </button>
                                    </div>
                                @endforeach
                                    
                                    
                            </div>
                        </div>


                        <div class="connect-sorting-content mt-4">
                            <div class="card simple-title-task ui-sortable-handle">
                                <div class="card-body">
                                    <h4 class="text-center">TOTAL VENTA</h4>
                                    <h4 class="text-center"><b>{{$this->total_bs}} Bs</b></h4>
                                    <div class="input-group input-group-md mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text input-gp hideonsm" 
                                            style="background-color: #02b1ce; color: white;">Bs Recibido
                                            </span>
                                        </div>
                                        <input type="number" id="cash" wire:model="dinero_recibido" class="form-control text-center">

                                            
                                        <div class="input-group-append">
                                            <span wire:click="$set('dinero_recibido',0)" class="input-group-text" title="Borrar Todo"
                                            style="background-color: #02b1ce; color: white; cursor: pointer;">
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
                                        <b>{{ucwords(strtolower($nombrecliente))}}</b>
                                        <br>
                                        <h3><b>{{ucwords(strtolower($nombrecartera))}}</b></h3>
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
            <div class="row">
                <div class="col-4 text-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
                </div>
                <div class="col-4 text-center">
                    <h5><b>Generar PDF</b></h5>
                    <label class="switch" >
                        <input type="checkbox" wire:change="pdfsino()" {{ $pdf ? 'checked' : '' }}>
                        <span class="slider round"></span>
                    </label>
                </div>
                <div class="col-4 text-center">
                    @if ($dinero_recibido >= $total_bs && $total_bs>0)
                        <div wire:loading.remove>
                            <button wire:click.prevent="savesale()" type="button" class="btn btn-primary">VENDER</button>
                        </div>

                        <div id="preloader_3" wire:loading>
                            <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
                        </div>


                    @endif
                </div>
            </div>
            <br>
        </div>
    </div>
</div>