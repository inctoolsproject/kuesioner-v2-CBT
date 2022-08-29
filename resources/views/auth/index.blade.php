<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<link rel="icon" type="image/png" href="{{ asset('assets/images/icons/itenas-w.png') }}" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="{{ asset('assets/css/auth.css') }}"/>
	<title>Kuesioner | Institut Teknologi Nasional</title>
</head>

<body>
	<div class="container">
		<div class="forms-container">
			<div class="signin-signup">
				<form method="post" action="" class="sign-in-form">
					<h1 class="title" style="color: green; font-size:medium">
						<h6 class="title" align="center" style="font-size: 30px;">Selamat Datang di<br>Sistem Kuesioner Umpan Balik terhadap Pelayanan Itenas</h6>
							<div class="card-body">
								<button type="button" class="btn btn-primary"><a
										href="#"
										style="text-decoration:none; color:white; font-size:large">Dosen</button>
								<button type="button" class="btn btn-primary"><a
										href="#"
										style="text-decoration:none; color:white; font-size:large">Mahasiswa</button>
								<button type="button" class="btn btn-primary"><a
										href="#"
										style="text-decoration:none; color:white; font-size:large">Tendik</button>
							</div>
				</form>
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

	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>

</html>
