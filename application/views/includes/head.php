<html>
<head>
	<meta HTTP-EQUIV="Refreh" CONTENT="1">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/styles.css">
	<script src="<?php echo base_url() ?>assets/js/jquery-1.7.1.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/jquery.masonry.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/validar.js"></script>

	<title><?php echo $title ?></title>

	<script>
		  $(function(){
		    
			    $('section').masonry({
			      itemSelector: 'article',
			      columnWidth: 0,
			      isAnimated: true,
			      isFitWidth: true
			    });
		    
		  });
	</script>

</head>
<body>