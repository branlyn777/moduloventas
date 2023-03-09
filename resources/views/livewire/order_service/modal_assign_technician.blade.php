<div class="modal fade" id="assigntechnician" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title text-white" id="exampleModalLabel">Asignar Técnico Responsable</h5>
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

        <table class="table-style">
          <thead>
            <tr class="text-center">
              <th class="text-uppercase text-xs">#</th>
              <th class="text-uppercase text-xs">Nombre</th>
              <th class="text-uppercase text-xs">Proceso</th>
              <th class="text-uppercase text-xs">Terminados</th>
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
                <td>
                  <span class="text-sm  ">
                    {{$u->name}}
                  </span>
                </td>
                <td class="text-center">
                  <span class="text-sm">
                    0
                  </span>
                </td>
                <td class="text-center">
                  <span class="text-sm">
                    @mdo
                  </span>
                </td>
              </tr>
              @endforeach
            @endif
          </tbody>
        </table>
        <br>
        <br>
      </div>
    </div>
  </div>
</div>