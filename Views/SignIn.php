<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8">
<title>FATIMA ALKHALLOUFI</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/x-icon" href="favicon.ico">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel='stylesheet' type='text/css' href='styles/css/main.css' >
</head>
<body>
<div class="main">

<div class="accueil">
<div>
<img class="logo" src="assets/image_blog.jpg" alt="logo">
</div>
<div class="mot-accueil">
Bonjour je m'appelle <span>Fatima ALKHALLOUFI</span>, je suis <span>développeuse Fullstack junior</span>. <br>
Bienvenue dans mon blog, où je partage les projets que j'ai réalisé.
</div>
</div>

<form action="/auth" method="post">
<div class="screen-1">

<div class="field">
<label for="email">Adresse e-mail</label>
<div class="username">
<input class="form-control" type="email" name="email" id="email" placeholder="user@e-mail.com"/>
</div>
</div>
<div class="field">
<label for="password">Mot de passe</label>
<div class="sec-2">

<input class="form-control" type="password" name="password" id="password" placeholder="*******"/>
</div>
</div>
<button  class="login">Se connecter</button>


<a class="signup" href="/register">Pas encore inscrit, je crée un compte</a>
</div>
</form>
</div>
<footer>
<div class="col1">
<div class="fcol">
<h1>Voir mes projets</h1>
<nav>
<ul>
<li><a href="#">Chalets & Caviar</a></li>
<li><a href="#">Festival des films de plein air</a></li>
<li><a href="#">Express-food solution technique</a></li>
</ul>
</nav>
</div>
<div class="fcol">
<h1>Mes coordonées</h1>
<nav>
<ul>
<li>07 61 52 00 20</li>
<li>17 rue des sources</li>
<li>77220 Tournan en Brie</li>
<li>elachri.fz@gmail.com</li>
</ul>
</nav>
</div>
</div>
<div class="fcol">
<div class="container">
<h1>Me contacter</h1>
<form action="/action_page.php">
<label for="fname">Nom & prénom</label>
<input type="text" id="fname" name="firstname" placeholder="Votre nom et prénom">

<label for="sujet">Sujet</label>
<input type="text" id="sujet" name="sujet" placeholder="L'objet de votre message">

<label for="emailAddress">Email</label>
<input id="emailAddress" type="email" name="email" placeholder="Votre email">


<label for="subject">Message</label>
<textarea id="subject" name="subject" placeholder="Votre message" style="height:200px"></textarea>

<input type="submit" value="Envoyer">
</form>
</div>

</div>
</footer>
</body>
</html>