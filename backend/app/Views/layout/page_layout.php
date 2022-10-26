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
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/DataTables/datatables.min.css')?>" />
	<script type="text/javascript" src="<?= base_url('assets/DataTables/datatables.min.js') ?>"></script>
	<script src="<?=base_url('assets/ckeditor/ckeditor.js')?>"></script>
</head>

<body>

	<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
		<div class="container">
			<a class="navbar-brand" href="<?= base_url() ?>">Beranda</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" href="<?=base_url('manquiz') ?>">Pertanyaan</a>						
					</li>
					<li class="nav-item">	
						<a class="nav-link" href="<?=base_url('mancategory') ?>">Pelajaran</a>	
					</li>
					<li class="nav-item">	
						<a class="nav-link" href="<?=base_url('users/logout') ?>">Sign out</a>	
					</li>			
				</ul>				
			</div>
			<span class="navbar-text my-2 my-lg-0" style="color:#000"><strong>Manajemen CBT (Computer Based Test)</strong></span>
		</div>
	</nav>

	<?php
		$uri = service('uri');
	?>

	<!-- <header class="jumbotron jumbotron-fluid">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1 class="h1">					
					
					</h1>
					
				</div>
			</div>
		</div>
    </header> -->
    
    <?= $this->renderSection('content') ?>

	<footer class="jumbotron jumbotron-fluid mt-5 mb-0">
		<div class="container text-center">Copyright &copy <?= Date('Y') ?> CI News</div>
	</footer>

	

</body>

</html>