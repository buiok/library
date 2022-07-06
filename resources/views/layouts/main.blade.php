<!doctype html>
<html lang="ru">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    

    <link rel="stylesheet" href="{{url('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('css/bootstrap-utilities.css')}}">
    <link rel="stylesheet" href="{{url('css/style.css')}}">

    <title> @yield('title') </title>
</head>
<body>

@if(session('success'))
    @include('inc.messages')
@endif

<div class="main-wrapper">
    <div class="content">
        @include('inc.menu')
        @yield('content')
    </div>
    <footer class="footer py-4 mt-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col text-muted">Test</div>
            </div>
        </div>
    </footer>
</div>

@yield('hidden')

<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
        crossorigin="anonymous"></script>

<script>
    if (document.getElementById('exampleModalToggleEdit')) {
        const exampleModal = document.getElementById('exampleModalToggleEdit');
        exampleModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            const sign = button.getAttribute('data-bs-sign');
            const url = button.getAttribute('data-bs-url');

            const link_id = button.getAttribute('data-bs-id_link');
            const material_id = button.getAttribute('data-bs-id_material');

            const modalSign = exampleModal.querySelector('#floatingModalSignatureEdit');
            const modalURL = exampleModal.querySelector('#floatingModalLinkEdit');

            const m_id = exampleModal.querySelector('#material_id');
            const l_id = exampleModal.querySelector('#link_id');

            modalSign.value = sign;
            modalURL.value = url;

            m_id.value = material_id;
            l_id.value = link_id; 
        })
    }
</script>

</body>
</html>