<div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="card  mb-4">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Ventas Mes</p>
                                            <h5 class="font-weight-bolder">
                                                Bs. {{$ventasMes}}
                                            </h5>
                                            <p class="mb-0">
                                                <span class="text-success text-sm font-weight-bolder">{{round($difVenta)}}%</span>
                                               
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div
                                            class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                            <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="card  mb-4">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Compras Mes</p>
                                            <h5 class="font-weight-bolder">
                                                Bs. {{$comprasMes}}
                                            </h5>
                                            <p class="mb-0">
                                                <span class="text-success text-sm font-weight-bolder">{{round($difCompra)}}%</span>
                                              
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div
                                            class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                            <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="card  mb-4">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Ingresos Mes</p>
                                            <h5 class="font-weight-bolder">
                                                Bs. {{$ingresosMes}}
                                            </h5>
                                            <p class="mb-0">
                                                <span class="text-danger text-sm font-weight-bolder">{{round($difIngresos)}}%</span>
                                              
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div
                                            class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                            <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="card  mb-4">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Egresos Mes</p>
                                            <h5 class="font-weight-bolder">
                                                Bs. {{$egresosMes}}
                                            </h5>
                                            <p class="mb-0">
                                                <span class="text-success text-sm font-weight-bolder">{{round($difEgresos)}}%</span>
                                                
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div
                                            class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                            <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-7 mb-4 mb-lg-0">
                <div class="card z-index-2 h-100">
                    <div class="card-header pb-0 pt-3 bg-transparent">
                        <h6 class="text-capitalize">Compras y Ventas</h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="chart">
                            <canvas id="myChart" class="chart-canvas" height="300"
                                style="display: block; box-sizing: border-box; height: 300px; width: 635.8px;"
                                width="635"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card card-carousel overflow-hidden h-100 p-0">
                    <div id="carouselExampleCaptions" class="carousel slide h-100" data-bs-ride="carousel">
                        <div class="carousel-inner border-radius-lg h-100">
                            <div class="carousel-item h-100" style="background-image: url('../../assets/img/img-2.jpg');
              background-size: cover;">
                                <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-1">
                                    <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                                        <i class="ni ni-camera-compact text-dark opacity-10"></i>
                                    </div>
                                    <h5 class="text-white mb-1">Get started with Argon</h5>
                                    <p>There’s nothing I really wanted to do in life that I wasn’t able to get good at.
                                    </p>
                                </div>
                            </div>
                            <div class="carousel-item h-100 active">
                                <iframe src='https://my.spline.design/kidsplaygroundphysicscopy-5ab12c2c36aae4dba5a8c18eaee54114/' frameborder='0' width='100%' height='100%'></iframe>
                            </div>
                            <div class="carousel-item h-100" style="background-image: url('../../assets/img/img-3.jpg');
              background-size: cover;">
                                <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-2">
                                    <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                                        <i class="ni ni-trophy text-dark opacity-10"></i>
                                    </div>
                                    <h5 class="text-white mb-1">Share with us your design tips!</h5>
                                    <p>Don’t be afraid to be wrong because you can’t learn anything from a compliment.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev w-5 me-3" type="button"
                            data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next w-5 me-3" type="button"
                            data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                <div class="card h-100 ">
                    <div class="card-header">
                        <h5 class="mb-0 text-capitalize">Team members</h5>
                    </div>
                    <div class="card-body pt-0">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-auto d-flex align-items-center">
                                        <a href="javascript:;" class="avatar">
                                            <img class="border-radius-lg" alt="Image placeholder"
                                                src="../../assets/img/team-1.jpg">
                                        </a>
                                    </div>
                                    <div class="col ml-2">
                                        <h6 class="mb-0">
                                            <a href="javascript:;">John Michael</a>
                                        </h6>
                                        <span class="badge badge-success badge-sm">Online</span>
                                    </div>
                                    <div class="col-auto">
                                        <button type="button" class="btn btn-outline-primary btn-xs mb-0">Add</button>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-auto d-flex align-items-center">
                                        <a href="javascript:;" class="avatar">
                                            <img class="border-radius-lg" alt="Image placeholder"
                                                src="../../assets/img/team-2.jpg">
                                        </a>
                                    </div>
                                    <div class="col ml-2">
                                        <h6 class="mb-0">
                                            <a href="javascript:;">Alex Smith</a>
                                        </h6>
                                        <span class="badge badge-warning badge-sm">in Meeting</span>
                                    </div>
                                    <div class="col-auto">
                                        <button type="button" class="btn btn-xs btn-outline-primary mb-0">Add</button>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-auto d-flex align-items-center">
                                        <a href="javascript:;" class="avatar">
                                            <img class="border-radius-lg" alt="Image placeholder"
                                                src="../../assets/img/team-5.jpg">
                                        </a>
                                    </div>
                                    <div class="col ml-2">
                                        <h6 class="mb-0">
                                            <a href="javascript:;">Samantha Ivy</a>
                                        </h6>
                                        <span class="badge badge-danger badge-sm">Offline</span>
                                    </div>
                                    <div class="col-auto">
                                        <button type="button" class="btn btn-xs btn-outline-primary mb-0">Add</button>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-auto d-flex align-items-center">
                                        <a href="javascript:;" class="avatar">
                                            <img class="border-radius-lg" alt="Image placeholder"
                                                src="../../assets/img/team-4.jpg">
                                        </a>
                                    </div>
                                    <div class="col ml-2">
                                        <h6 class="mb-0">
                                            <a href="javascript:;">John Michael</a>
                                        </h6>
                                        <span class="badge badge-success badge-sm">Online</span>
                                    </div>
                                    <div class="col-auto">
                                        <button type="button" class="btn btn-xs btn-outline-primary mb-0">Add</button>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                <div class="card h-100 ">
                    <div class="card-header">
                        <h5 class="mb-0 text-capitalize">To do list</h5>
                    </div>
                    <div class="card-body pt-0">
                        <ul class="list-group list-group-flush" data-toggle="checklist">
                            <li class="checklist-entry list-group-item px-0">
                                <div class="checklist-item checklist-item-success checklist-item-checked d-flex">
                                    <div class="checklist-info">
                                        <h6 class="checklist-title mb-0">Call with Dave</h6>
                                        <small class="text-xs">09:30 AM</small>
                                    </div>
                                    <div class="form-check my-auto ms-auto">
                                        <input class="form-check-input" type="checkbox" id="customCheck1" checked="">
                                    </div>
                                </div>
                            </li>
                            <li class="checklist-entry list-group-item px-0">
                                <div class="checklist-item checklist-item-warning d-flex">
                                    <div class="checklist-info">
                                        <h6 class="checklist-title mb-0">Brunch Meeting</h6>
                                        <small class="text-xs">11:00 AM</small>
                                    </div>
                                    <div class="form-check my-auto ms-auto">
                                        <input class="form-check-input" type="checkbox" id="customCheck1">
                                    </div>
                                </div>
                            </li>
                            <li class="checklist-entry list-group-item px-0">
                                <div class="checklist-item checklist-item-info d-flex">
                                    <div class="checklist-info">
                                        <h6 class="checklist-title mb-0">Argon Dashboard Launch</h6>
                                        <small class="text-xs">02:00 PM</small>
                                    </div>
                                    <div class="form-check my-auto ms-auto">
                                        <input class="form-check-input" type="checkbox" id="customCheck1">
                                    </div>
                                </div>
                            </li>
                            <li class="checklist-entry list-group-item px-0">
                                <div class="checklist-item checklist-item-danger checklist-item-checked d-flex">
                                    <div class="checklist-info">
                                        <h6 class="checklist-title mb-0">Winter Hackaton</h6>
                                        <small>10:30 AM</small>
                                    </div>
                                    <div class="form-check my-auto ms-auto">
                                        <input class="form-check-input" type="checkbox" id="customCheck2" checked="">
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card h-100 ">
                    <div class="card-header">
                        <h5 class="mb-0 text-capitalize">Progress track</h5>
                    </div>
                    <div class="card-body pt-0">
                        <ul class="list-group list-group-flush list">
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <a href="javascript:;" class="avatar rounded-circle">
                                            <img alt="Image placeholder"
                                                src="../../assets/img/small-logos/logo-jira.svg">
                                        </a>
                                    </div>
                                    <div class="col">
                                        <h6>React Material Dashboard</h6>
                                        <div class="progress progress-xs mb-0">
                                            <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="90"
                                                aria-valuemin="0" aria-valuemax="100" style="width: 90%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <a href="javascript:;" class="avatar rounded-circle">
                                            <img alt="Image placeholder"
                                                src="../../assets/img/small-logos/logo-asana.svg">
                                        </a>
                                    </div>
                                    <div class="col">
                                        <h6>Argon Design System</h6>
                                        <div class="progress progress-xs mb-0">
                                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="60"
                                                aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <a href="javascript:;" class="avatar rounded-circle">
                                            <img alt="Image placeholder"
                                                src="../../assets/img/small-logos/logo-spotify.svg">
                                        </a>
                                    </div>
                                    <div class="col">
                                        <h6>VueJs Now UI Kit PRO</h6>
                                        <div class="progress progress-xs mb-0">
                                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="100"
                                                aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <a href="javascript:;" class="avatar rounded-circle">
                                            <img alt="Image placeholder"
                                                src="../../assets/img/small-logos/bootstrap.svg">
                                        </a>
                                    </div>
                                    <div class="col">
                                        <h6>Soft UI Dashboard</h6>
                                        <div class="progress progress-xs mb-0">
                                            <div class="progress-bar bg-gradient-primary" role="progressbar"
                                                aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"
                                                style="width: 72%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12 col-lg-5">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center border-bottom py-3">
                        <div class="d-flex align-items-center">
                            <a href="javascript:;">
                                <img src="../../assets/img/team-4.jpg" class="avatar" alt="profile-image">
                            </a>
                            <div class="mx-3">
                                <a href="javascript:;" class="text-dark font-weight-600 text-sm">John Snow</a>
                                <small class="d-block text-muted">3 days ago</small>
                            </div>
                        </div>
                        <div class="text-end ms-auto">
                            <button type="button" class="btn btn-xs btn-primary mb-0">
                                <i class="fas fa-plus pe-2" aria-hidden="true"></i> Follow
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="mb-4">
                            Personal profiles are the perfect way for you to grab their attention and persuade
                            recruiters to continue reading your CV because you’re telling them from the off exactly why
                            they should hire you.
                        </p>
                        <img alt="Image placeholder"
                            src="https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/activity-feed.jpg"
                            class="img-fluid border-radius-lg shadow-lg max-height-500">
                        <div class="row align-items-center px-2 mt-4 mb-2">
                            <div class="col-sm-6">
                                <div class="d-flex">
                                    <div class="d-flex align-items-center">
                                        <i class="ni ni-like-2 me-1 cursor-pointer opacity-6"></i>
                                        <span class="text-sm me-3 ">150</span>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <i class="ni ni-chat-round me-1 cursor-pointer opacity-6"></i>
                                        <span class="text-sm me-3">36</span>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <i class="ni ni-curved-next me-1 cursor-pointer opacity-6"></i>
                                        <span class="text-sm me-2">12</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 d-none d-sm-block">
                                <div class="d-flex align-items-center justify-content-sm-end">
                                    <div class="d-flex align-items-center">
                                        <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                            data-toggle="tooltip" data-original-title="Jessica Rowland">
                                            <img alt="Image placeholder" src="../../assets/img/team-5.jpg" class="">
                                        </a>
                                        <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                            data-toggle="tooltip" data-original-title="Audrey Love">
                                            <img alt="Image placeholder" src="../../assets/img/team-2.jpg"
                                                class="rounded-circle">
                                        </a>
                                        <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                            data-toggle="tooltip" data-original-title="Michael Lewis">
                                            <img alt="Image placeholder" src="../../assets/img/team-1.jpg"
                                                class="rounded-circle">
                                        </a>
                                    </div>
                                    <small class="ps-2 font-weight-bold">and 30+ more</small>
                                </div>
                            </div>
                            <hr class="horizontal dark my-3">
                        </div>

                        <div class="mb-1">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <img alt="Image placeholder" class="avatar rounded-circle"
                                        src="../../assets/img/bruce-mars.jpg">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="h5 mt-0">Michael Lewis</h6>
                                    <p class="text-sm">I always felt like I could do anything. That’s the main thing
                                        people are controlled by! Thoughts- their perception of themselves!</p>
                                    <div class="d-flex">
                                        <div>
                                            <i class="ni ni-like-2 me-1 cursor-pointer opacity-6"></i>
                                        </div>
                                        <span class="text-sm me-2">3 likes</span>
                                        <div>
                                            <i class="ni ni-curved-next me-1 cursor-pointer opacity-6"></i>
                                        </div>
                                        <span class="text-sm me-2">2 shares</span>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex mt-3">
                                <div class="flex-shrink-0">
                                    <img alt="Image placeholder" class="avatar rounded-circle"
                                        src="../../assets/img/team-5.jpg">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="h5 mt-0">Jessica Stones</h6>
                                    <p class="text-sm">Society has put up so many boundaries, so many limitations on
                                        what’s right and wrong that it’s almost impossible to get a pure thought out.
                                        It’s like a little kid, a little boy.</p>
                                    <div class="d-flex">
                                        <div>
                                            <i class="ni ni-like-2 me-1 cursor-pointer opacity-6"></i>
                                        </div>
                                        <span class="text-sm me-2">10 likes</span>
                                        <div>
                                            <i class="ni ni-curved-next me-1 cursor-pointer opacity-6"></i>
                                        </div>
                                        <span class="text-sm me-2">1 share</span>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex mt-4">
                                <div class="flex-shrink-0">
                                    <img alt="Image placeholder" class="avatar rounded-circle me-3"
                                        src="../../assets/img/team-4.jpg">
                                </div>
                                <div class="flex-grow-1 my-auto">
                                    <form>
                                        <textarea class="form-control" placeholder="Write your comment"
                                            rows="1"></textarea>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-7">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-dark text-xxs font-weight-bolder opacity-7">
                                            Project</th>
                                        <th class="text-uppercase text-dark text-xxs font-weight-bolder opacity-7 ps-2">
                                            Budget</th>
                                        <th class="text-uppercase text-dark text-xxs font-weight-bolder opacity-7 ps-2">
                                            Status</th>
                                        <th class="text-uppercase text-dark text-xxs font-weight-bolder opacity-7 ps-2">
                                            Completion</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2">
                                                <div>
                                                    <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/logos/small-logos/logo-spotify.svg"
                                                        class="avatar avatar-sm rounded-circle me-2">
                                                </div>
                                                <div class="my-auto">
                                                    <h6 class="mb-0 text-xs">Spotify</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">$2,500</p>
                                        </td>
                                        <td>
                                            <span class="badge badge-dot me-4">
                                                <i class="bg-info"></i>
                                                <span class="text-dark text-xs">working</span>
                                            </span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="d-flex align-items-center">
                                                <span class="me-2 text-xs">60%</span>
                                                <div>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                                            style="width: 60%;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <button class="btn btn-link text-dark mb-0">
                                                <i class="fa fa-ellipsis-v text-xs" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2">
                                                <div>
                                                    <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/logos/small-logos/logo-invision.svg"
                                                        class="avatar avatar-sm rounded-circle me-2">
                                                </div>
                                                <div class="my-auto">
                                                    <h6 class="mb-0 text-xs">Invision</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">$5,000</p>
                                        </td>
                                        <td>
                                            <span class="badge badge-dot me-4">
                                                <i class="bg-success"></i>
                                                <span class="text-dark text-xs">done</span>
                                            </span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="d-flex align-items-center">
                                                <span class="me-2 text-xs">100%</span>
                                                <div>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-success" role="progressbar"
                                                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"
                                                            style="width: 100%;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <button class="btn btn-link text-dark mb-0" aria-haspopup="true"
                                                aria-expanded="false">
                                                <i class="fa fa-ellipsis-v text-xs" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2">
                                                <div>
                                                    <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/logos/small-logos/logo-jira.svg"
                                                        class="avatar avatar-sm rounded-circle me-2">
                                                </div>
                                                <div class="my-auto">
                                                    <h6 class="mb-0 text-xs">Jira</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">$3,400</p>
                                        </td>
                                        <td>
                                            <span class="badge badge-dot me-4">
                                                <i class="bg-danger"></i>
                                                <span class="text-dark text-xs">canceled</span>
                                            </span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="d-flex align-items-center">
                                                <span class="me-2 text-xs">30%</span>
                                                <div>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-danger" role="progressbar"
                                                            aria-valuenow="30" aria-valuemin="0" aria-valuemax="30"
                                                            style="width: 30%;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <button class="btn btn-link text-dark mb-0" aria-haspopup="true"
                                                aria-expanded="false">
                                                <i class="fa fa-ellipsis-v text-xs" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2">
                                                <div>
                                                    <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/logos/small-logos/logo-slack.svg"
                                                        class="avatar avatar-sm rounded-circle me-2">
                                                </div>
                                                <div class="my-auto">
                                                    <h6 class="mb-0 text-xs">Slack</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">$1,000</p>
                                        </td>
                                        <td>
                                            <span class="badge badge-dot me-4">
                                                <i class="bg-danger"></i>
                                                <span class="text-dark text-xs">canceled</span>
                                            </span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="d-flex align-items-center">
                                                <span class="me-2 text-xs">0%</span>
                                                <div>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-success" role="progressbar"
                                                            aria-valuenow="0" aria-valuemin="0" aria-valuemax="0"
                                                            style="width: 0%;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <button class="btn btn-link text-dark mb-0" aria-haspopup="true"
                                                aria-expanded="false">
                                                <i class="fa fa-ellipsis-v text-xs" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2">
                                                <div>
                                                    <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/logos/small-logos/logo-webdev.svg"
                                                        class="avatar avatar-sm rounded-circle me-2">
                                                </div>
                                                <div class="my-auto">
                                                    <h6 class="mb-0 text-xs">Webdev</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">$14,000</p>
                                        </td>
                                        <td>
                                            <span class="badge badge-dot me-4">
                                                <i class="bg-info"></i>
                                                <span class="text-dark text-xs">working</span>
                                            </span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="d-flex align-items-center">
                                                <span class="me-2 text-xs">80%</span>
                                                <div>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            aria-valuenow="80" aria-valuemin="0" aria-valuemax="80"
                                                            style="width: 80%;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <button class="btn btn-link text-dark mb-0" aria-haspopup="true"
                                                aria-expanded="false">
                                                <i class="fa fa-ellipsis-v text-xs" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2">
                                                <div>
                                                    <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/logos/small-logos/logo-xd.svg"
                                                        class="avatar avatar-sm rounded-circle me-2">
                                                </div>
                                                <div class="my-auto">
                                                    <h6 class="mb-0 text-xs">Adobe XD</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">$2,300</p>
                                        </td>
                                        <td>
                                            <span class="badge badge-dot me-4">
                                                <i class="bg-success"></i>
                                                <span class="text-dark text-xs">done</span>
                                            </span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="d-flex align-items-center">
                                                <span class="me-2 text-xs">100%</span>
                                                <div>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-success" role="progressbar"
                                                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"
                                                            style="width: 100%;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <button class="btn btn-link text-dark mb-0" aria-haspopup="true"
                                                aria-expanded="false">
                                                <i class="fa fa-ellipsis-v text-xs" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12 col-md-6 mb-4 mb-md-0">
                        <div class="card bg-gradient-dark">
                            <div class="card-body">
                                <div class="mb-2">
                                    <sup class="text-white">$</sup> <span class="h2 text-white">3,300</span>
                                    <div class="text-white opacity-8 mt-2 text-sm">Your current balance</div>
                                    <div>
                                        <span class="text-success font-weight-600">+ 15%</span> <span
                                            class="text-white opacity-8">($250)</span>
                                    </div>
                                </div>
                                <button class="btn btn-sm btn-white mb-0 w-100">Add credit</button>
                            </div>
                            <div class="card-footer pt-0">
                                <div class="row">
                                    <div class="col">
                                        <small class="text-white opacity-8">Orders: 60%</small>
                                        <div class="progress progress-xs my-2">
                                            <div class="progress-bar bg-success" style="width: 60%"></div>
                                        </div>
                                    </div>
                                    <div class="col"><small class="text-white opacity-8">Sales: 40%</small>
                                        <div class="progress progress-xs my-2">
                                            <div class="progress-bar bg-warning" style="width: 40%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="card bg-gradient-danger h-100">
                            <div class="card-body">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col">
                                        <img src="../../assets/img/logos/bitcoin.jpg" class="w-30 border-radius-md"
                                            alt="Image placeholder">
                                    </div>
                                    <div class="col-auto">
                                        <span class="badge badge-lg badge-success">Active</span>
                                    </div>
                                </div>
                                <div class="my-4">
                                    <p class="text-white opacity-8 mb-0 text-sm">Address</p>
                                    <div class="h6 text-white cursor-pointer" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom">0yx8Wkasd8uWpa083Jj81qZhs923K21</div>
                                </div>
                                <div class="row mt-5">
                                    <div class="col">
                                        <p class="text-white opacity-8 mb-0 text-sm">Name</p>
                                        <span class="d-block h6 text-white">John Snow</span>
                                    </div>
                                    <div class="col ms-auto text-end">
                                        <div class="btn-groups mt-3">
                                            <div class="btn rounded-circle btn-sm btn-white mb-0 p-1"
                                                data-bs-toggle="tooltip" data-bs-placement="top">
                                                <i class="ni ni-bold-down p-2"></i>
                                            </div>
                                            <div class="btn rounded-circle btn-sm btn-white mb-0 p-1"
                                                data-bs-toggle="tooltip" data-bs-placement="top">
                                                <i class="ni ni-bold-up p-2"></i>
                                            </div>
                                            <div class="btn rounded-circle btn-sm btn-white mb-0 p-1"
                                                data-bs-toggle="tooltip" data-bs-placement="top">
                                                <i class="ni ni-curved-next p-2"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="card ">
                        <div class="card-header pb-0 p-3">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-2">Sales by Country</h6>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center ">
                                <tbody>
                                    <tr>
                                        <td class="w-30">
                                            <div class="d-flex px-2 py-1 align-items-center">
                                                <div>
                                                    <img src="../../assets/img/icons/flags/US.png" alt="Country flag">
                                                </div>
                                                <div class="ms-4">
                                                    <p class="text-xs font-weight-bold mb-0">Country:</p>
                                                    <h6 class="text-sm mb-0">United States</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">Sales:</p>
                                                <h6 class="text-sm mb-0">2500</h6>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">Value:</p>
                                                <h6 class="text-sm mb-0">$230,900</h6>
                                            </div>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <div class="col text-center">
                                                <p class="text-xs font-weight-bold mb-0">Bounce:</p>
                                                <h6 class="text-sm mb-0">29.9%</h6>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="w-30">
                                            <div class="d-flex px-2 py-1 align-items-center">
                                                <div>
                                                    <img src="../../assets/img/icons/flags/DE.png" alt="Country flag">
                                                </div>
                                                <div class="ms-4">
                                                    <p class="text-xs font-weight-bold mb-0">Country:</p>
                                                    <h6 class="text-sm mb-0">Germany</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">Sales:</p>
                                                <h6 class="text-sm mb-0">3.900</h6>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">Value:</p>
                                                <h6 class="text-sm mb-0">$440,000</h6>
                                            </div>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <div class="col text-center">
                                                <p class="text-xs font-weight-bold mb-0">Bounce:</p>
                                                <h6 class="text-sm mb-0">40.22%</h6>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="w-30">
                                            <div class="d-flex px-2 py-1 align-items-center">
                                                <div>
                                                    <img src="../../assets/img/icons/flags/GB.png" alt="Country flag">
                                                </div>
                                                <div class="ms-4">
                                                    <p class="text-xs font-weight-bold mb-0">Country:</p>
                                                    <h6 class="text-sm mb-0">Great Britain</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">Sales:</p>
                                                <h6 class="text-sm mb-0">1.400</h6>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">Value:</p>
                                                <h6 class="text-sm mb-0">$190,700</h6>
                                            </div>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <div class="col text-center">
                                                <p class="text-xs font-weight-bold mb-0">Bounce:</p>
                                                <h6 class="text-sm mb-0">23.44%</h6>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="w-30">
                                            <div class="d-flex px-2 py-1 align-items-center">
                                                <div>
                                                    <img src="../../assets/img/icons/flags/BR.png" alt="Country flag">
                                                </div>
                                                <div class="ms-4">
                                                    <p class="text-xs font-weight-bold mb-0">Country:</p>
                                                    <h6 class="text-sm mb-0">Brasil</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">Sales:</p>
                                                <h6 class="text-sm mb-0">562</h6>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">Value:</p>
                                                <h6 class="text-sm mb-0">$143,960</h6>
                                            </div>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <div class="col text-center">
                                                <p class="text-xs font-weight-bold mb-0">Bounce:</p>
                                                <h6 class="text-sm mb-0">32.14%</h6>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12 col-md-8 mb-4 mb-md-0">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Author</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Function</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Technology</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Employed</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/team-2.jpg"
                                                    class="avatar avatar-sm me-3">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-xs">John Michael</h6>
                                                <p class="text-xs text-secondary mb-0">john@creative-tim.com</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">Manager</p>
                                        <p class="text-xs text-secondary mb-0">Organization</p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm badge-success">Online</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">23/04/18</span>
                                    </td>
                                    <td class="align-middle">
                                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs"
                                            data-toggle="tooltip" data-original-title="Edit user">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/team-3.jpg"
                                                    class="avatar avatar-sm me-3">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-xs">Alexa Liras</h6>
                                                <p class="text-xs text-secondary mb-0">alexa@creative-tim.com</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">Programator</p>
                                        <p class="text-xs text-secondary mb-0">Developer</p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm badge-secondary">Offline</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">11/01/19</span>
                                    </td>
                                    <td class="align-middle">
                                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs"
                                            data-toggle="tooltip" data-original-title="Edit user">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/team-4.jpg"
                                                    class="avatar avatar-sm me-3">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-xs">Laurent Perrier</h6>
                                                <p class="text-xs text-secondary mb-0">laurent@creative-tim.com</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">Executive</p>
                                        <p class="text-xs text-secondary mb-0">Projects</p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm badge-success">Online</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">19/09/17</span>
                                    </td>
                                    <td class="align-middle">
                                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs"
                                            data-toggle="tooltip" data-original-title="Edit user">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/team-3.jpg"
                                                    class="avatar avatar-sm me-3">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-xs">Michael Levi</h6>
                                                <p class="text-xs text-secondary mb-0">michael@creative-tim.com</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">Programator</p>
                                        <p class="text-xs text-secondary mb-0">Developer</p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm badge-success">Online</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">24/12/08</span>
                                    </td>
                                    <td class="align-middle">
                                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs"
                                            data-toggle="tooltip" data-original-title="Edit user">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/team-2.jpg"
                                                    class="avatar avatar-sm me-3">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-xs">Richard Gran</h6>
                                                <p class="text-xs text-secondary mb-0">richard@creative-tim.com</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">Manager</p>
                                        <p class="text-xs text-secondary mb-0">Executive</p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm badge-secondary">Offline</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">04/10/21</span>
                                    </td>
                                    <td class="align-middle">
                                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs"
                                            data-toggle="tooltip" data-original-title="Edit user">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header pb-0 p-3">
                        <h6 class="mb-0">Categories</h6>
                    </div>
                    <div class="card-body p-3">
                        <ul class="list-group">
                            <li
                                class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                <div class="d-flex align-items-center">
                                    <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                        <i class="ni ni-mobile-button text-white opacity-10"></i>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark text-sm">Devices</h6>
                                        <span class="text-xs">250 in stock, <span class="font-weight-bold">346+
                                                sold</span></span>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <button
                                        class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i
                                            class="ni ni-bold-right" aria-hidden="true"></i></button>
                                </div>
                            </li>
                            <li
                                class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                <div class="d-flex align-items-center">
                                    <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                        <i class="ni ni-tag text-white opacity-10"></i>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark text-sm">Tickets</h6>
                                        <span class="text-xs">123 closed, <span class="font-weight-bold">15
                                                open</span></span>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <button
                                        class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i
                                            class="ni ni-bold-right" aria-hidden="true"></i></button>
                                </div>
                            </li>
                            <li
                                class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                <div class="d-flex align-items-center">
                                    <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                        <i class="ni ni-box-2 text-white opacity-10"></i>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark text-sm">Error logs</h6>
                                        <span class="text-xs">1 is active, <span class="font-weight-bold">40
                                                closed</span></span>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <button
                                        class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i
                                            class="ni ni-bold-right" aria-hidden="true"></i></button>
                                </div>
                            </li>
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 border-radius-lg">
                                <div class="d-flex align-items-center">
                                    <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                        <i class="ni ni-satisfied text-white opacity-10"></i>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark text-sm">Happy users</h6>
                                        <span class="text-xs font-weight-bold">+ 430</span>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <button
                                        class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i
                                            class="ni ni-bold-right" aria-hidden="true"></i></button>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div  style="height: 60rem" >
            <iframe src='https://my.spline.design/kidsplaygroundphysicscopy-5ab12c2c36aae4dba5a8c18eaee54114/' frameborder='0' width='100%' height='100%'></iframe>
        </div>
        <footer class="footer pt-3  ">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-6 mb-lg-0 mb-4">
                        <div class="copyright text-center text-sm text-muted text-lg-start">
                            © <script>
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
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>


<script src="./assets/js/core/bootstrap.min.js"></script>



<script src="{{ asset('js/plugins/chartjs.min.js') }}"></script>
<script type='text/javascript'>
//    var compras =  {{ Js::from($compras) }};



var ctx1 = document.getElementById("myChart").getContext("2d");

var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');

var ventas = <?php echo json_encode($ventas);?>;
var compras = <?php echo json_encode($compras);?>;

new Chart(ctx1, {
  type: "line",
  data: {
    labels: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sept","Oct","Nov","Dic"],
    datasets: [{
      label: "Ventas",
      tension: 0.4,
      borderWidth: 0,
      pointRadius: 0,
      borderColor: "#02b1ce",
      backgroundColor: gradientStroke1,
      borderWidth: 3,
      fill: true,
      data:ventas,
      maxBarThickness:6

    },

    {
      label: "Compras",
      tension: 0.4,
      borderWidth: 0,
      pointRadius: 0,
      borderColor: "#05bsd",
      backgroundColor: gradientStroke1,
      borderWidth: 3,
      fill: true,
      data:compras,
      maxBarThickness:6

    }

],
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
      legend: {
        display: false,
      }
    },
    interaction: {
      intersect: false,
      mode: 'index',
    },
    scales: {
      y: {
        grid: {
          drawBorder: false,
          display: true,
          drawOnChartArea: true,
          drawTicks: false,
          borderDash: [5, 5]
        },
        ticks: {
          display: true,
          padding: 10,
          color: '#fbfbfb',
          font: {
            size: 11,
            family: "Open Sans",
            style: 'normal',
            lineHeight: 2
          },
        }
      },
      x: {
        grid: {
          drawBorder: false,
          display: false,
          drawOnChartArea: false,
          drawTicks: false,
          borderDash: [5, 5]
        },
        ticks: {
          display: true,
          color: '#ccc',
          padding: 20,
          font: {
            size: 11,
            family: "Open Sans",
            style: 'normal',
            lineHeight: 2
          },
        }
      },
    },
  },
});

  

  
</script>
