	<!-- Fonts and icons -->
	<script src="{{ asset('assets/js/plugin/webfont/webfont.min.js') }}"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['../assets/css/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/atlantis.min.css') }}">



	<style>


		/* ESTILOS PARA LAS TABLAS */
	
	
	
	
		/* Tabla Pequeña */
		.table-1 {
		width: 100%;/* Anchura de ejemplo */
		height: 250px;  /*Altura de ejemplo*/
		overflow: auto;
		}
	
		.table-1 table {
			border-collapse: separate;
			border-spacing: 0;
			border-left: 0.3px solid #02b1ce;
			border-bottom: 0.3px solid #02b1ce;
			width: 100%;
		}
		.table-1 table thead {
			position: sticky;
			top: 0;
			z-index: 10;
		}
		.table-1 table thead tr {
		background: #02b1ce;
		color: white;
		}
		.table-1 table tbody tr:hover {
			background-color: #bbf7ffa4;
		}
		.table-1 table td {
			border-top: 0.3px solid #02b1ce;
			padding-left: 8px;
			padding-right: 8px;
			border-right: 0.3px solid #02b1ce;
		}
		/*Tabla Extra Grande*/
		.table-5 {
		width: 100%;/* Anchura de ejemplo */
		height: 1000px;  /*Altura de ejemplo*/
		overflow: auto;
		}
	
		.table-5 table {
			border-collapse: separate;
			border-spacing: 0;
			border-left: 0.3px solid #02b1ce;
			border-bottom: 0.3px solid #02b1ce;
			width: 100%;
		}
		.table-5 table thead {
			position: sticky;
			top: 0;
			z-index: 10;
		}
		.table-5 table thead tr {
		background: #02b1ce;
		color: white;
		}
		.table-5 table tbody tr:hover {
			background-color: #bbf7ffa4;
		}
		.table-5 table td {
			border-top: 0.3px solid #02b1ce;
			padding-left: 8px;
			padding-right: 8px;
			border-right: 0.3px solid #02b1ce;
		}
	
	
	
	
		/*Tabla Sin Hover ni colores*/
	
	
		.cabeza{
			background: #02b1ce;
			color: white;
		}
		.fila{
			background-color: #d7f9ff;
		}
		.fila:hover {
			background-color: rgba(255, 240, 152, 0.336);
		}
	
		.table-null {
		width: 100%;/* Anchura de ejemplo */
		/*height: 400px;  Altura de ejemplo*/
		overflow: auto;
		}
	
		.table-null table {
			border-collapse: separate;
			border-spacing: 0;
			border-left: 0.3px solid #02b1ce;
			border-bottom: 0.3px solid #02b1ce;
			width: 100%;
		}
		.table-null table thead {
			position: sticky;
			top: 0;
			z-index: 10;
		}
		.table-null table td {
			border-top: 0.3px solid #02b1ce;
			padding-left: 8px;
			padding-right: 8px;
			border-right: 0.3px solid #02b1ce;
		}
		.table-null table th {
			/* border-top: 0.3px solid #02b1ce;
			padding-left: 8px;
			padding-right: 8px; */
			border-right: 0.3px solid #02b1ce;
		}
	
	
	
	
	
	
	</style>





	@livewireStyles