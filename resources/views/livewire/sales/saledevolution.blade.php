

@section('css')
<style>
    /* Estilos para las tablas */
    .table-wrapper {
    width: 100%;/* Anchura de ejemplo */
    height: 200px; /* Altura de ejemplo */
    overflow: auto;
    }

    .table-wrapper table {
    border-collapse: separate;
    border-spacing: 0;
    }

    .table-wrapper table thead {
    position: -webkit-sticky; /* Safari... */
    position: sticky;
    top: 0;
    left: 0;
    }

    .table-wrapper table thead th {
    border: 1px solid #000;
    background: #02b1ce;
    }
    .table-wrapper table tbody td {
    border: 1px solid #000;
    }


    




























    .table-wrapper2 {
    width: 100%;/* Anchura de ejemplo */
    height: 575px; /* Altura de ejemplo */
    overflow: auto;
    }

    .table-wrapper2 table {
    border-collapse: separate;
    border-spacing: 0;
    }

    .table-wrapper2 table thead {
    position: -webkit-sticky; /* Safari... */
    position: sticky;
    top: 0;
    left: 0;
    }

    .table-wrapper2 table thead th {
    border: 1px solid #000;
    background: #02b1ce;
    }
    .table-wrapper2 table tbody td {
    border: 1px solid #000;
    }


</style>


@endsection
<div>



    <div class="row">
        <div class="col-12 text-center">
          <p class="h1"><b>{{ $componentName }} | {{ $pageTitle }}</b></p>
        </div>
      </div>
  
      <div class="row">
  
          <div class="col-12 col-sm-12 col-md-4 text-center">
            <b>Buscador</b>
              @include('common.searchbox')
          </div>
  
          <div class="col-12 col-sm-12 col-md-4 text-center">
            <b>Seleccionar Usuario</b>
            <select wire:model="usuarioseleccionado" class="form-control">
                <option value="Todos" selected>Todos los Usuarios</option>
                @foreach ($listausuarios as $u)
                <option value="{{$u->id}}">{{$u->nombreusuario}}</option>
                @endforeach
            </select>
          </div>
  
          <div class="col-12 col-sm-12 col-md-4 text-right">
            <button type="button" class="boton-azul" data-toggle="modal" data-target="#tabsModal">Nueva Devolución</button>
          </div>
  
      </div>




      <div class="table-5">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Fecha</th>
                    <th>Nombre</th>
                    <th>Cartera</th>
                    <th>Monto</th>
                    <th>Locacion</th>
                    <th>Artículo Devuelto</th>
                    <th>Usuario</th>
                    <th>Motivo</th>
                    <th>Acción</th>
                </tr>
            </thead>

            @if($usuarioseleccionado == "Todos")
            <tbody>
                @foreach ($data as $item)
                    
                    <tr>
                        <td class="text-center">
                            {{$loop->iteration}}
                        </td>
                        <td>
                            {{$item->fechadevolucion}}
                        </td>
                        <td class="text-left">
                            {{ $item->nombre }}
                        </td>
                        <td class="text-center">
                            @if($item->tipo == 'PRODUCTO')
                            No Corresponde
                            @else
                            {{ $item->cartera }}
                            @endif
                        </td>
                        <td class="text-right">
                            {{ $item->monto }} Bs
                        </td>
                        <td>
                            {{  $item->destino  }}
                        </td>
                        <td>
                            @if($item->tipo == 'MONETARIO')
                            <h6 style="color: chocolate" class="text-center">{{ $item->tipo }}
                            @else
                            <h6 style="color: rgb(6, 21, 179)" class="text-center">{{ $item->tipo }}
                            @endif
                        </td>
                        <td>
                            {{ $item->nombreusuario }}
                        </td>
                        <td>
                            {{ $item->observacion }}
                        </td>
                        {{-- <td>
                            @if($item->estado == 'NORMAL')
                            <h6 style="color: rgb(50, 0, 131)" class="text-center">{{ $item->estado }}
                            @else
                            <h6 style="color: rgb(0, 209, 49)" class="text-center">{{ $item->estado }}
                            @endif
                        </td> --}}
                        @if($this->verificarpermiso() == true)
                            <td class="text-center">
                                @if(\Carbon\Carbon::parse($item->fechadevolucion)->format('d/m/Y') == date('d/m/Y'))
                                    <button href="javascript:void(0)"
                                    onclick="Confirm('{{ $item->iddevolucion }}')"
                                    class="btn btn-sm" title="Eliminar Devolución" style="background-color: red; color:white">
                                            <i class="fas fa-trash"></i>
                                    </button>
                                @endif
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
            @else
            <tbody>
                @foreach ($usuarioespecifico as $item)
                    <tr>
                        <td class="text-center">
                            {{$loop->iteration}}
                        </td>
                        <td>
                            {{$item->fechadevolucion}}
                        </td>
                        <td class="text-left">
                            {{ $item->nombre }}
                        </td>
                        <td class="text-center">
                            @if($item->tipo == 'PRODUCTO')
                            No Corresponde
                            @else
                            {{ $item->cartera }}
                            @endif
                        </td>
                        <td class="text-right">
                            {{ $item->monto }} Bs
                        </td>
                        <td>
                            {{  $item->destino  }}
                        </td>
                        <td>
                            @if($item->tipo == 'MONETARIO')
                            <h6 style="color: chocolate" class="text-center">{{ $item->tipo }}
                            @else
                            <h6 style="color: rgb(6, 21, 179)" class="text-center">{{ $item->tipo }}
                            @endif
                        </td>
                        <td>
                            {{ $item->nombreusuario }}
                        </td>
                        <td>
                            {{ $item->observacion }}
                        </td>
                        {{-- <td>
                            @if($item->estado == 'NORMAL')
                            <h6 style="color: rgb(29, 134, 148)" class="text-center">{{ $item->estado }}
                            @else
                                @if($item->estado == 'ELIMINADO')
                                <h6 style="color: red" class="text-center">{{ $item->estado }}
                                @else
                                <h6 style="color: rgb(0, 209, 49)" class="text-center">{{ $item->estado }}
                                @endif
                            @endif
                        </td> --}}
                        @if($this->verificarpermiso() == true)
                        <td class="text-center">
                            @if(\Carbon\Carbon::parse($item->fechadevolucion)->format('d/m/Y') == date('d/m/Y'))
                            <button href="javascript:void(0)"
                            onclick="Confirm('{{ $item->iddevolucion }}')"
                            class="btn btn-sm" title="Eliminar Devolución" style="background-color: red; color:white">
                                    <i class="fas fa-trash"></i>
                            </button>
                            @endif
                        </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
            @endif
        </table>
        @if($usuarioseleccionado == "Todos")
        {{ $data->links() }}
        @else
        {{ $usuarioespecifico->links() }}
        @endif
    </div>
    @include('livewire.sales.modaldevolucion')
</div>



@section('javascript')


<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.livewire.on('item-deleted', msg => {
            noty(msg)
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
    function hola()
    {
        alert("HOLA");
    }
</script>

@endsection