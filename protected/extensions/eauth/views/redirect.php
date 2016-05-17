<!DOCTYPE html>
<html>
<head>
	<script type="text/javascript">
		<?php
			$code = 'if (window.opener) {';
			$code .= 'window.close();';
			if ($redirect) {
				$code .= 'window.opener.location = \''.addslashes($url).'\';';
			}
			$code .= '}';
			$code .= 'else {';
			if ($redirect) {
				$code .= 'window.location = \''.addslashes($url).'\';';
			}
			$code .= '}';
			echo $code;
		?>
	</script>
</head>
<body>
<h2 id="title" style="display:none;">Voltando para o Bolão do Gordo...</h2>

<h3 id="link"><a href="<?php echo $url; ?>">Clique aqui para retornar ao Bolão do Gordo.</a></h3>
<script type="text/javascript">
	document.getElementById('title').style.display = '';
	document.getElementById('link').style.display = 'none';
</script>
</body>
</html>
