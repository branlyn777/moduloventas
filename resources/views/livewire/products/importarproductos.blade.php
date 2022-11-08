


  <div wire:ignore.self class="modal fade" id="modalimport" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header bg-info">
          <h5 class="modal-title text-white">
              <b>Importar Productos</b>
          </h5>
          <h6 class="text-center text-warning" wire:loading>POR FAVOR ESPERE</h6>
        </div>
        <div class="modal-body">
<p>
    <h3 class="badge badge-success mb-0 ml-1">1</h3> Descargue la plantilla de ejemplo para importar sus productos de un archivo excel.
</p>

<div class="card card-sm" style="background-color: bisque">
    <div class="card-body">
<div class="row justify-content-center">

    <button class="btn btn-sm btn-info" wire:click="downloadex()">
        Descargar Plantilla
    </button>
</div>
    </div>
</div>

<p>
    <h3 class="badge badge-success mb-0 ml-1">2</h3> Elija su archivo excel que contiene sus productos de acuerdo a la plantilla, asegurese que solo una hoja contenga todos sus productos, si tiene otra hoja con informacion puede causar errores.
</p>

         

                <div class="form-group" >
                    @if ($failures)
                    <div class="alert alert-danger" role="alert">
                        @foreach ($failures as $failure)
                        @foreach ($failure->errors() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                     @endforeach
                    </div>
                    @endif

                    <form wire:submit.prevent="import('{{$archivo}}')" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{$archivo}}
                        <input type="file" name="import_file" wire:model="archivo" />
                    </form>
                    </div>
                  
                  

                </div>
                <div class="modal-footer">
                    
                 
                        <div class="col-lg-12 m-2">
                            <div class="row justify-content-end">

                                <button class="btn btn-primary mr-1" type="submit" >SUBIR</button>
                                <button wire:click.prevent="resetUI()" class="btn btn-warning close-btn text-info"
                            data-dismiss="modal">CANCELAR</button>
                            </div>
                        
                        
                        </div>
                
          
                </div>
                </div>
                </div>
                </div>
          
                  