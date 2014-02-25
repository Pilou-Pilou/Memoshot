<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <script src="http://www.locavenue.fr/js/bootstrap.js"></script>
</head>


<nav style="z-index: 9999;position: fixed;width: 100%;" class="navbar navbar-inverse" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div><img style="margin-top:5px;height:40px" src="../images/MimageBanniere.png">&nbsp&nbsp&nbsp&nbsp</div>


        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="http://205.236.12.51/projet/h2014/equipe3/view/accueilView.php"> <span
                            class="glyphicon glyphicon-home"></span>&nbspHome</a></li>
            </ul>
            <form class="navbar-form navbar-left" role="search">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-search"></span>&nbspResearch
                </button>
            </form>


            <ul class="nav navbar-nav navbar-right">
                <li><a href="http://205.236.12.51/projet/h2014/equipe/view/ajouterUnePhotoView.php"> <span
                            class="glyphicon glyphicon-camera"></span>&nbspAjouter une photo</a></li>
                <li><a href="http://205.236.12.51/projet/h2014/equipe/view/fermer_session.php"> <span
                            class="glyphicon glyphicon-log-out"></span>&nbspDéconnexions</a></li>
                <li><a href="http://205.236.12.51/projet/h2014/equipe/view/visualisationCompteView.php"> <span
                            class="glyphicon glyphicon-user"></span>&nbspMon
                        Compte (<?php echo $_SESSION['pseudo']; ?>)</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span
                            class="glyphicon glyphicon-cog"></span>&nbspSettings <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="http://205.236.12.51/projet/h2014/equipe/view/modificationCompteView.php">Modification
                                Compte</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Abonnement</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>