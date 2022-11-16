<div wire:ignore.self class="modal fade" id="compraprod" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Producto-Compra </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="table-1 table-responsive">
                <table style="min-width: 600px;">
                    <thead>
                      <tr>
                        <th>No</th>
                     
                        <th class="text-center">Producto</th>
                        <th class="text-center">Compra Codigo</th>
                       
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
                    <tfoot>
                      <tr>
                     
                   
                        <td class="text-center">
                           
                        </td>
                        <td class="text-center">
                            <b class="text-center">
                                Totales
                            </b>
                        </td>
                        <td class="table-th text-withe text-right">
                            <b>
                                --------
                            </b>
                        </td>

                        @if ($totalIva != null)
                            
                        <td class="table-th text-withe text-right">
                            <b>
                                {{number_format($totalIva,2)}}
                            </b>
                        </td>
                        @else
                            
                        <td class="table-th text-withe text-right">
                            <b>
                                {{ number_format(0, 2) }}
                            </b>
                        </td>
                        @endif
                        <td class="text-center">
                            <b>
                                {{$totalitems}}
                            </b>
                        </td>
                       
                        <td class="text-right">
                        
                            <b>
                                {{number_format( $compraTotal, 2) }}
                            </b>
                      
                        </td>
                      </tr>
                    </tfoot>
                  </table>
            
            
            
            
            </div>
            <div class="text-center" style="color: black">
       
            
           
          
           
                    <b>Observación: {{$observacion==null?'Ninguna observacion':$observacion}}</b>
          
             
         
            </div>
            <br>
        </div>
    </div>
</div>