<div wire:ignore.self class="modal fade" id="verNoti" tabindex="-1" role="dialog" aria-labelledby="modal-notification"
    aria-hidden="true">
    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-notification">Notificacion de Inventarios</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="py-3 text-center">
                    <i class="ni ni-bell-55 ni-3x"></i>
                    <h4 class="text-gradient text-danger mt-4">Producto Agotado!</h4>
                    @if (is_array($dataitem))
                     
                           El producto {{ $dataitem['nombre'] }}({{$dataitem['codigo']??'s/n'}})
                           del almacen "{{$dataitem['almacen']??'s/n'}}" se encuentra sin stock.
                 
                    @else
                        {{ $dataitem }}
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <a href="compras" class="btn btn-secondary">Ir Compras</a>
                <button type="button" class="btn btn-primary ml-auto" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
