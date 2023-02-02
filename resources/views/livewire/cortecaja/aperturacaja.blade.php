<div wire:ignore.self class="modal fade" id="aperturacaja" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Apertura de Caja</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if ($idcaja !== null)
                          
                <div class="row justify-content-center">
                    <div class="card">
                        <div class="card-header pb-0 p-3">
                        
                                <h6 class="text-left">
                                    <b>Apertura de Caja</b>
                                </h6>
                     
                        </div>
             
                            <div class="card-body p-3">
                                <ul class="list-group">
                                

                                    <li
                                        class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                                <i class="ni ni-tag text-white opacity-10"></i>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <h6 class="mb-1 text-dark text-sm">Efectivo s/Edsoft</h6>
                                                <h6 class="text-xs"> Bs. {{ $saldoAcumulado }}</h6>
                                            </div>
                                        </div>
                                    </li>

                                    <div
                                        class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                                <i class="ni ni-box-2 text-white opacity-10"></i>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <h6 class="mb-1 text-dark text-sm">Efectivo Actual</h6>
                                                <div class="form-group">
                                                    <div class="input-group" >
                                                        <button style="background-color: #5e72e4; color: white; border: #5e72e4;"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#contador_monedas"
                                                            class="input-group-text"><i class="fas fa-calculator mx-2"></i></button>
                                                            <input type="number" class="form-control needs-validation" novalidate id="validationCustom03" required style="padding-left: 5%;" 
                                                            wire:model='efectivo_actual'>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @if ($efectivo_actual != null and $efectivo_actual!= $saldoAcumulado)
                                        <li
                                            class="list-group-item border-0 d-flex justify-content-between ps-0 border-radius-lg">
                                            <div class="d-flex align-items-center">
                                                <div
                                                    class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                                    <i class="ni ni-satisfied text-white opacity-10"></i>
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <h6 class="mb-1 text-dark text-sm">
                                                        <h6>
                                                                Ajuste de Efectivo
                                                        </h6>

                                                    </h6>
                                                    <span class="text-xs font-weight-bold">Bs.
                                                        {{ $efectivo_actual - $saldoAcumulado<0?  ($efectivo_actual - $saldoAcumulado)*-1:$efectivo_actual - $saldoAcumulado}} </span>
                                                </div>
                                            </div>
                                        </li>

                                        <li
                                            class="list-group-item border-0 d-flex justify-content-between ps-0 border-radius-lg">
                                            <div class="d-flex align-items-start">
                                                <div
                                                    class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                                    <i class="ni ni-satisfied text-white opacity-10"></i>
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <h6 class="mb-1 text-dark text-sm">Nota/Comentario</h6>
                                                    {{-- <span class="text-xs font-weight-bold"> Bs. 0</span> --}}
                                                    <textarea wire:model='nota_ajuste' class="form-control" id="exampleFormControlTextarea1" rows="2"></textarea>
                                         
                                                </div>
                                            </div>
                                        </li>
                              
                                    @endif
                                </ul>
                            </div>
                   
                    </div>
                </div>




                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-primary"
                            wire:click='CorteCaja({{ $idcaja }})' onclick="inicio" >Iniciar Sesion</button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<script>
    (function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('inicio', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()
</script>