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
    <li><a href="/home">Accueil</a></li>
    <li><a class="active" href="#blog">Blog</a></li>
    <li><a href="#mesprojets">Mes projets</a></li>

</ul>
</header>
<div class="container-fluid">
<?php
$posts = $_SESSION['posts'];
if($connected){
    echo' <button class="add-post tm-btn tm-btn-primary">Ajouter un post</button>
    <div class="create-post-hidden">
    <form action="/posts/create" method="post" class="mb-5 tm-comment-form">
    
    <div id="hiden" class="mb-4">
    <input class="form-control" name="post_id" type="hiden" value="'.$post['id'].'">
    </div>
    <label for="title">Titre</label>
    <div class="mb-4">
    <textarea class="form-control" name="title" rows="6"></textarea>
    </div>
    <label for="image">Image</label>
    <div class="mb-4">
    <textarea class="form-control" name="image" rows="6"></textarea>
    </div>
    <label for="description">Description</label>
    <div class="mb-4">
    <textarea class="form-control" name="description" rows="6"></textarea>
    </div>
    <label for="category">Catégorie</label>
    <div class="mb-4">
    <textarea class="form-control" name="category" rows="6"></textarea>
    </div>
    <div class="text-right">
    <button class="tm-btn tm-btn-primary tm-btn-small">Envoyer</button>                        
    </div>                                
    </form>  
    </div>';
}
?>
<main class="tm-main">

<div class="row tm-row">
<?php
foreach($posts as $post)
{
    echo '<article class="col-12 col-md-6 tm-post">
    <hr class="tm-hr-primary">
    <a href="post.html" class="effect-lily tm-post-link tm-pt-60">
    <div class="tm-post-link-inner">
    <img class="post-image" src="'.$post['image'].'" alt="Image" class="img-fluid">                            
    </div>
    <h2 class="tm-pt-30 tm-color-primary tm-post-title">'.$post['title'].'</h2>
    </a>                    
    
    <div class="d-flex justify-content-between tm-pt-45">
    <span class="tm-color-primary">'.$post['category'].'</span>
    <span class="tm-color-primary">June 24, 2020</span>
    </div>
    <hr>
    <div class="d-flex justify-content-between">
    <span>'. count($post['comments']).' comments</span>
    <span>'.$post['user']['name'].'</span>
    </div>
    </article>';
}
?>
</div>
<div class="row tm-row tm-mt-100 tm-mb-75">
<div class="tm-prev-next-wrapper">
<a href="#" class="mb-2 tm-btn tm-btn-primary tm-prev-next disabled tm-mr-20">Précédent</a>
<a href="#" class="mb-2 tm-btn tm-btn-primary tm-prev-next">Suivant</a>
</div>
<div class="tm-paging-wrapper">
<span class="d-inline-block mr-3">Page</span>
<nav class="tm-paging-nav d-inline-block">
<ul>
<li class="tm-paging-item active">
<a href="#" class="mb-2 tm-btn tm-paging-link">1</a>
</li>
<li class="tm-paging-item">
<a href="#" class="mb-2 tm-btn tm-paging-link">2</a>
</li>
<li class="tm-paging-item">
<a href="#" class="mb-2 tm-btn tm-paging-link">3</a>
</li>
<li class="tm-paging-item">
<a href="#" class="mb-2 tm-btn tm-paging-link">4</a>
</li>
</ul>
</nav>
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