<div wire:ignore.self class="modal fade" id="modalcambiarusuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header bg-primary">

                <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">
                    <p class="text-sm mb-0">
                        CAMBIAR USUARIO VENDEDOR
                    </p>
                  </h1>


                  <button type="button" class="btn-close fs-3" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
            </div>
            <div class="">
                <div class="text-center">
                    <br>
                    ¿Cambiar al Usuario Vendedor: <b>{{ $this->nombreusuariovendedor }}</b>?
                </div>

            </div>

            <div class="modal-body">

                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr class="text-center">
                                <th>Nombre Usuario</th>
                                <th>Seleccionar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuarios as $dv)
                                <tr>
                                    <td class="text-sm mb-0 text-center">
                                        <p class="text-xs mb-0">
                                            {{ ucwords(strtolower($dv->name)) }}
                                        </p>
                                    </td>
                                    <td class="text-center">

                                        <a href="javascript:void(0)" wire:click="seleccionarusuario({{ $dv->id }})" title="Seleccionar Usuario">
                                            <i class="fas fa-plus text-primary"></i>
                                        </a>




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
