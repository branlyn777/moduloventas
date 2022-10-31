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
			border-left: 0.1px solid #02b1ce;
			border-bottom: 0.1px solid #02b1ce;
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
			border-top: 0.1px solid #02b1ce;
			padding-left: 8px;
			padding-right: 8px;
			border-right: 0.1px solid #02b1ce;
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
			background-color: #9df4ffa4;
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


















		/* ESTILOS BOTONES */
		.boton-azul {
			text-decoration: none !important; 
			background-color: #4894ef;
			cursor: pointer;
			color: white;
			border-color: #4894ef;
			border-radius: 7px;
			padding-top: 2px;
			padding-bottom: 2px;
			padding-left: 5px;
			padding-right: 5px;
			box-shadow: none;
			border-width: 2px;
			border-style: solid;
			display: inline-block;
		}
		.boton-azul:hover {
			background-color: rgb(255, 255, 255);
			color: #4894ef;
			transition: all 0.4s ease-out;
			border-color: #4894ef;
			text-decoration: underline;
			-webkit-transform: scale(1.05);
			-moz-transform: scale(1.05);
			-ms-transform: scale(1.05);
			transform: scale(1.05);
		}
		.boton-azul-g {
			text-decoration: none !important; 
			background-color: #4894ef;
			cursor: pointer;
			color: white;
			border-color: #4894ef;
			border-radius: 7px;
			padding-top: 7px;
			padding-bottom: 7px;
			padding-left: 12px;
			padding-right: 12px;
			box-shadow: none;
			border-width: 2px;
			border-style: solid;
			display: inline-block;
		}
		.boton-azul-g:hover {
			background-color: rgb(255, 255, 255);
			color: #4894ef;
			transition: all 0.4s ease-out;
			border-color: #4894ef;
			text-decoration: underline;
			-webkit-transform: scale(1.05);
			-moz-transform: scale(1.05);
			-ms-transform: scale(1.05);
			transform: scale(1.05);
		}


		.boton-rojo {
			text-decoration: none !important; 
			background-color: #f3112b;
			cursor: pointer;
			color: white;
			border-color: #f3112b;
			border-radius: 7px;
			padding-top: 2px;
			padding-bottom: 2px;
			padding-left: 5px;
			padding-right: 5px;
			box-shadow: none;
			border-width: 2px;
			border-style: solid;
			display: inline-block;
		}
		.boton-rojo:hover {
			background-color: rgb(255, 255, 255);
			color: #f3112b;
			transition: all 0.4s ease-out;
			border-color: #f3112b;
			text-decoration: underline;
			-webkit-transform: scale(1.05);
			-moz-transform: scale(1.05);
			-ms-transform: scale(1.05);
			transform: scale(1.05);
		}


		.boton-rojo-g {
			text-decoration: none !important; 
			background-color: #f3112b;
			cursor: pointer;
			color: white;
			border-color: #f3112b;
			border-radius: 7px;
			padding-top: 7px;
			padding-bottom: 7px;
			padding-left: 12px;
			padding-right: 12px;
			box-shadow: none;
			border-width: 2px;
			border-style: solid;
			display: inline-block;
		}
		.boton-rojo-g:hover {
			background-color: rgb(255, 255, 255);
			color: #f3112b;
			transition: all 0.4s ease-out;
			border-color: #f3112b;
			text-decoration: underline;
			-webkit-transform: scale(1.05);
			-moz-transform: scale(1.05);
			-ms-transform: scale(1.05);
			transform: scale(1.05);
		}


		.boton-verde {
			text-decoration: none !important; 
			background-color: #11be32;
			cursor: pointer;
			color: white;
			border-color: #11be32;
			border-radius: 7px;
			padding-top: 2px;
			padding-bottom: 2px;
			padding-left: 5px;
			padding-right: 5px;
			box-shadow: none;
			border-width: 2px;
			border-style: solid;
			display: inline-block;
		}
		.boton-verde:hover {
			background-color: rgb(255, 255, 255);
			color: #11be32;
			transition: all 0.4s ease-out;
			border-color: #11be32;
			text-decoration: underline;
			-webkit-transform: scale(1.05);
			-moz-transform: scale(1.05);
			-ms-transform: scale(1.05);
			transform: scale(1.05);
		}

		.boton-verde-g {
			text-decoration: none !important; 
			background-color: #11be32;
			cursor: pointer;
			color: white;
			border-color: #11be32;
			border-radius: 7px;
			padding-top: 7px;
			padding-bottom: 7px;
			padding-left: 12px;
			padding-right: 12px;
			box-shadow: none;
			border-width: 2px;
			border-style: solid;
			display: inline-block;
		}
		.boton-verde-g:hover {
			background-color: rgb(255, 255, 255);
			color: #11be32;
			transition: all 0.4s ease-out;
			border-color: #11be32;
			text-decoration: underline;
			-webkit-transform: scale(1.05);
			-moz-transform: scale(1.05);
			-ms-transform: scale(1.05);
			transform: scale(1.05);
		}




		.boton-plomo {
			text-decoration: none !important; 
			background-color: #6b6b6b;
			cursor: pointer;
			color: white;
			border-color: #6b6b6b;
			border-radius: 7px;
			padding-top: 2px;
			padding-bottom: 2px;
			padding-left: 5px;
			padding-right: 5px;
			box-shadow: none;
			border-width: 2px;
			border-style: solid;
			display: inline-block;
		}
		.boton-plomo:hover {
			background-color: rgb(255, 255, 255);
			color: #6b6b6b;
			transition: all 0.4s ease-out;
			border-color: #6b6b6b;
			text-decoration: underline;
			-webkit-transform: scale(1.05);
			-moz-transform: scale(1.05);
			-ms-transform: scale(1.05);
			transform: scale(1.05);
		}

		.boton-plomo-g {
			text-decoration: none !important; 
			background-color: #6b6b6b;
			cursor: pointer;
			color: white;
			border-color: #6b6b6b;
			border-radius: 7px;
			padding-top: 7px;
			padding-bottom: 7px;
			padding-left: 12px;
			padding-right: 12px;
			box-shadow: none;
			border-width: 2px;
			border-style: solid;
			display: inline-block;
		}
		.boton-plomo-g:hover {
			background-color: rgb(255, 255, 255);
			color: #6b6b6b;
			transition: all 0.4s ease-out;
			border-color: #6b6b6b;
			text-decoration: underline;
			-webkit-transform: scale(1.05);
			-moz-transform: scale(1.05);
			-ms-transform: scale(1.05);
			transform: scale(1.05);
		}






		.boton-celeste {
			text-decoration: none !important; 
			background-color: #02b1ce;
			cursor: pointer;
			color: white;
			border-color: #02b1ce;
			border-radius: 7px;
			padding-top: 2px;
			padding-bottom: 2px;
			padding-left: 5px;
			padding-right: 5px;
			box-shadow: none;
			border-width: 2px;
			border-style: solid;
			display: inline-block;
		}
		.boton-celeste:hover {
			background-color: rgb(255, 255, 255);
			color: #02b1ce;
			transition: all 0.4s ease-out;
			border-color: #02b1ce;
			text-decoration: underline;
			-webkit-transform: scale(1.05);
			-moz-transform: scale(1.05);
			-ms-transform: scale(1.05);
			transform: scale(1.05);
		}

		.boton-celeste-g {
			text-decoration: none !important; 
			background-color: #02b1ce;
			cursor: pointer;
			color: white;
			border-color: #02b1ce;
			border-radius: 7px;
			padding-top: 7px;
			padding-bottom: 7px;
			padding-left: 12px;
			padding-right: 12px;
			box-shadow: none;
			border-width: 2px;
			border-style: solid;
			display: inline-block;
		}
		.boton-celeste-g:hover {
			background-color: rgb(255, 255, 255);
			color: #02b1ce;
			transition: all 0.4s ease-out;
			border-color: #02b1ce;
			text-decoration: underline;
			-webkit-transform: scale(1.05);
			-moz-transform: scale(1.05);
			-ms-transform: scale(1.05);
			transform: scale(1.05);
		}





		.boton-blanco {
			text-decoration: none !important; 
			background-color: #ffffff;
			cursor: pointer;
			color: black;
			border-color: #000000;
			border-radius: 7px;
			padding-top: 2px;
			padding-bottom: 2px;
			padding-left: 5px;
			padding-right: 5px;
			box-shadow: none;
			border-width: 1px;
			border-style: solid;
			display: inline-block;
		}
		.boton-blanco:hover {
			background-color: rgb(0, 0, 0);
			color: #ffffff;
			transition: all 0.4s ease-out;
			border-color: #4ac6ff;
			text-decoration: underline;
			-webkit-transform: scale(1.05);
			-moz-transform: scale(1.05);
			-ms-transform: scale(1.05);
			transform: scale(1.05);
		}

		.boton-blanco-g {
			text-decoration: none !important; 
			background-color: #ffffff;
			cursor: pointer;
			color: black;
			border-color: #000000;
			border-radius: 7px;
			padding-top: 7px;
			padding-bottom: 7px;
			padding-left: 12px;
			padding-right: 12px;
			box-shadow: none;
			border-width: 1px;
			border-style: solid;
			display: inline-block;
		}
		.boton-blanco-g:hover {
			background-color: rgb(0, 0, 0);
			color: #ffffff;
			transition: all 0.4s ease-out;
			border-color: #4ac6ff;
			text-decoration: underline;
			-webkit-transform: scale(1.05);
			-moz-transform: scale(1.05);
			-ms-transform: scale(1.05);
			transform: scale(1.05);
		}



	</style>
	@livewireStyles