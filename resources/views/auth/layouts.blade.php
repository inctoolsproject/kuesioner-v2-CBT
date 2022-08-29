<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/png" href="{{ asset('assets/images/icons/itenas-w.png') }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/auth.css') }}" />
    <title>Kuesioner | Institut Teknologi Nasional</title>
</head>

<body>
    <div class="container">
        <div class="forms-container">
            @if (session('success'))
                <div class="success-session" data-flashdata="{{ session('success') }}"></div>
            @elseif (session('error'))
                <div class="error-session" data-flashdata="{{ session('error') }}"></div>
            @endif
            <div class="signin-signup">
                @yield('content')
            </div>
        </div>

        <div class=" panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <img src="{{ asset('assets/images/itenas_edit.png') }}" style="margin-bottom:-40px" class="image"
                        alt="" />
                </div>
                <img src="{{ asset('assets/images/mahasiswa.svg') }}" class="image" alt="" />
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        let flashdatasukses = $('.success-session').data('flashdata');
        let flashdataerror = $('.error-session').data('flashdata');
        if (flashdatasukses) {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: flashdatasukses,
                type: 'success'
            })
        }
        if (flashdataerror) {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: flashdataerror,
                type: 'error'
            })
        }
    </script>
</body>

</html>
