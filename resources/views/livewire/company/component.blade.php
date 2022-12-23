<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-4">Datos de tu Empresa</h5>
                    <div class="row">
                        <div class="col-xl-5 col-lg-6 text-center">

                            <div style="border: 0.3px solid #bfc7f5;">
                                <img wire:model="image" class="w-100 border-radius-lg shadow-lg mx-auto"
                                    src="{{ asset('storage/iconos/' . $imagen) }}" alt="chair">



                                <input type="file" class="custom-file-input form-control" wire:model="image"
                                    accept="image/x-png,image/gif,image/jpeg">
                            </div>


                            <div class="my-gallery d-flex mt-4 pt-2" itemscope=""
                                itemtype="http://schema.org/ImageGallery" data-pswp-uid="1">




                                <table style="width: 100%">
                                    <tfoot>
                                        <tr>
                                            <td>
                                                <img height="16px" width="16px"
                                                    src="{{ asset('storage/iconos/' . $imagen) }}"
                                                    alt="Image description">
                                            </td>
                                            <td>
                                                <img height="24px" width="24px"
                                                    src="{{ asset('storage/iconos/' . $imagen) }}" itemprop="thumbnail"
                                                    alt="Image description">
                                            </td>
                                            <td>
                                                <img height="32px" width="32px"
                                                    src="{{ asset('storage/iconos/' . $imagen) }}" itemprop="thumbnail"
                                                    alt="Image description">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="">16x16</label>
                                            </td>
                                            <td>
                                                <label for="">24x24</label>
                                            </td>
                                            <td>
                                                <label for="">32x32</label>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>







                                {{-- <figure class="me-3" itemprop="associatedMedia" itemscope=""
                                    itemtype="http://schema.org/ImageObject">
                                    <img height="50px" width="50px"
                                            src="{{ asset('storage/iconos/' . $imagen) }}"
                                            itemprop="thumbnail" alt="Image description">
                                            <br>
                                            <label for="">50 : 50</label>
                                </figure>
                                <figure itemprop="associatedMedia" itemscope=""
                                    itemtype="http://schema.org/ImageObject">
                                    <img height="120" width="120px"
                                            src="{{ asset('storage/iconos/' . $imagen) }}"
                                            itemprop="thumbnail" alt="Image description">
                                            <br>
                                            <label for="">120px : 120px</label>
                                </figure> --}}
                            </div>

                            <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

                                <div class="pswp__bg"></div>

                                <div class="pswp__scroll-wrap">


                                    <div class="pswp__container">
                                        <div class="pswp__item"></div>
                                        <div class="pswp__item"></div>
                                        <div class="pswp__item"></div>
                                    </div>

                                    <div class="pswp__ui pswp__ui--hidden">
                                        <div class="pswp__top-bar">

                                            <div class="pswp__counter"></div>
                                            <button class="btn btn-white btn-sm pswp__button pswp__button--close">Close
                                                (Esc)</button>
                                            <button
                                                class="btn btn-white btn-sm pswp__button pswp__button--fs">Fullscreen</button>
                                            <button
                                                class="btn btn-white btn-sm pswp__button pswp__button--arrow--left">Prev
                                            </button>
                                            <button
                                                class="btn btn-white btn-sm pswp__button pswp__button--arrow--right">Next
                                            </button>


                                            <div class="pswp__preloader">
                                                <div class="pswp__preloader__icn">
                                                    <div class="pswp__preloader__cut">
                                                        <div class="pswp__preloader__donut"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                                            <div class="pswp__share-tooltip"></div>
                                        </div>
                                        <div class="pswp__caption">
                                            <div class="pswp__caption__center"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 mx-auto">

                            <h6 class="mb-0 mt-3">Nombre de la Empresa</h6>
                            <input wire:model="nombre_empresa" class="form-control" type="text" value="{{ $nombre_empresa }}">

                            <h6 class="mb-0 mt-3">Nombre Corto</h6>
                            <input class="form-control" type="text" value="{{ $nombre_corto }}">

                            <h6 class="mb-0 mt-3">Dirección</h6>
                            <input class="form-control" type="text" value="{{ $direccion }}">



                            <h6 class="mb-0 mt-3">Teléfono</h6>
                            <input class="form-control" type="text" value="{{ $telefono }}">

                            <h6 class="mb-0 mt-3">Celular</h6>
                            <input class="form-control" type="text" value="{{ $celular }}">

                            <h6 class="mb-0 mt-3">Nit</h6>
                            <input class="form-control" type="text" value="{{ $nit_id }}">

                            <h6 class="mb-0 mt-3">Fecha Última Actualización</h6>
                            <div class="form-control">
                                {{ $updated_at }}
                            </div>

                            <br>

                            <button wire:click.prevent="actualizar()" class="btn btn-primary">
                                Actualizar Datos
                            </button>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer pt-3  ">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-lg-between">
                <div class="col-lg-6 mb-lg-0 mb-4">
                    <div class="copyright text-center text-sm text-muted text-lg-start">
                        ©
                        <script>
                            document.write(new Date().getFullYear())
                        </script>2022,
                        made with <i class="fa fa-heart" aria-hidden="true"></i> by
                        <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative
                            Tim</a>
                        for a better web.
                    </div>
                </div>
                <div class="col-lg-6">
                    <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                        <li class="nav-item">
                            <a href="https://www.creative-tim.com" class="nav-link text-muted"
                                target="_blank">Creative Tim</a>
                        </li>
                        <li class="nav-item">
                            <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted"
                                target="_blank">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a href="https://www.creative-tim.com/blog" class="nav-link text-muted"
                                target="_blank">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted"
                                target="_blank">License</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</div>
