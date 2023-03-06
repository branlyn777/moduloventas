<div wire:ignore.self class="modal fade" id="modalclient" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white " id="exampleModalLabel">Buscar Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if (strlen($this->search) > 0)
                    @if ($client->count() > 0)
                        <label>Buscar Cliente:</label>
                    @else
                        <label>NOMBRE CLIENTE:</label>
                    @endif
                @else
                    <label>Buscar Cliente:</label>
                @endif
                <div class="input-group">
                    <input type="text" wire:model="search" class="form-control"
                        placeholder="Busque o Cree un Cliente...">
                </div>
                <br>

                @if (strlen($this->search) > 0)
                    @if ($client->count() > 0)
                        <div class="table-wrapper">
                            <table>
                                <thead>
                                    <tr class="text-center text-white">
                                        <th class="text-uppercase text-xs font-weight-bolder">
                                            Nombre
                                        </th>
                                        <th class="text-uppercase text-xs font-weight-bolder">
                                            Carnet
                                        </th>
                                        <th class="text-uppercase text-xs font-weight-bolder">
                                            Celular 1
                                        </th>
                                        <th class="text-uppercase text-xs font-weight-bolder">
                                            Celular 2
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($client as $c)
                                        <tr>
                                            <td>
                                                <span class="me-2 text-sm clic-action" onclick="SelectClient({{ $c->id }}, 'c' + '{{ $c->id }}', 't' + '{{ $c->id }}')" title="Seleccionar Cliente">
                                                    {{ $c->nombre }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <span class="me-2 text-sm" onclick="ClearNumbers('c' + '{{ $c->id }}', 't' + '{{ $c->id }}')" style="cursor: pointer;">
                                                    {{ $c->cedula }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                              <input type="text" id="c{{ $c->id }}" value="{{ $c->celular }}" class="input-number">
                                            </td>
                                            <td class="text-center">
                                              <input type="text" id="t{{ $c->id }}" value="{{ $c->telefono }}" class="input-number">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $client->onEachSide(1)->links() }}
                        </div>
                    @else
                        <div style="height: 307px;">
                            <div class="row">
                                <div class="col-6">
                                    <label>CELULAR 1:</label>
                                    <input wire:model.lazy="celular" type="text" class="form-control">
                                    @error('celular')
                                        <span style="font-size: 0.8rem" class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label>CELULAR 2:</label>
                                    <input wire:model.lazy="telefono" type="text" class="form-control">
                                    @error('telefono')
                                        <span style="font-size: 0.8rem" class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label>CARNET:</label>
                                    <input wire:model.lazy="cedula" type="text" class="form-control">
                                    @error('cedula')
                                        <span style="font-size: 0.8rem" class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label>PROCEDENCIA:</label>
                                    <select wire:model="procedencia" class="form-select">
                                        <option value="Elegir">Elegir</option>
                                        @foreach($procedenciaClientes as $pc)
                                        <option value="{{$pc->id}}">{{$pc->procedencia}}</option>
                                        @endforeach
                                    </select>
                                    @error('procedencia')
                                        <span style="font-size: 0.8rem" class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <br>
                                    <br>
                                    <button wire:click="create_select_client()" type="button" class="btn bg-gradient-primary">Crear y Seleccionar Cliente</button>
                                </div>
                            </div>
                        </div>
                    @endif
                @else
                    <div class="text-center" style="height: 307px; opacity: 17%;">
                      <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="200pt" height="200pt"
                        viewBox="0 0 512.000000 512.000000" preserveAspectRatio="xMidYMid meet">

                        <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)" fill="#000000"
                            stroke="none">
                            <path
                                d="M2180 5105 c-357 -52 -678 -265 -869 -578 -95 -155 -152 -331 -172
                                  -527 -35 -351 96 -759 348 -1085 75 -97 192 -213 274 -272 l51 -36 -104 -32
                                  c-475 -145 -914 -442 -1221 -825 -217 -271 -356 -604 -345 -831 3 -67 7 -83
                                  33 -121 79 -111 276 -207 586 -283 341 -84 781 -132 1369 -151 l225 -7 -308
                                  316 -308 315 242 584 c133 320 249 604 259 629 l18 46 -98 114 c-54 63 -98
                                  115 -97 116 1 1 34 -8 72 -19 101 -31 349 -31 450 0 38 11 71 20 72 19 1 -1
                                  -43 -53 -97 -116 l-99 -113 18 -46 c11 -26 127 -310 260 -630 l242 -584 -307
                                  -314 -306 -314 108 0 c454 1 1076 62 1428 141 104 24 258 68 268 78 4 3 -7 30
                                  -24 59 l-31 54 -51 -9 c-74 -12 -271 -8 -341 6 -361 74 -654 331 -768 673 -65
                                  193 -70 377 -17 585 41 160 166 365 286 471 29 26 54 50 54 54 0 9 -185 80
                                  -282 108 -43 13 -78 26 -78 30 0 4 17 19 38 32 66 44 203 180 275 273 203 263
                                  325 572 352 890 21 245 -58 543 -201 761 -260 396 -734 608 -1204 539z" />
                                                              <path
                                                                  d="M3740 2585 c-245 -55 -448 -189 -581 -381 -103 -150 -149 -298 -156
                                  -499 -4 -127 -2 -149 21 -240 44 -168 125 -315 235 -426 204 -203 480 -302
                                  756 -269 247 29 466 149 617 339 282 353 265 864 -40 1192 -122 131 -255 213
                                  -428 264 -113 34 -320 43 -424 20z m365 -160 c33 -8 96 -33 140 -54 197 -94
                                  328 -243 401 -456 25 -73 28 -93 28 -230 1 -143 -1 -154 -31 -240 -40 -117
                                  -89 -199 -166 -281 -155 -166 -337 -245 -562 -245 -224 0 -414 83 -562 246
                                  -98 106 -160 227 -190 368 -20 94 -12 266 15 359 86 290 316 493 620 548 65
                                  12 235 4 307 -15z" />
                                                              <path
                                                                  d="M4550 911 c-25 -16 -111 -67 -192 -113 l-147 -84 148 -258 c82 -141
                                  151 -260 154 -263 7 -6 398 219 395 227 -16 35 -301 520 -306 519 -4 0 -27
                                  -13 -52 -28z" />
                                                              <path
                                                                  d="M4755 229 c-104 -60 -191 -112 -195 -115 -10 -11 88 -90 127 -102
                                  147 -44 292 63 293 214 0 50 -16 114 -28 114 -4 0 -92 -50 -197 -111z" />
                        </g>
                    </svg>
                    </div>

                @endif





            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn bg-gradient-primary">Seleccionar Cliente</button>
            </div> --}}
        </div>
    </div>
</div>
