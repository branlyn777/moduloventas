@section('css')
<style>
    .tablainventarios {
        width: 100%;
    
        min-height: 140px;
    }
    .tablainventarios thead {
        background-color: #1572e8;
        color: white;
    }
    .tablainventarios th, td {
        border: 0.5px solid #1571e894;
        padding: 4px;
    }
    tr:hover {
        background-color: rgba(99, 216, 252, 0.336);
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
                    <tr>
                        <td class="text-center">
                            {{ ($categories->currentpage()-1) * $categories->perpage() + $loop->index + 1 }}
                        </td>
                        <td>
                            <b>{{ $category->name }}</b>
                            <label for=""> Descripcion : {{$category->descripcion}}</label>
                        </td>
                        <td class="text-center">
                            <a href="javascript:void(0)" wire:click="Ver({{$category->id}})"
                                class="boton-azul" title="Ver subcategorias"> <b class="pl-1">{{ $category->subcategories()}}</b> 
                                <i class="fas fa-eye"></i>
                                </a>
                        </td>
                       
                        <td class="text-center">
                            <a href="javascript:void(0)" wire:click="Edit({{ $category->id }})"
                                class="boton-azul" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="javascript:void(0)" class="boton-azul" wire:click="asignarCategoria('{{$category->id}}')" title="Agregar subcategorias">
                                <i class="fas fa-plus"></i>
                            </a>
                            <a href="javascript:void(0)" onclick="Confirm('{{ $category->id }}','{{ $category->name }}','{{$category->products->count()}}','{{$category->subcategories()}}')"
                               class="boton-rojo"
                                title="Delete">
                                <i class="fas fa-trash"></i>
                            </a>
                            
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
