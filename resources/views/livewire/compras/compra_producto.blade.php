<div wire:ignore.self class="modal fade" id="compraprod" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Producto-Compra </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="row">
                <div class="col-12 col-sm-6 col-md-6 text-center">
                    <b wire:click="limpiarsearch()" style="cursor: pointer;">Buscar Producto</b>
                    <div class="form-group">
                        <div class="input-group mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text input-gp">
                                    <i class="fas fa-search"></i>
                                </span>
                            </div>
                            <input type="text" wire:model="search2" placeholder="Buscar por Nro.Documento,Proveedor,Usuario" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-1 table-responsive">
                <table style="min-width: 600px;">
                    <thead>
                      <tr>
                        <th>No</th>
                     
                        <th class="text-center">Producto</th>
                        <th class="text-center">Compra Codigo</th>
                        <th class="text-center">Fecha Compra</th>
                       
                      </tr>
                    </thead>
                    
                    <tbody>
                        @if ($compraProducto != null)
                        @foreach ($compraProducto as $cp)
                            
                        <tr>
                            <td class="text-center">
                                {{$loop->index+1}}
                            </td>
                            <td class="text-left">
                                {{ $cp->productos->nombre}}
                            </td>
                            <td class="text-right">
                                {{ number_format($cp->precio, 2) }}
                            </td>
                          
                        </tr>
                        @endforeach
                            
                        @else
                            <p>nada</p>
                        @endif
                       
                    </tbody>
                
                  </table>
            
            
            
            
            </div>
          
            <br>
        </div>
    </div>
</div>