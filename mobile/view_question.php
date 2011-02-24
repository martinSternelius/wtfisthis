<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<!-- <meta charset=utf-8 /> -->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>WTF is this</title>
	<link rel="stylesheet" href="../style/mobile.css" type="text/css" />
	<meta name="viewport" content="user-scalable=no, width=device_width" />
	
	<script type="text/javascript" src="../js/jquery-1.5.min.js"></script>
	<script type="text/javascript" src="../js/jquery.validate.js"></script>
	<script type="text/javascript" src="../js/jquery.NobleCount.js"></script>
	<script type="text/javascript" src="../js/jquery.form.js"></script>
	<script type="text/javascript" src="../js/wtf.js"></script>
	<script type="text/javascript" src="../js/view_question.js"></script>
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
					<li><a href="create_question.php">Skapa en fråga</a></li> 
				</ul> 	
			</nav>
		</header>
	
		<div id="content">
			<div id="question">	
				<h1 id="question_title">Frågerubrik</h1>
				<div id="image_section">
					<!-- placeholder image -->
					<img id="question_image" src="images/default.jpg" alt="Användarens bild kan inte visas utan javascript" />
					<p id="question_description"></p>
					<p id="question_author_and_date"></p>
				</div>
			</div>
			<div id="answers">
				<h2 id="answers_header">Svar</h2>
				<p>Det finns inga svar ännu till den här frågan. <a href="#reply_to_question" id="highlight_reply_form">Vill du ge ett svar</a>?</p>				
			</div>

			<div id="reply_to_question">
				<h2>Svara</h2>
				<form action="../api/?resource=answers" method="post">
					<label for="reply_text">Text <span><span id="reply_text_count"></span> tecken kvar</span></label>
					<textarea id="reply_text" name="reply_text" rows="8" cols="40" required="required" placeholder="Svara på frågan"></textarea>
					
					<label for="reply_author">Namn</label>
					<input type="text" name="reply_author" id="reply_author" placeholder="Namnet är frivilligt" />
					
					<button type="submit">Svara</button>
				</form>
				
			</div>

		</div>
		
		<div id="about">
			<h3>Om WTF is this</h3>
			<p>WTF is this är en nytt sätt att söka och hitta information. Du kan publicera bilder på underliga saker och ställa öppna frågor till alla besökare om vad det är för nåt, få svar från riktiga människor och hjälpa till genom att dela med dig av dina insikter.</p>			
		</div>
	
		<footer>
			<p>copyright &copy; <a href="mailto:wtf@isthis.net">WTF is this</a> 2011</p>
		</footer>
   </div>
   <div class="templates">
      <ol><li class="answer"><p class="answer_text"></p><p class="answer_name"></p></li></ol>
    </div>
</body>
</html>