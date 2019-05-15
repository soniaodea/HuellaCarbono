<script src="{{ url("assets/lib/jQuery/jquery-3.2.1.min.js") }}" ></script>

<link rel="stylesheet" href="{{ url("/assets/lib/bootstrap/css/bootstrap.css") }}">
<script src="{{ url("assets/lib/bootstrap/js/bootstrap.bundle.min.js") }}" defer></script>
<link rel="stylesheet" href="{{ url("assets/lib/font-awesome/css/font-awesome.min.css") }}">

<link href="{{ url("assets/lib/videojs-6.2.8/video-js.css") }}" rel="stylesheet">
<script src="{{ url("assets/lib/videojs-6.2.8/video.js") }}" defer></script>

<script src="{{ url("assets/lib/sweetalert/sweetalert.min.js") }}" defer></script>

@include("elements.cookies")

<script src="{{ url("assets/lib/chartjs/Chart.min.js")}}" defer></script>

<script src="https://api.mapbox.com/mapbox-gl-js/v0.42.0/mapbox-gl.js" defer></script>
<link href="https://api.mapbox.com/mapbox-gl-js/v0.42.0/mapbox-gl.css" rel='stylesheet' />
<script type="text/javascript" defer>
    document.addEventListener("DOMContentLoaded", function () {
        mapboxgl.accessToken = '{{ env("MAPBOX_TOKEN") }}';
    });
</script>

<script src="{{ url("assets/js/ads.js") }}"></script>
<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function () {
    if (typeof hasAdblock === "undefined") {
        document.body.innerHTML = null;
        document.body.className = "bg-danger";
        swal({
            title: "Adblock detectado",
            text: @lang("Hemos detectado que estás navegando con un bloqueador de publicidad, desactivalo para poder seguir navegando en la web."),
            icon: "{{ asset("assets/img/noAdb.png") }}",
            dangerMode: true,
            buttons: {
                "confirm": @lang("Desactivado"),
            }
        }).then(function () {
            location.reload();
        });
        document.querySelector(".swal-modal img").style.width = "25%";
    }
});
</script>

<link rel="stylesheet" href="{{ url("/assets/css/main.css") }}">
<script src="{{ url("assets/js/smoothScroll.js") }}" defer></script>
<script src="{{ url("assets/.hidden/.easterEgg.js") }}" defer></script>
<script src="{{ url("assets/js/collapseNavbar.js") }}" defer></script>
<script src="{{ url("assets/js/navbarChangeColor.js") }}" defer></script>
<script src="{{ url("assets/js/titleAnimation.js") }}" defer></script>
<script src="{{ url("assets/js/ajaxFormValidation.js") }}" defer></script>
