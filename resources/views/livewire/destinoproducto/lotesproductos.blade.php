
<div wire:ignore.self class="modal fade" id="lotes" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
    
                <div class="row mt-3">
                    <div class="col-lg-11 pl-4">
                        <h3 class="text-center">LOTES</h3>

                    </div>
                    <div class="col-lg-1">
                        <div class="row justify-contents-end">

                            <button type="button" class="close" data-keyboard="false" data-backdrop="static" data-dismiss="modal" aria-label="Close" wire:click="cerrar()">
                              <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                            </button>
                        </div>

                    </div>

                </div>
                <div>
                    <div class="col-lg-12 text-left">
                        <h3>Nombre Producto:{{$nombre_prodlote}} </h3>

                    </div>
                </div>
        
            <div class="row m-1 justify-content-end">
                @if ($loteproducto)
                 

           
                        <div class="col-12 col-lg-3 col-md-3 mb-1 ml-0">
                           
                                <select wire:model='estados' class="form-control mt--2">
                                  <option value="null" disabled>Estado</option>
                                  <option value="ACTIVO">ACTIVO</option>
                                  <option value="INACTIVO">INACTIVO</option>
                                </select>
                             
                        </div>
            </div>

            <div class="row m-3">

                <div class="table-1">
                    <table>
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Fecha Creacion</th>                              
                                       
                                <th>Existencia</th>   
                                <th>Estado</th>   
                                <th>Costo Lote</th>                                                    
                                <th>p/v Lote</th>                                                    
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($loteproducto as $data)
                            <tr>


                                {{-- {{$data}} --}}

                                <td>
                                    <h6 class="text-center">{{ $loop->iteration}}</h6>
                                </td>
                                <td>
                                    <center> {{\Carbon\Carbon::parse($data->created_at)->format('d-m-Y')}}
                                        <br>
                                        {{\Carbon\Carbon::parse($data->created_at)->format('h:i:s a')}}</center>
                                </td>
                                <td>
                                    <h6>{{$data->existencia}}</h6>
                                </td>  
                           
                                <td>
                                    <h6>{{$data->status}}</h6>
                                </td>
                                                                                  
                                <td>
                                    <h6>{{$data->costo}}</h6>
                                </td>                                                        
                                <td>
                                    <h6>{{$data->pv_lote}}</h6>
                                </td>                                                        
                            @endforeach
                        </tbody>
                    </table>
                </div>
            
            </div>
               
         
                     
        @endif                                    
                

             
            </div>
                   
          
            
        </div>
    </div>
</div>