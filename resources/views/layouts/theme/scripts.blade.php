
  <!--   Core JS Files   -->
  

  <script src="js/core/popper.min.js"></script>
  <script src="js/plugins/perfect-scrollbar.min.js"></script>
  <script src="js/plugins/smooth-scrollbar.min.js"></script>
  <script src="js/plugins/chartjs.min.js"></script>

  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="js/argon-dashboard.min.js?v=2.0.5"></script>
  {{-- <script src="js/beacon.min.js/vaafb692b2aea4879b33c060e79fe94621666317369993"></script> --}}

  <script src="js/core/bootstrap.min.js"></script>
  <script src="js/core/jquery-3.6.1.min.js"></script>
  {{-- <script src="js/core/dragula.min.js"></script> --}}
  {{-- <script src="js/core/jkanban.js"></script> --}}
  


<!-- Scripts para el mensaje de confirmacion arriba a la derecha 'Mensaje Toast' de Éxito y Alerta de Eliminacion -->
<script src="{{ asset('plugins/sweetalerts/sweetalert2.min.js') }}"></script>
<script src="{{ asset('plugins/sweetalerts/custom-sweetalert.js') }}"></script>



{{-- <script>
  window.addEventListener("load", function(event)
  {
      this.darkMode(document.getElementById('dark-version'));
  });
</script> --}}



<!-- Fin Scripts -->



@livewireScripts