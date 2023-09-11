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
    <link rel='stylesheet' type='text/css' href='../styles/css/main.css' >
    <link href="../styles/css/bootstrap.min.css" rel="stylesheet">
    <link href="../styles/css/templatemo-xtra-blog.css" rel="stylesheet">
</head>
<body>
    <header>
        <div class="menu">
            <div class="title">
                <span>Fatima ALKHALLOUFI</span> - développeuse Fullstack junior
            </div>
            <div id="sidebarMenu">
                <div class="main-content-wrapper">
                    <a>Accueil</a>
                    <a class="active">Blog</a>
                    <a>Mes projets</a>
                    <a>Déconnexion</a>
                </div>
            </div>
        </div>
        
        <div class="logo">
            <img class="logo-mini" src="assets/image_blog.jpg"  alt="logo">
        </div>
    </header>
    <div class="container-fluid">
        <main class="tm-main">
            <!-- Search form -->
            
            <!-- <div class="row tm-row">
                <div class="col-12">
                    <form method="GET" class="form-inline tm-mb-80 tm-search-form">                
                        <input class="form-control tm-search-input" name="query" type="text" placeholder="Rechercher..." aria-label="Search">
                        <button class="tm-search-button" type="submit">
                            <i class="fas fa-search tm-search-icon" aria-hidden="true"></i>
                        </button>                                
                    </form>
                </div>                
            </div>   -->
            <a class="add-post" href=""><button class="tm-btn tm-btn-primary">Ajouter un post</button></a>   
            <div class="row tm-row">
<?php
$posts = $_SESSION['posts'];
foreach($posts as $post)
{
echo '<article class="col-12 col-md-6 tm-post">
<hr class="tm-hr-primary">
<a href="post.html" class="effect-lily tm-post-link tm-pt-60">
    <div class="tm-post-link-inner">
        <img src="'.$post['image'].'" alt="Image" class="img-fluid">                            
    </div>
    <span class="position-absolute tm-new-badge">New</span>
    <h2 class="tm-pt-30 tm-color-primary tm-post-title">'.$post['title'].'</h2>
</a>                    
<p class="tm-pt-30">
'.$post['description'].'
</p>
<div class="d-flex justify-content-between tm-pt-45">
    <span class="tm-color-primary">'.$post['category'].'</span>
    <span class="tm-color-primary">June 24, 2020</span>
</div>
<hr>
<div class="d-flex justify-content-between">
    <span>36 comments</span>
    <span>by Admin Nat</span>µ
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