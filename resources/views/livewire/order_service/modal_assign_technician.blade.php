<div wire:ignore.self class="modal fade" id="assigntechnician" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title text-white text-sm" id="exampleModalLabel">ASIGNAR TÉCNICO RESPONSABLE: SERVICIO {{$this->id_order_service}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <div class="row">
          <div class="col-12 text-center">
            <b>Lista de Usuarios</b>
          </div>
        </div>

        <br>
        <div class="table-style table-height">
          <table>
            <thead>
              <tr class="text-center">
                <th class="text-uppercase text-xs">#</th>
                <th class="text-uppercase text-xs">Nombre</th>
                <th class="text-uppercase text-xs">Seleccionar</th>
              </tr>
            </thead>
            <tbody>
              @if($this->list_user_technicial)
                @foreach($this->list_user_technicial as $u)
                <tr>
                  <td class="text-center">
                    <span class="text-sm">
                      {{$loop->iteration}}
                    </span>
                  </td>
                  <td class="ps-4">
                    <span class="text-sm">
                      {{$u->name}} - {{$u->profile}}
                    </span>
                  </td>
                  <td class="text-center">
                    <button wire:click.prevent="select_responsible_technician({{$this->id_service}}, {{$u->id}})" class="btn">
                      <span class="text-sm">
                        +
                      </span>
                    </button>
                  </td>
                </tr>
                @endforeach
              @endif
            </tbody>
          </table>
        </div>
        <br>
        <br>
      </div>
    </div>
  </div>
</div>