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
    <link rel='stylesheet' type='text/css' href='../styles/css/main.css' >
    <link href="../styles/css/bootstrap.min.css" rel="stylesheet">
    <link href="../styles/css/templatemo-xtra-blog.css" rel="stylesheet">
</head>
<body>
    <!-- <header>
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
            <img class="logo-mini" src="../assets/image_blog.jpg"  alt="logo">
        </div>
    </header> -->
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
    <li><a href="#apropos">A propos</a></li>
    <li><a class="active" href="#blog">Blog</a></li>
    <li><a href="#mesprojets">Mes projets</a></li>

</ul>
</header>
    <?php
            $post= $_SESSION['post'];
            $comments = $_SESSION['comments'];
            $user = $_SESSION['user'];
            echo '
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
            </div>             -->
            
            <div class="row tm-row">
                <div class="col-12 one-post">
                    <hr class="tm-hr-primary tm-mb-55">
                    <!-- Video player 1422x800 -->

                    <img src="'.$post['image'].'" width="954" height="535" controls class="tm-mb-40">							  
                     
                </div>
            </div>
            <div class="row tm-row">
                <div class="col-lg-8 tm-post-col">
                    <div class="tm-post-full">                    
                        <div class="mb-4">
                            <h2 class="pt-2 tm-color-primary tm-post-title">'.$post['title'].'</h2>
                            <p class="tm-mb-40">'.$post['category'].'</p>
                            <p>
                            '.$post['description'].'
                            </p>
                            <span class="d-block text-right tm-color-primary">Creative . Design . Business</span>
                        </div>
                        
                        <!-- Comments -->
                        <div>
                            <h2 class="tm-color-primary tm-post-title">Comments</h2>
                            <hr class="tm-hr-primary tm-mb-45">';
foreach ($comments as $comment) {
                           echo' <!-- debut 1st comment -->
                            <div class="tm-comment tm-mb-45">
                                <figure class="tm-comment-figure">
                                    <img class="user-image" src="'.$comment['user']['avatar'].'">
                                    <figcaption class="tm-color-primary text-center">'.$comment['user']['name'].'</figcaption>
                                </figure>
                                <div>
                                    <p>
                                    '.$comment['description'].'
                                    </p>
                                    <div class="d-flex justify-content-between">
                                        <a href="#" class="tm-color-primary">REPLY</a>
                                        <span class="tm-color-primary">June 14, 2020</span>
                                    </div>                                                 
                                </div>                                
                            </div>
                            <!-- fin 1st comment -->';
                        }
                            echo' <form action="/comments/create" method="post" class="mb-5 tm-comment-form">
                                <h2 class="tm-color-primary tm-post-title mb-4">Ajouter un commentaire</h2>
                                
                                <div class="mb-4">
                                    <input class="form-control" name="post_id" type="hiden" value="'.$post['id'].'">
                                </div>
                                <div class="mb-4">
                                    <textarea class="form-control" name="description" rows="6"></textarea>
                                </div>
                                <div class="text-right">
                                    <button class="tm-btn tm-btn-primary tm-btn-small">Envoyer</button>                        
                                </div>                                
                            </form>                          
                        </div>
                    </div>
                </div>
                <aside class="col-lg-4 tm-aside-col">
                    <div class="tm-post-sidebar">
                        <hr class="mb-3 tm-hr-primary">
                        <h2 class="mb-4 tm-post-title tm-color-primary">Catégories</h2>
                        <ul class="tm-mb-75 pl-5 tm-category-list">
                            <li><a href="#" class="tm-color-primary">Web design</a></li>
                            <li><a href="#" class="tm-color-primary">Web Development</a></li>
                            <li><a href="#" class="tm-color-primary">Wordpress</a></li>
                            <li><a href="#" class="tm-color-primary">Base de donnée</a></li>
                        </ul>
                        <hr class="mb-3 tm-hr-primary">
                        <h2 class="tm-mb-40 tm-post-title tm-color-primary">Meilleurs posts</h2>
                        <a href="#" class="d-block tm-mb-40">
                            <figure>
                                <img src="img/img-02.jpg" alt="Image" class="mb-3 img-fluid">
                                <figcaption class="tm-color-primary">Duis mollis diam nec ex viverra scelerisque a sit</figcaption>
                            </figure>
                        </a>
                        <a href="#" class="d-block tm-mb-40">
                            <figure>
                                <img src="img/img-05.jpg" alt="Image" class="mb-3 img-fluid">
                                <figcaption class="tm-color-primary">Integer quis lectus eget justo ullamcorper ullamcorper</figcaption>
                            </figure>
                        </a>
                        <a href="#" class="d-block tm-mb-40">
                            <figure>
                                <img src="img/img-06.jpg" alt="Image" class="mb-3 img-fluid">
                                <figcaption class="tm-color-primary">Nam lobortis nunc sed faucibus commodo</figcaption>
                            </figure>
                        </a>
                    </div>                    
                </aside>
            </div>
            
        </main>
    </div>';
    ?>
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