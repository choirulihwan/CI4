<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Management Quiz App</title>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>" />

	<!-- Jquery dan Bootsrap JS -->
	<script src="<?= base_url('js/jquery.min.js') ?>"></script>
	<script src="<?= base_url('js/bootstrap.min.js') ?>"></script>	
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/font-awesome-4.4.0/css/font-awesome.min.css')?>" />
</head>
<body>
<header class="jumbotron jumbotron-fluid">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1 class="h1 text-center">					
                        Manajemen Computer Based Test (CBT)
					</h1>					
				</div>
			</div>
		</div>
    </header>

<div class="container mt-3 text-center">
    <div class="row">       
        <div class="col-sm-4 offset-sm-4">
            <form class="form-signin" method="post" action="">
                <img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
                <!-- <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1> -->

                <label for="inputEmail" class="sr-only">Email address</label>
                <input type="email" name="username" id="inputEmail" class="form-control" placeholder="Email address" required="" autofocus="">

                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" name="password" id="inputPassword" class="form-control mt-2" placeholder="Password" required="">
                <div class="checkbox mb-3 mt-3">
                    <!-- <label>
                        <input type="checkbox" value="remember-me"> Remember me
                    </label> -->
                </div>
                <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Sign in</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>

