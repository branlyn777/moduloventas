<div wire:ignore.self class="modal fade" id="theModal_subcategory" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header  bg-primary text-white" style="background: #f8f6f6">
             <b>Lista de Subcategorias</b> 
           </div>
           <div class="modal-body">

          @if ($subcat->isNotEmpty())
              
          <div class="table-1"style="padding-left: 10%; padding-right:10%; margin-top:2%">
              <table>
                  <thead>
                      <tr>
                        <th  style="width: 5%">#</th>
                        <th> <center>Nombre</center> </th>
                        <th style="width: 20%"> <center>Descripcion</center> </th>
                        <th> <center> Acc.</center></th>
                       
                      </tr>
                  </thead>
                 
                  <tbody>
                      @forelse ($subcat as $category)
                          <tr>
                              <td>
                                  
                                  <center><h6>{{ $loop->index+1 }}</h6></center>
                              </td>
                              <td>
                                  
                                  <h6>{{ $category->name }}</h6>
                              </td>
                              <td>
                                  <h6> {{$category->descripcion ==null?'S/N Descripcion':$category->descripcion}}</h6>
                              </td>
                             
                              <td>
                                <div class="row justify-content-center">

                                    <button href="javascript:void(0)" wire:click="Edit({{ $category->id }})"
                                        class="btn btn-dark p-1" title="Editar Subcategoria">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button href="javascript:void(0)" onclick="Confirm('{{ $category->id }}','{{ $category->name }}',
                                        '{{ $category->products->count() }}')" class="btn btn-danger p-1"
                                        title="Eliminar subcategoria">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                               
                                  
                              </td>
                          </tr>
                          @empty 
                          <p>No tiene categorias que  mostrar</p>
                      @endforelse
                  </tbody>
              </table>
              
          </div>
         @else
         <div class="row justify-content-center">
             <button type="button" class="btn btn-warning m-2" wire:click="asignarCategoria('{{$selected_id}}')"
             data-dismiss="modal" style="background: #3b3f5c"> <i class="fas fa-plus-circle"></i> Agregar Subcategorias</button>

         </div>
          @endif
        
                   
                </div>
                <div class="tabs tab-pills text-right">
                    <button type="button" wire:click.prevent="resetUI()" class="btn btn-warning m-2"
                    data-dismiss="modal" style="background: #3b3f5c">Cerrar</button>
                </div>
           </div>
</div>        
</div>   
</div> 
            
            
            



















