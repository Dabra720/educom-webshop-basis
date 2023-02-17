<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Contact</title>
	<link rel="stylesheet" href="CSS/stylesheet.css">
</head>
<body>

	<ul class="navbar">
		<li><a href="index.html">HOME</a></li>
		<li><a href="about.html">ABOUT</a></li>
		<li><a href="contact.html">CONTACT</a></li>
	</ul>
	
	<div class="core">
		<h1>Neem contact met ons op</h1>
		<h2>Contactgegevens</h2>

			<form action="validate.php" method="POST">
				<div class="row">
					<div class="col-25">
						<label for="aanhef">Aanhef</label>
					</div>
					<div class="col-75">
						<select name="aanhef" id="dropdown">
							<option value="dhr">Dhr.</option>
							<option value="mvr">Mvr.</option>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="name">Naam</label>
					</div>
					<div class="col-75">
						<input type="text" name="name">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="email">E-Mail</label>
					</div>
					<div class="col-75">
						<input type="text" name="email">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="phone">Telefoonnummer</label>
					</div>
					<div class="col-75">
						<input type="text" name="phone">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="communicatie">Communicatievoorkeur</label>
					</div>
					<div class="col-75">
						<input type="radio" id="email" name="communicatie" value="Email">
						<label for="email">Email</label>
						<input type="radio" id="telefoon" name="communicatie" value="Telefoon">
						<label for="telefoon">Telefoon</label>
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<label for="message">Bericht</label>
					</div>
					<div class="col-75">
						<textarea name="message"></textarea>
					</div>
				</div>
				<div class="row">
					<input type="submit">
				</div>
			</form>
	</div>
</body>
<footer>
©2023 Daan Braas
</footer>
</html>