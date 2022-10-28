<div wire:ignore.self class="modal fade" id="modalcambiarusuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            
            <div class="modal-header bg-info">
                <h5 class="modal-title" id="exampleModalLongTitle">CAMBIAR USUARIO VENDEDOR</h5>


                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="">
                <div class="text-center">
                    ¿Cambiar al Usuario Vendedor: <b>{{$this->nombreusuariovendedor}}</b> ?
                    <br>
                    <b>Seleccione Uno</b>
                </div>

            </div>
            
            <div class="modal-body" style="color: black">
            
                  <div class="table-1">
                    <table>
                        <thead>
                          <tr class="text-center">
                            <th>Nombre Usuario</th>
                            <th>Seleccionar</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($usuarios as $dv)
                          <tr>
                            <td class="text-left">
                                {{ ucwords(strtolower($dv->name)) }}
                            </td>
                            <td class="text-center">
                                <button wire:click="seleccionarusuario({{$dv->id}})" title="Seleccionar Usuario" class="boton-azul">
                                    <i class="fas fa-check"></i>
                                </button>
                            </td>
                        </tr>
                            @endforeach
                        </tbody>
                      </table>
                  </div>

                  

            </div>
            <div class="modal-footer">
                
            </div>
        </div>
    </div>
</div>