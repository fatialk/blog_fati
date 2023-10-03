<?php
$connected = (!empty($_SESSION['status']) && $_SESSION['status'] === 'connected');
?>
<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8">
<title>FATIMA ALKHALLOUFI/BLOG</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/x-icon" href="favicon.ico">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="../styles/css/bootstrap.min.css" rel="stylesheet">
<link href="../styles/css/templatemo-xtra-blog.css" rel="stylesheet">
<link rel='stylesheet' type='text/css' href='../styles/css/main.css' >
</head>
<body>
<header class="header">
<!-- <div class="menu"> -->
<?php
if($connected)
{
    echo "<a class='sign-out-button tm-btn-primary tm-btn' href='/signOut'>Se déconnecter</a>";
}
?>
<div class="title">
<span>Bienvenue sur mon blog</span> - Fatima ALKHALLOUFI / Développeuse PHP-Symfony Junior
<div class='space'>
</div>
</div>

<input class="menu-btn" type="checkbox" id="menu-btn" />
<label class="menu-icon" for="menu-btn"><span class="navicon"></span></label>
<ul class="menu">
<li><a class="active" href="/home">Accueil</a></li>
<li><a href="/posts/list">Blog</a></li>
<li><a href="/projets">Mes projets</a></li>

</ul>
</header>
<div class="container-fluid">
<div class="about">
    
    <div class="about-illustration">
      <img src="assets/2784258.jpg" alt="illustration">
    </div>
    <div class="about-center">
      <h1>A propos de moi</h1>
      <div class="description">
        <span>Fatima ALKHALLOUFI, développeuse Fullstack junior passionnée par la programmation.</span>
        <span>En Janvier 2022, j’ai décidé de me former en développement informatique, afin d'en faire mon métier principal.</span>
        <span> Actuellement je prépare un diplôme de bac+3 en développement des applications PHP - Symfony.</span>
        <span>Dans ce blog vous trouverez des articles sur le développement web et les nouvelles technologies d'information ainsi que les projets que j'ai réalisés durant mon parcours</span>
        <div class="social-media-cv">
          <span>Pour plus d'informations, vous pouvez télécharger</span>
          <a href=""><i class="fa fa-download" aria-hidden="true"> Mon CV</i></a>
        </div>
        <div class="social-media-cv">
          <span>et me suivre sur </span> 
          <a href=""><i class="fa-brands fa-linkedin" style="color: #405dce;"> Linkedin</i></a> 
          <span>et</span> 
          <a href=""><i class="fa-brands fa-github" style="color: #0a0a0a;"> Github</i></a>
        </div>
        <span>Merci pour votre visite et n'hésitez pas de me laisser vos commentaires :) </span>    
      </div>
    </div>
  </div>
</div>
<footer>
<div class="col1 coordonnees">
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
<div class="container contact">
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
<script src="../js/script.js"></script>