<?php

if (isset($_SESSION['admin'])) {
    ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        <?= $title ?>
    </title>

    <!--phrase donnée si url copiée sur les réseaux sociaux-->
    <meta name="description" content="Grâce à mon blog vous pouvez découvrir, au fur et mesure de sa création, mon nouveau roman 'Billet simple pour l\'Alaska'." />

    <!-- pour Facebook Open Graph data -->
    <meta property="og:title" content="Billet simple pour l'Alaska" />
    <meta property="og:type" content="blog" />
    <meta property="og:url" content="http://www.project4.lperrindevweb.com/" />
    <meta property="og:image" content="public/images/logo_mountain2.png" />
    <meta property="og:description" content="Grâce à mon blog vous pouvez découvrir, au fur et mesure de sa création, mon nouveau roman 'Billet simple pour l\'Alaska'." />

    <!-- pour Twitter Card data -->
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="@project4.lperrindevweb.com/" />
    <meta name="twitter:creator" content="@jeanForteroche" />
    <meta property="og:url" content="http://bits.blogs.nytimes.com/2011/12/08/a-twitter-for-my-sister/" />
    <meta property="og:title" content="Blog" />
    <meta property="og:description" content="Grâce à mon blog vous pouvez découvrir, au fur et mesure de sa création, mon nouveau roman 'Billet simple pour l\'Alaska'." />
    <meta property="og:image" content="public/images/logo_mountain2.png" />

    <!--lien mise en  forme css-->

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="public/css/style.css" />

    <!--lien pour Tinymce-->
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=f1z0mxiy25ovdbuqio3rql71n6tjvswysrwyhy7ym1y28mln"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: '#myTextarea',
            theme: 'modern',
            height: 500,
            plugins: "autoresize",
            entity_encoding: "raw",
            plugins: [
                'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
                'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
                'save table contextmenu directionality emoticons template paste textcolor'
            ],
            content_css: 'css/content.css',
            toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons'
        });
    </script>

    <script type="text/javascript">
        tinymce.init({
            selector: '#myTextareaTitle',
            theme: 'modern',
            height: 100,
            plugins: "autoresize",
            entity_encoding: "raw",
            plugins: [
                'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
                'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
                'save table contextmenu directionality emoticons template paste textcolor'
            ],
            content_css: 'css/content.css',
            toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons'
        });
    </script>

</head>

<body>
    <header class="container-fluid">
        <div class="row align-items-center">
            <div class="col">
                <div class="media">
                    <img class="align-self-center mr-3" src="public/images/logo_mountain2.png" alt="logo de montagne" />
                    <div class="media-body">
                        <h1 class="mb-0">Billet simple pour l'Alaska</h1>
                    </div>
                </div>
            </div>
            <div class="col">
                <nav>
                    <ul class="list-unstyled">
                        <li>
                            <a href="index.php?action=listEpisodesAdmin">Épisodes</a>
                        </li>
                        <li>
                            <a href="index.php?action=reportedCommentsView">Modération</a>
                        </li>
                        <li>
                            <a href="index.php?action=logoutAdmin">Déconnexion</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <div id="main_wrapper" class="container">
        <!--variable déclarée dans view:-->
        <div class="col-lg-12">
            <?= $content ?>
        </div>
    </div>

    <!--===================================== Pied de page ==============================================================================-->
    <footer class="container-fluid">
        <!--========texte pied de page================================================-->
        <span class="row align-items-center">
            <p class="col-11">© 2018 - Blog factice développé par Laureen Perrin pour l'établissement OpenClassRooms</p>
            <!--========retour haut de page==========================================-->
            <p class="col-1">
                <i id="topButtonFront" class="fas fa-angle-up"></i>
            </p>
        </span>
    </footer>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>

    <!--========lien pour fihier js===========================================================-->
    <script src="public/js/javascript.js"></script>

</body>

</html>

<?php
} else {
        throw new Exception('Vous n\'avez pas les droits suffisants pour accéder à cette page');
    }
