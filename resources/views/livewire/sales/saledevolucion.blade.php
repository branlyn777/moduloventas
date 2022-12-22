@section('css')
    <style>
        /* Estilos para las tablas */
        .table-own {
            width: 100%;
            /* Anchura de ejemplo */
            height: 200px;
            /* Altura de ejemplo */
            overflow: auto;
        }

        .table-own table {
            border-collapse: separate;
            border-spacing: 0;
            border-left: 0.3px solid #ffffff00;
            border-bottom: 0.3px solid #ffffff00;
            width: 100%;
        }

        .table-own table thead {
            position: -webkit-sticky;
            /* Safari... */
            position: sticky;
            top: 0;
            left: 0;
        }

        .table-own table thead tr {
            /* background: #ffffff;
            color: rgb(0, 0, 0); */
        }

        /* .table-own table tbody tr {
                border-top: 0.3px solid rgb(0, 0, 0);
            } */
        .table-own table tbody tr:hover {
            background-color: #8e9ce96c;
        }

        .table-own table td {
            border-top: 0.3px solid #ffffff00;
            padding-left: 10px;
            border-right: 0.3px solid #ffffff00;
        }
    </style>
@endsection
<div>

    <div class="d-sm-flex justify-content-between">
        <div>
            <a href="javascript:;" class="btn btn-icon btn-outline-white">
                New order
            </a>
        </div>
        <div class="d-flex">

            <button wire:click.prevent="modaldevolucion()" class="btn btn-icon btn-outline-white ms-2 export"
                data-type="csv" type="button">
                <span class="btn-inner--icon"><i class="ni ni-fat-add"></i></span>
                <span class="btn-inner--text">Nueva Devolución</span>
            </button>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="table-responsive">
                    <div class="datatable-own dataTable-loading no-footer sortable searchable fixed-columns">

                        <div class="dataTable-container">
                            <table class="table table-flush dataTable-table" id="datatable-search">
                                <thead class="thead-light">
                                    <tr>
                                        <th data-sortable="" style="width: 14.6527%;">
                                            No
                                        </th>
                                        <th data-sortable="" style="width: 16.3654%;">
                                            Código
                                        </th>
                                        <th data-sortable="" style="width: 16.2702%;">
                                            Usuario
                                        </th>
                                        <th data-sortable="" style="width: 19.6004%;">
                                            Monto
                                        </th>
                                        <th data-sortable="" style="width: 22.3597%;">
                                            Fecha
                                        </th>
                                        <th data-sortable="" style="width: 10.7517%;">
                                            Detalles
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="customCheck1">
                                                </div>
                                                <p class="text-xs font-weight-bold ms-2 mb-0">#10421</p>
                                            </div>
                                        </td>
                                        <td class="font-weight-bold">
                                            <span class="my-2 text-xs">1 Nov, 10:20 AM</span>
                                        </td>
                                        <td class="text-xs font-weight-bold">
                                            <div class="d-flex align-items-center">
                                                <button
                                                    class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-2 btn-sm d-flex align-items-center justify-content-center"><i
                                                        class="fas fa-check" aria-hidden="true"></i></button>
                                                <span>Paid</span>
                                            </div>
                                        </td>
                                        <td class="text-xs font-weight-bold">
                                            <div class="d-flex align-items-center">
                                                <img src="../../../assets/img/team-2.jpg" class="avatar avatar-xs me-2"
                                                    alt="user image">
                                                <span>Orlando Imieto</span>
                                            </div>
                                        </td>
                                        <td class="text-xs font-weight-bold">
                                            <span class="my-2 text-xs">Nike Sport V2</span>
                                        </td>
                                        <td class="text-xs font-weight-bold">
                                            <span class="my-2 text-xs">$140,20</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="form-check pt-0">
                                                    <input class="form-check-input" type="checkbox" id="customCheck2">
                                                </div>
                                                <p class="text-xs font-weight-bold ms-2 mb-0">#10422</p>
                                            </div>
                                        </td>
                                        <td class="font-weight-bold">
                                            <span class="my-2 text-xs">1 Nov, 10:53 AM</span>
                                        </td>
                                        <td class="text-xs font-weight-bold">
                                            <div class="d-flex align-items-center">
                                                <button
                                                    class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-2 btn-sm d-flex align-items-center justify-content-center"><i
                                                        class="fas fa-check" aria-hidden="true"></i></button>
                                                <span>Paid</span>
                                            </div>
                                        </td>
                                        <td class="text-xs font-weight-bold">
                                            <div class="d-flex align-items-center">
                                                <img src="../../../assets/img/team-1.jpg" class="avatar avatar-xs me-2"
                                                    alt="user image">
                                                <span>Alice Murinho</span>
                                            </div>
                                        </td>
                                        <td class="font-weight-bold">
                                            <span class="my-2 text-xs">Valvet T-shirt</span>
                                        </td>
                                        <td class="font-weight-bold">
                                            <span class="my-2 text-xs">$42,00</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="customCheck3">
                                                </div>
                                                <p class="text-xs font-weight-bold ms-2 mb-0">#10423</p>
                                            </div>
                                        </td>
                                        <td class="font-weight-bold">
                                            <span class="my-2 text-xs">1 Nov, 11:13 AM</span>
                                        </td>
                                        <td class="text-xs font-weight-bold">
                                            <div class="d-flex align-items-center">
                                                <button
                                                    class="btn btn-icon-only btn-rounded btn-outline-dark mb-0 me-2 btn-sm d-flex align-items-center justify-content-center"><i
                                                        class="fas fa-undo" aria-hidden="true"></i></button>
                                                <span>Refunded</span>
                                            </div>
                                        </td>
                                        <td class="text-xs font-weight-bold">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-xs me-2 bg-gradient-dark">
                                                    <span>M</span>
                                                </div>
                                                <span>Michael Mirra</span>
                                            </div>
                                        </td>
                                        <td class="text-xs font-weight-bold">
                                            <span class="my-2 text-xs">
                                                Leather Wallet
                                                <span class="text-secondary ms-2"> +1 more </span>
                                            </span>
                                        </td>
                                        <td class="text-xs font-weight-bold">
                                            <span class="my-2 text-xs">$25,50</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="customCheck4">
                                                </div>
                                                <p class="text-xs font-weight-bold ms-2 mb-0">#10424</p>
                                            </div>
                                        </td>
                                        <td class="font-weight-bold">
                                            <span class="my-2 text-xs">1 Nov, 12:20 PM</span>
                                        </td>
                                        <td class="text-xs font-weight-bold">
                                            <div class="d-flex align-items-center">
                                                <button
                                                    class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-2 btn-sm d-flex align-items-center justify-content-center"><i
                                                        class="fas fa-check" aria-hidden="true"></i></button>
                                                <span>Paid</span>
                                            </div>
                                        </td>
                                        <td class="text-xs font-weight-bold">
                                            <div class="d-flex align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <img src="../../../assets/img/team-3.jpg"
                                                        class="avatar avatar-xs me-2" alt="user image">
                                                    <span>Andrew Nichel</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-xs font-weight-bold">
                                            <span class="my-2 text-xs">
                                                Bracelet Onu-Lino
                                            </span>
                                        </td>
                                        <td class="text-xs font-weight-bold">
                                            <span class="my-2 text-xs">$19,40</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="customCheck5">
                                                </div>
                                                <p class="text-xs font-weight-bold ms-2 mb-0">#10425</p>
                                            </div>
                                        </td>
                                        <td class="font-weight-bold">
                                            <span class="my-2 text-xs">1 Nov, 1:40 PM</span>
                                        </td>
                                        <td class="text-xs font-weight-bold">
                                            <div class="d-flex align-items-center">
                                                <button
                                                    class="btn btn-icon-only btn-rounded btn-outline-danger mb-0 me-2 btn-sm d-flex align-items-center justify-content-center"><i
                                                        class="fas fa-times" aria-hidden="true"></i></button>
                                                <span>Canceled</span>
                                            </div>
                                        </td>
                                        <td class="text-xs font-weight-bold">
                                            <div class="d-flex align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <img src="../../../assets/img/team-4.jpg"
                                                        class="avatar avatar-xs me-2" alt="user image">
                                                    <span>Sebastian Koga</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-xs font-weight-bold">
                                            <span class="my-2 text-xs">
                                                Phone Case Pink
                                                <span class="text-secondary ms-2"> x 2 </span>
                                            </span>
                                        </td>
                                        <td class="text-xs font-weight-bold">
                                            <span class="my-2 text-xs">$44,90</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="customCheck6">
                                                </div>
                                                <p class="text-xs font-weight-bold ms-2 mb-0">#10426</p>
                                            </div>
                                        </td>
                                        <td class="font-weight-bold">
                                            <span class="my-2 text-xs">1 Nov, 2:19 AM</span>
                                        </td>
                                        <td class="text-xs font-weight-bold">
                                            <div class="d-flex align-items-center">
                                                <button
                                                    class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-2 btn-sm d-flex align-items-center justify-content-center"><i
                                                        class="fas fa-check" aria-hidden="true"></i></button>
                                                <span>Paid</span>
                                            </div>
                                        </td>
                                        <td class="text-xs font-weight-bold">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-xs me-2 bg-gradient-primary">
                                                    <span>L</span>
                                                </div>
                                                <span>Laur Gilbert</span>
                                            </div>
                                        </td>
                                        <td class="text-xs font-weight-bold">
                                            <span class="my-2 text-xs">
                                                Backpack Niver
                                            </span>
                                        </td>
                                        <td class="text-xs font-weight-bold">
                                            <span class="my-2 text-xs">$112,50</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="customCheck7">
                                                </div>
                                                <p class="text-xs font-weight-bold ms-2 mb-0">#10427</p>
                                            </div>
                                        </td>
                                        <td class="font-weight-bold">
                                            <span class="my-2 text-xs">1 Nov, 3:42 AM</span>
                                        </td>
                                        <td class="text-xs font-weight-bold">
                                            <div class="d-flex align-items-center">
                                                <button
                                                    class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-2 btn-sm d-flex align-items-center justify-content-center"><i
                                                        class="fas fa-check" aria-hidden="true"></i></button>
                                                <span>Paid</span>
                                            </div>
                                        </td>
                                        <td class="text-xs font-weight-bold">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-xs me-2 bg-gradient-dark">
                                                    <span>I</span>
                                                </div>
                                                <span>Iryna Innda</span>
                                            </div>
                                        </td>
                                        <td class="text-xs font-weight-bold">
                                            <span class="my-2 text-xs">
                                                Adidas Vio
                                            </span>
                                        </td>
                                        <td class="text-xs font-weight-bold">
                                            <span class="my-2 text-xs">$200,00</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="customCheck8">
                                                </div>
                                                <p class="text-xs font-weight-bold ms-2 mb-0">#10428</p>
                                            </div>
                                        </td>
                                        <td class="font-weight-bold">
                                            <span class="my-2 text-xs">2 Nov, 9:32 AM</span>
                                        </td>
                                        <td class="text-xs font-weight-bold">
                                            <div class="d-flex align-items-center">
                                                <button
                                                    class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-2 btn-sm d-flex align-items-center justify-content-center"><i
                                                        class="fas fa-check" aria-hidden="true"></i></button>
                                                <span>Paid</span>
                                            </div>
                                        </td>
                                        <td class="text-xs font-weight-bold">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-xs me-2 bg-gradient-dark">
                                                    <span>A</span>
                                                </div>
                                                <span>Arrias Liunda</span>
                                            </div>
                                        </td>
                                        <td class="text-xs font-weight-bold">
                                            <span class="my-2 text-xs">
                                                Airpods 2 Gen
                                            </span>
                                        </td>
                                        <td class="text-xs font-weight-bold">
                                            <span class="my-2 text-xs">$350,00</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="customCheck9">
                                                </div>
                                                <p class="text-xs font-weight-bold ms-2 mb-0">#10429</p>
                                            </div>
                                        </td>
                                        <td class="font-weight-bold">
                                            <span class="my-2 text-xs">2 Nov, 10:14 AM</span>
                                        </td>
                                        <td class="text-xs font-weight-bold">
                                            <div class="d-flex align-items-center">
                                                <button
                                                    class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-2 btn-sm d-flex align-items-center justify-content-center"><i
                                                        class="fas fa-check" aria-hidden="true"></i></button>
                                                <span>Paid</span>
                                            </div>
                                        </td>
                                        <td class="text-xs font-weight-bold">
                                            <div class="d-flex align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <img src="../../../assets/img/team-5.jpg"
                                                        class="avatar avatar-xs me-2" alt="user image">
                                                    <span>Rugna Ilpio</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-xs font-weight-bold">
                                            <span class="my-2 text-xs">
                                                Bracelet Warret
                                            </span>
                                        </td>
                                        <td class="text-xs font-weight-bold">
                                            <span class="my-2 text-xs">$15,00</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="customCheck10">
                                                </div>
                                                <p class="text-xs font-weight-bold ms-2 mb-0">#10430</p>
                                            </div>
                                        </td>
                                        <td class="font-weight-bold">
                                            <span class="my-2 text-xs">2 Nov, 12:56 PM</span>
                                        </td>
                                        <td class="text-xs font-weight-bold">
                                            <div class="d-flex align-items-center">
                                                <button
                                                    class="btn btn-icon-only btn-rounded btn-outline-dark mb-0 me-2 btn-sm d-flex align-items-center justify-content-center"><i
                                                        class="fas fa-undo" aria-hidden="true"></i></button>
                                                <span>Refunded</span>
                                            </div>
                                        </td>
                                        <td class="text-xs font-weight-bold">
                                            <div class="d-flex align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <img src="../../../assets/img/ivana-squares.jpg"
                                                        class="avatar avatar-xs me-2" alt="user image">
                                                    <span>Anna Landa</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-xs font-weight-bold">
                                            <span class="my-2 text-xs">
                                                Watter Bottle India
                                                <span class="text-secondary ms-2"> x 3 </span>
                                            </span>
                                        </td>
                                        <td class="text-xs font-weight-bold">
                                            <span class="my-2 text-xs">$25,00</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @include('livewire.sales.modaldev')
</div>

@section('javascript')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            //Mostrar ventana modal detalle venta
            window.livewire.on('modaldevolucion-show', msg => {
                $('#modaldevolucion').modal('show')
            });
        });

        function Confirm(id) {
            swal.fire({
                title: 'CONFIRMAR',
                icon: 'warning',
                text: '¿Seguro que quiere Eliminar esta Devolución? Se reventiran todos los cambios guardados',
                showCancelButton: true,
                cancelButtonText: 'Cerrar',
                cancelButtonColor: '#383838',
                confirmButtonColor: '#3B3F5C',
                confirmButtonText: 'Aceptar'
            }).then(function(result) {
                if (result.value) {
                    window.livewire.emit('eliminardevolucion', id)
                    Swal.close()
                }
            })
        }
    </script>
@endsection
