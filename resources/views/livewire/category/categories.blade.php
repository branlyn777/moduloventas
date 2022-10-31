@section('css')
<style>
    .tablainventarios {
        width: 50%;

        min-height: 140px;
    }

    .tablainventarios thead {
        background-color: #1572e8;
        color: white;
    }

    .tablainventarios th,
    td {
        border: 0.5px solid #1571e894;
        padding: 4px;
    }

    tr:hover {
        background-color: rgba(99, 216, 252, 0.336);
    }

    .project-list-table {
    border-collapse: separate;
    border-spacing: 0 12px
}

.project-list-table tr {
    background-color: rgba(216, 230, 239, 0.983)
}

.table-nowrap td, .table-nowrap th {
    white-space: nowrap;
}
.table-borderless>:not(caption)>*>* {
    border-bottom-width: 0;
}
.table>:not(caption)>*>* {
    padding: 0.75rem 0.75rem;
    background-color: var(--bs-table-bg);
    border-bottom-width: 9px;
    box-shadow: inset 0 0 0 9999px var(--bs-table-accent-bg);
}


</style>
@endsection

<div>


    <div class="row">
        <div class="col-12 text-center">
            <p class="h2"><b>CATEGORIAS</b></p>
        </div>
    </div>

    <div class="row">

        <div class="col-12 col-sm-12 col-md-4">
            @include('common.searchbox')
        </div>

        <div class="col-12 col-sm-12 col-md-4 text-center">

        </div>

        <div class="col-12 col-sm-12 col-md-4 text-right">

            <a href="javascript:void(0)" class="boton-azul-g" wire:click="$set('selected_id','0')" data-toggle="modal"
                data-target="#theModal"> <b> <i class="fas fa-plus-circle"></i> Crear Categoria</b> </a>



        </div>

    </div>



    <div class="table-5">
        <table>
            <thead>
                <tr class="text-center">
                    <th>#</th>
                    <th>NOMBRE</th>
                    <th>SUBCATEGORIAS</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($categories as $category)
                <tr data-toggle="collapse" data-target="#{{$category->id}}" class="accordion-toggle">

                    <td>{{$loop->index + 1 }}</td>
                    <td> <h3 class="m-0" > {{ $category->name }}</h3><label for=""> Descripcion : {{$category->descripcion}}</label></td>
                    <td  class="text-center" >
                         <button type="button" class="boton-azul btn-lg" style="width: 5rem" title="Ver subcategorias"> <b class="pl-1">{{
                                $category->subcategories()}}</b>
                            <i class="fas fa-eye"></i>
                        </button>
                    </td>
                    <td class="text-center">
                        <div wire:ignore class="row justify-content-center">

                            <button type="button" wire:click="Edit({{ $category->id }})" class="boton-azul"
                                title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button  type="button" class="boton-azul"
                                wire:click="asignarCategoria('{{$category->id}}')" title="Agregar subcategorias">
                                <i class="fas fa-plus"></i>
                            </button>
                            <button  type="button"
                                onclick="Confirm('{{ $category->id }}','{{ $category->name }}','{{$category->products->count()}}','{{$category->subcategories()}}')"
                                class="boton-rojo" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>

                        </div>

                    </td>


                </tr>

                <tr >
                    <td colspan="6" class="hiddenRow">
                        <div class="accordian-body collapse" id="{{$category->id}}" style="padding-left: 20%; padding-right:20%">
                            @if ($category->detsub()->isNotEmpty())
                            <table class="table project-list-table table-nowrap align-middle table-borderless">
                                    
                                <thead>
                                    <tr class="info">
                                        <th style="width:5%" class="text-center" >#</th>
                                        <th>Nombre</th>
                                        <th style="width: 20%">Acciones</th>

                                    </tr>
                                </thead>
                             
                                <tbody>
                                    @foreach ($category->detsub() as $lop)

                                    <tr class="accordion-toggle">
                                        <td class="text-center" >{{$loop->index+1}}</td>
                                        <td>{{$lop->name}} <br>{{$lop->descripcion}}</td>
                                      
                                        <td class="text-center">
                                            
                                            <button href="javascript:void(0)" wire:click="Edit({{ $lop->id }})" class="boton-azul"
                                                title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                       
                                            <button href="javascript:void(0)"
                                                onclick="Confirm('{{ $lop->id }}','{{ $lop->name }}','{{$lop->products->count()}}','{{$lop->subcategories()}}')"
                                                class="boton-rojo" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            <div wire:ignore class="row justify-content-center">
                                <button type="button" wire:click='asignarCategoria({{$category->id}})' class="boton-verde">
                                  <i class="fas fa-plus"></i>  Agregar Subcategorias
                                </button>
                            </div>
                            @endif

                        </div>
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>
        {{ $categories->links() }}
    </div>


    @include('livewire.category.form')
    @include('livewire.category.form_subcategory')
    @include('livewire.category.subcategories')
    @include('livewire.category.importarcategorias')
    @include('livewire.category.importarsubcategorias')
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        window.livewire.on('show-modal', Msg => {
            $('#theModal').modal('show')
        });
        window.livewire.on('hide_modal_sub', Msg => {
            $('#theModal_subcategory').modal('hide')
        });
        window.livewire.on('modal_sub', Msg => {
            $('#theModal_subcategory').modal('show')
        });
        window.livewire.on('item-added', Msg => {
            $('#theModal').modal('hide')
            noty(Msg)
        });
        window.livewire.on('sub-show', Msg => {
            $('#theModal_s').modal('show')
          
        });
        window.livewire.on('sub_added', Msg => {
            $('#theModal_s').modal('hide')
            
        });
        window.livewire.on('item-updated', Msg => {
            $('#theModal').modal('hide')
            noty(Msg)
        });
        window.livewire.on('item-deleted', Msg => {
            noty(Msg)
        });
       

    });

    function Confirm(id, name,products,subcategories) {
        if (products > 0 || subcategories>0) {
            const auxiliar= subcategories;
            const letras=auxiliar>0?'y subcategorias relacionadas':'no tiene ninguna subcategoria';
            swal.fire({
                title: 'PRECAUCION',
                icon: 'warning',
                text: 'No se puede eliminar la categoria, ' + name + ' porque tiene'+ 
            'productos relacionados/'+ letras
            })
            return;
        }
        swal.fire({
            title: 'CONFIRMAR',
            icon: 'warning',
            text: 'Confirmar eliminar la categoria ' + '"' + name + '"',
            showCancelButton: true,
            cancelButtonText: 'Cerrar',
            cancelButtonColor: '#383838',
            confirmButtonColor: '#3B3F5C',
            confirmButtonText: 'Aceptar'
        }).then(function(result) {
            if (result.value) {
                window.livewire.emit('deleteRow', id)
                Swal.close()
            }
        })
    }
</script>












{{-- <div class="container">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Employee
            </div>
            <div class="panel-body">
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>#</th>
                            <th>NOMBRE</th>
                            <th>SUBCATEGORIAS</th>
                            <th>ACCIONES</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($categories as $category)
                        <tr data-toggle="collapse" data-target="#{{$category->id}}" class="accordion-toggle">
                            <td><button class="btn btn-default btn-xs"><span
                                        class="glyphicon glyphicon-eye-open"></span></button></td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->name }}</td>
                        </tr>

                        <tr>
                            <td colspan="12" class="hiddenRow">
                                <div class="accordian-body collapse" id="{{$category->id}}">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr class="info">
                                                <th>Job</th>
                                                <th>Company</th>
                                                <th>Salary</th>
                                                <th>Date On</th>
                                                <th>Date off</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                            <tr data-toggle="collapse" class="accordion-toggle" data-target="#demo10">
                                                <td> <a href="#">Enginner Software</a></td>
                                                <td>Google</td>
                                                <td>U$8.00000 </td>
                                                <td> 2016/09/27</td>
                                                <td> 2017/09/27</td>
                                                <td>
                                                    <a href="#" class="btn btn-default btn-sm">
                                                        <i class="glyphicon glyphicon-cog"></i>
                                                    </a>
                                                </td>
                                            </tr>

                                            <tr>

                                            </tr>






                                        </tbody>
                                    </table>

                                </div>
                            </td>
                        </tr>

                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>

    </div>
</div>
--}}