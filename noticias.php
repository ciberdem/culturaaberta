<?php
 
 include './classes/conexao.php';
 include './classes/noticia.php'; 
 include './inc/settings.php'; 
?>
<html>
<head>
<link rel="stylesheet" href="css/styles.css">
<link rel="stylesheet" href="css/slider.css">
<meta charset="UTF-8">
<title>Cultura Aberta</title>
</head>
<body id="bg" onLoad="setTimeout(function() {byepost()}, 10000);">
<table align="center" cellspacing="0" cellpadding="0">
	<tr>
	<td valign="top" style="padding:0px"> 
		<?php include("./inc/header.php") ?>
	</td>
	</tr>	
	<tr>
    <td style="padding: 0px">
    <table id="tbbody" border="0" style="padding:0px">
		<tr>
			<td style="padding:0px">
				<?php include("bdnoticias.php") ?>
			</td>
		</tr>
	</table>  
    </td>
    </tr>
	<tr>
   		<td><?php include("./inc/footer.php") ?></td>
    </tr>
</table>
</body>
</html>

