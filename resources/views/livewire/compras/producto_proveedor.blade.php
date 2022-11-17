<div wire:ignore.self class="modal fade" id="prodprov" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title" id="exampleModalCenterTitle">Productos por Proveedor </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="row">
                <div class="col-12 col-sm-6 col-md-6">
                    <b wire:click="limpiarsearch()" class="ml-3 mt-1" style="cursor: pointer;">Buscar Producto</b>
                    <div class="form-group">
                        <div class="input-group mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text input-gp">
                                    <i class="fas fa-search"></i>
                                </span>
                            </div>
                            <input type="text" wire:model="search3" placeholder="Buscar Producto" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-1 p-2">
                <table style="min-width: 600px;">
                    <thead>
                      <tr>
                        <th>N°</th>
                     
                        <th class="text-center">Proveedor</th>
                        <th class="text-center">Cantidad</th>
                        <th class="text-center">Cod. Compra</th>
                        <th class="text-center">Fecha Compra</th>
                       
                      </tr>
                    </thead>
                    
                    <tbody>
                        @if ($search3 != null)
                        @foreach ($productoProveedor as $prp)
                            
                        <tr>
                            <td class="text-center">
                                {{$loop->index+1}}
                            </td>
                            <td class="text-left">
                                {{ $prp->nombre_prov}}
                            </td>
                            <td class="text-right">
                                {{ $prp->cantidad}}
                            </td>
                            <td class="text-right">
                                {{ $prp->id}}
                            </td>
                            <td class="text-right">
                                {{ $prp->created_at}}
                            </td>
                          
                        </tr>
                        @endforeach
                            
                        @else
                            <p></p>
                        @endif
                       
                    </tbody>
                
                  </table>
            
            
            
            
            </div>
          
       
            <br>
        </div>
    </div>
</div>