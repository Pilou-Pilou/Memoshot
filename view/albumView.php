<?php
/**
 * Created by PhpStorm.
 * User: Rulio
 * Date: 21/02/14
 * Time: 17:02
 */

session_start();
require_once('../Modele/testSessionModele.php');
require_once('../Config/ConnexionBD.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>MemoShot - <?php echo $_SESSION['pseudo_util']; ?></title>
    <link href="../css/bootstrapbis.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/bootstrap-lightbox/bootstrap-lightbox.min.css">
    <link href="//rawgithub.com/ashleydw/lightbox/master/dist/ekko-lightbox.css" rel="stylesheet">
</head>

<body style="background-color: #43A1CF ">
<div style="height: 10%">
    <?php
    require_once('../header.php');
    ?>
</div>

<div class="container" style="margin-bottom:2%;margin-top:8%;background-color: #43A1CF ">

    <div class="content">
        <h1 align="center">Album Photo de <?php echo $_SESSION['pseudo_util']; ?></h1>

        <p>&nbsp;</p>

        <p>&nbsp;</p>

        <div class="polaroid-images">
<<<<<<< .merge_file_VuxVHR
            <div class="row">
                <div class="col-md-offset-2 col-md-8">
                    <div class="row">
                        <?php
                        $compteur = 1;
                        $connexions = new ConnexionBD();
                        $connexions->connexion();
                        $req = mysql_query('SELECT * FROM album  where id_utilisateur=\'' . $_SESSION['profile'] . '\'')
                        or die ("Impossible de se connecté à la table album" . mysql_error());
                        while ($valeur = mysql_fetch_assoc($req)) {
                            $image = $valeur['photo'];
                            $nom = $valeur['nom'];

                            echo "<a title='" . $nom . "' data-toggle='lightbox' data-gallery='multiimages' href='" . $image . "' backdrop='true' keyboard='true' data-footer='Le bouton de suppression sera ici' data-title='" . $nom . "'><img height='200' src='" . $image . "' title='" . $nom . "' /></a>";
                            $compteur++;
                        }
                        ?>
                    </div>
                </div>
            </div>

=======
            <?php
            $compteur = 1;
            $connexions = new ConnexionBD();
            $connexions->connexion();
            $req = mysql_query('SELECT * FROM album  where id_utilisateur=\'' . $_SESSION['profile'] . '\'')
            or die ("Impossible de se connecté à la table album" . mysql_error());
            while ($valeur = mysql_fetch_assoc($req)) {
                $image = $valeur['photo'];
                $nom = $valeur['nom'];
                echo '<a href="" title="' . $nom . '"><img height="200" src="' . $image . '" alt="Cave" title="Cave"/></a>';
                $compteur++;
            }
            ?>
>>>>>>> .merge_file_f22tZR
        </div>

        <?php

        for ($i = 0; $i < 4.5 * $compteur; $i++) {
            echo '<p>&nbsp;</p>';
        }
        ?>


        <script src="//code.jquery.com/jquery.js"></script>
        <!-- yea, yea, not a cdn, i know -->
        <script src="//rawgithub.com/ashleydw/lightbox/master/dist/ekko-lightbox.js"></script>
        <script type="text/javascript">
            $(document).ready(function ($) {

                // delegate calls to data-toggle="lightbox"
                $(document).delegate('*[data-toggle="lightbox"]', 'click', function (event) {
                    event.preventDefault();
                    return $(this).ekkoLightbox({
                        always_show_close: true
                    });
                });

            });
        </script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>

        <script>
            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                    m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-43208246-2', 'ashleydw.github.io');
            ga('send', 'pageview');
        </script>

    </div>
    <div class="footer">
        <!-- end .footer -->
    </div>
    <!-- end .container --></div>
</body>
</html>



