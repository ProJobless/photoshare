<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?= $title ?> | Photoshare</title>
</head>
<body>

<div class="container">

<?php $this->load->view('includes/header') ?>

<?php $this->load->view($main) ?>

<?php $this->load->view('includes/footer') ?>

</div>

</body>
</html>