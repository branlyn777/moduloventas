<div>
    <div class="row">
        <div class="col-12 text-center">
            <p class="h1"><b>Devolución Ventas</b></p>
        </div>
    </div>
    
    <div class="row">
        <div class="col-12 col-sm-12 col-md-4">
            {{-- @include('common.searchbox') --}}
        </div>
    
        <div class="col-12 col-sm-12 col-md-4 text-center">
            
        </div>
    
        <div class="col-12 col-sm-12 col-md-4 text-right">
            <button wire:click.prevent="modaldevolucion()" class="boton-azul-g">
            Nueva Devolución
        </button>
        </div>
    </div>
    @include('livewire.sales.modaldev')
</div>

@section('javascript')


<script>
    document.addEventListener('DOMContentLoaded', function() {
       //Mostrar ventana modal detalle venta
       window.livewire.on('modaldevolucion-show', msg => {
            $('#modaldevolucion').modal('show')
        });
    });
    function Confirm(id)
    {
        swal.fire({
            title: 'CONFIRMAR',
            icon: 'warning',
            text: '¿Seguro que quiere Eliminar esta Devolución? Se reventiran todos los cambios guardados',
            showCancelButton: true,
            cancelButtonText: 'Cerrar',
            cancelButtonColor: '#383838',
            confirmButtonColor: '#3B3F5C',
            confirmButtonText: 'Aceptar'
        }).then(function(result) {
            if (result.value) {
                window.livewire.emit('eliminardevolucion', id)
                Swal.close()
            }
        })
    }
</script>

@endsection