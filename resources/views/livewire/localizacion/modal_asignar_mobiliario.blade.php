<div wire:ignore.self class="modal fade" id="asignar_mobiliario" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title" id="exampleModalCenterTitle">Productos por Compra</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="row">
                <div class="col-12 col-sm-6 col-md-6">
                    <b wire:click="limpiarsearch()"  class="ml-3 mt-1" style="cursor: pointer;">Buscar Producto</b>
                    {{$search2}}
                    <div class="form-group">
                        <div class="input-group mb-4">
                            <div class="input-group-prepend ml-3">
                                <span class="input-group-text input-gp">
                                    <i class="fas fa-search"></i>
                                </span>
                            </div>
                            <input type="text" wire:model="search2" placeholder="Buscar por Nro.Documento,Proveedor,Usuario" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-1 p-2">
                <table style="min-width: 600px;">
                    <thead>
                      <tr>
                        <th>N°</th>
                     
                        <th class="text-center">Producto</th>
                        <th class="text-center">Cantidad</th>
                        <th class="text-center">Cod. Compra</th>
                        <th class="text-center">Fecha Compra</th>
                       
                      </tr>
                    </thead>
                    
                    <tbody>
                        @if ($search2 != null)
                        <div class="col-sm-12 col-md-12">
                            <div class="vertical-scrollable">
                                <div class="row layout-spacing">
                                    <div class="col-md-12 ">
                                        <div class="statbox widget box box-shadow">
                                            <div class="widget-content widget-content-area row">
                                                <div class="table-responsive table-wrapper-scroll-y my-custom-scrollbar">
                                                    <table class="table table-hover table-sm" style="width:100%">
    
                                                        <tbody>
    
                                                            @forelse ($data_prod_mob as $data_m)
                                                            <tr>
                                                                <td class="text-center">
                                                                    <h6>{{$data_m->nombre }}
                                                                    </h6>
                                                                </td>
                                                                <td>
                                                                    <a href="javascript:void(0)"
                                                                        wire:click="addProd({{ $data_m->id}})"
                                                                        class="btn btn-danger">
                                                                        <i class="fas fa-check"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            @empty
                                                            <p>No existe productos con ese criterio de busqueda</p>
                                                            @endforelse
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            
                        @else
                            <p>{{$search2}}</p>
                        @endif
                       
                    </tbody>
                
                  </table>
            
            
            
            
            </div>
          
          
        </div>
    </div>
</div>











