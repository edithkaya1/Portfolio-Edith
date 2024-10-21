<!DOCTYPE html>

<html lang="de">
	<head>
		<title>Kontaktformular</title>
		<link rel="stylesheet" href="../css/style_yasmina.css">
	</head>
	<body>
		<?php
			if($_POST['von']!="" and $_POST['mail']!="" and $_POST['betreff']!="" and $_POST['nachricht']!="") {
			$empf = "yasmina2707.peschke@gmail.com";
			$betreff = $_POST['betreff'];
			$from = "From: ";
			$from .= $_POST['von'];
			$from .= " <";
			$from .= $_POST['mail'];
			$from .= ">\n";
			$from .= "Reply-To: ";
			$from .= $_POST['betreff'];
			$from .= "\n";
			$from .= "Content-Type: text/html\n";
			$text = $_POST['nachricht'];
			
			mail($empf, $betreff, $text, $from);
			echo "<script type='text/javascript'>document.location='http://blizzwerk.de/1/gf/edith/website/html/antwort.html';</script>";
			} else {
				echo "<div class='error-message'> )-: ...Bitte alle Felder ausfuellen.... :-( </div>";
			}
		?>
	</body>
</html>