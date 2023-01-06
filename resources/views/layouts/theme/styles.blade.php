<!--     Fonts and icons     -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
<!-- Nucleo Icons -->
<link href="css/nucleo-icons.css" rel="stylesheet" />
<!-- Font Awesome Icons -->
<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
<link href="css/nucleo-svg.css" rel="stylesheet" />
<link rel="stylesheet" href="css/bootstrap.min.css">
<!-- CSS Files -->
<link id="pagestyle" href="css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
{{-- cdn fontawesome --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
    integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />






@yield('asd', view('layouts.theme.estiloextra'))

{{-- <link id="pagestyle" href="css/argon-dashboard.min.css" rel="stylesheet"/> --}}





<script>
    (function(a, s, y, n, c, h, i, d, e) {
        s.className += ' ' + y;
        h.start = 1 * new Date;
        h.end = i = function() {
            s.className = s.className.replace(RegExp(' ?' + y), '')
        };
        (a[n] = a[n] || []).hide = h;
        setTimeout(function() {
            i();
            h.end = null
        }, c);
        h.timeout = c;
    })(window, document.documentElement, 'async-hide', 'dataLayer', 4000, {
        'GTM-K9BGS8K': true
    });
</script>


<script>
    (function(i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function() {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
            m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');
    ga('create', 'UA-46172202-22', 'auto', {
        allowLinker: true
    });
    ga('set', 'anonymizeIp', true);
    ga('require', 'GTM-K9BGS8K');
    ga('require', 'displayfeatures');
    ga('require', 'linker');
    ga('linker:autoLink', ["2checkout.com", "avangate.com"]);
</script>


{{-- <script>
		(function(w, d, s, l, i) {
		w[l] = w[l] || [];
		w[l].push({
			'gtm.start': new Date().getTime(),
			event: 'gtm.js'
		});
		var f = d.getElementsByTagName(s)[0],
			j = d.createElement(s),
			dl = l != 'dataLayer' ? '&l=' + l : '';
		j.async = true;
		j.src =
			'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
		f.parentNode.insertBefore(j, f);
		})(window, document, 'script', 'dataLayer', 'GTM-NKDMSK6');
	</script> --}}

















<style>
    .wrapper {
        text-transform: uppercase;
        background: #5e72e4;
        color: #555;
        font-family: "Gill Sans", Impact, sans-serif;
        font-size: 20px;
        position: relative;
        text-align: center;
        width: 35px;


        border-radius: 50px;



        -webkit-transform: translateZ(0);
        /* webkit flicker fix */
        -webkit-font-smoothing: antialiased;
        /* webkit text rendering fix */
    }

    .wrapper .tooltip {
        background: #ffffff;
        /* border: #5e72e4 solid 0.1px; */
        border-radius: 15px;
        bottom: 100%;
        color: rgb(0, 0, 0);
        display: block;
        left: -20px;


        margin-bottom: 15px;
        opacity: 0;
        padding: 20px;
        pointer-events: none;
        position: absolute;
        width: 200%;
    }

    /* This bridges the gap so you can mouse into the tooltip without it disappearing */
    .wrapper .tooltip:before {
        bottom: -20px;
        content: " ";
        display: block;
        height: 20px;
        left: 0;
        position: absolute;
        width: 100%;
    }

    /* CSS Triangles - see Trevor's post */
    .wrapper .tooltip:after {
        border-left: solid transparent 10px;
        border-right: solid transparent 10px;
        border-top: solid #5e72e4 10px;

        bottom: -10px;
        content: " ";
        height: 0;
        left: 40%;
        margin-left: -13px;
        position: absolute;
        width: 0;
    }

    .wrapper:hover .tooltip {
        opacity: 1;
        width: 7rem;
        left: -25px;


        /* box-shadow: 1px 1px 1px 1px #5e72e4; */



        pointer-events: auto;
        -webkit-transform: translateY(0px);
        -moz-transform: translateY(0px);
        -ms-transform: translateY(0px);
        -o-transform: translateY(0px);
        transform: translateY(0px);
    }

    /* IE can just show/hide with no transition */
    .lte8 .wrapper .tooltip {
        display: none;
    }

    .lte8 .wrapper:hover .tooltip {
        display: block;
    }










    .btn-venta {
        background-color: #fb6340;
        color: white;
        border-radius: 50%;
        display: inline-flex;
        flex-direction: column;
        justify-content: center;
        height: 3rem;
        padding: 0;
        position: relative;
        text-align: center;
        transform-origin: center;
        transition: all 0.25s;
        width: 3rem;
        margin-bottom: 7px;
    }

    .btn-venta:hover {
        border: #fb6340 solid 1px;
        background-color: #ffffff;
        color: #fb6340;
        border-radius: 50%;
        display: inline-flex;
        flex-direction: column;
        justify-content: center;
        height: 3rem;
        padding: 0;
        position: relative;
        text-align: center;
        transform-origin: center;
        transition: all 0.25s;
        width: 3rem;
        /* height: 4rem; */
    }





    .btn-movimiento {
        background-color: #2dce89;
        color: white;
        border-radius: 50%;
        display: inline-flex;
        flex-direction: column;
        justify-content: center;
        height: 3rem;
        padding: 0;
        position: relative;
        text-align: center;
        transform-origin: center;
        transition: all 0.25s;
        width: 3rem;
        margin-bottom: 7px;
    }

    .btn-movimiento:hover {
        border: #2dce89 solid 1px;
        background-color: #ffffff;
        color: #2dce89;
        border-radius: 50%;
        display: inline-flex;
        flex-direction: column;
        justify-content: center;
        height: 3rem;
        padding: 0;
        position: relative;
        text-align: center;
        transform-origin: center;
        transition: all 0.25s;
        width: 3rem;
        /* height: 4rem; */
    }


    .btn-ie {
        background-color: #11cdef;
        color: white;
        border-radius: 50%;
        display: inline-flex;
        flex-direction: column;
        justify-content: center;
        height: 3rem;
        padding: 0;
        position: relative;
        text-align: center;
        transform-origin: center;
        transition: all 0.25s;
        width: 3rem;
        margin-bottom: 7px;
    }

    .btn-ie:hover {
        border: #11cdef solid 1px;
        background-color: #ffffff;
        color: #11cdef;
        border-radius: 50%;
        display: inline-flex;
        flex-direction: column;
        justify-content: center;
        height: 3rem;
        padding: 0;
        position: relative;
        text-align: center;
        transform-origin: center;
        transition: all 0.25s;
        width: 3rem;
        /* height: 4rem; */
    }
</style>










@livewireStyles
