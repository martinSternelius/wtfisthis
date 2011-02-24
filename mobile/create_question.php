<!DOCTYPE html>
<html xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>WTF is this</title>
	<link rel="stylesheet" href="../style/mobile.css" type="text/css" />
	<meta name="viewport" content="user-scalable=no, width=device_width" />
	
	<script type="text/javascript" src="../js/jquery-1.5.min.js"></script>
	<script type="text/javascript" src="../js/jquery.validate.js"></script>
	<script type="text/javascript" src="../js/jquery.NobleCount.js"></script>
	<script type="text/javascript" src="../js/jquery.form.js"></script>
	<script type="text/javascript" src="../js/create_question.js"></script>
	<?php 
		echo $noscript;
	?>
</head>
<body>
	<div id="wrapper">
		<header>
			<h1>WTF is this</h1>
			<noscript>
				<h2>OBS</h2>
				<p>Wtf Is This kräver javascript för att fungera fullt ut!</p>
				<p>Iphone: välj settings - safari - enable javascript</p>
				<p>Android: välj webb - menu - more - settings - enable javascript</p>
			</noscript>
			<nav>
				<ul id="tabnav"> 
					<li><a href="latest_questions.php">Senaste</a></li> 
					<li><a href="#">Populäraste</a></li> 
					<li><a href="#">I din närhet</a></li> 
					<li class="active"><a href="create_question.php">Skapa en fråga</a></li> 
				</ul> 	
			</nav>
		</header>
	
		<div id="content">				
			<form id="createQuestion" action="../api/index.php?resource=questions" method="post" enctype="multipart/form-data">	
				<h2>Skapa en fråga</h2>						
				<fieldset>
					<legend>Skapa en fråga</legend>
					<ul>
						<li>
							<label for="headerInput">Rubrik - <span><span id="headerInputCount"></span> tecken kvar</span></label>
							<input type="text" name="headerInput" id="headerInput" placeholder="Din rubrik" required="required" autofocus="autofocus" />			
						</li>
						<li>
							<label for="imageUpload">Bild</label>
							<input type="file" name="imageUpload" id="imageUpload" />
						</li>
						
					</ul>	
				</fieldset>
				<fieldset class="textarea">																			
					<ul>								
						<li>
							<label for="textInput">Text - <span><span id="textInputCount"></span> tecken kvar</span></label>
							<textarea name="textInput" id="textInput" placeholder="Din fråga" required="required"></textarea>
						</li>
						<li>
							<label for="nameInput">Namn</label>
							<input type="text" name="nameInput" id="nameInput" placeholder="Ditt namn är frivilligt" />
						</li>
					</ul>
				</fieldset>					

				<div class="submit">
					<button id="createQuestionButton" type="submit">Spara</button>
				</div>		

			</form>	
		</div>
		
		<section id="about">
			<h3>Om WTF is this</h3>
			<p>WTF is this är en nytt sätt att söka och hitta information. Du kan publicera bilder på underliga saker och ställa öppna frågor till alla besökare om vad det är för nåt, få svar från riktiga människor och hjälpa till genom att dela med dig av dina insikter.</p>			
		</section>
	
		<footer class="container_12">
			<div class="grid_12">
				<p>copyright &copy; <a href="mailto:wtf@isthis.net">WTF is this</a> 2011</p>
			</div>
		</footer>
	</div>
</body>
</html>
