<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.104.2">
    <title>PHP Test</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/navbar-fixed/">

    <link href="bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="navbar-top-fixed.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">PHP Test</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                <li class="nav-item">
                    <a class="nav-link " aria-current="page" href="?seite=home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?seite=Registrierung">Registrieren</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?seite=tabelle">Tabelle</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?seite=alleadressen">Alle Adressen</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?seite=strassenname">Neuer Straßenname</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?seite=strassennamen_aendern">Straßennamen ändern</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?seite=neuer_ort">Neuer Ort</a>
                </li>
            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>

<main class="container">
    <div class="bg-light p-5 rounded">
        <?php
        include 'DBcon.php';
        include 'funktionen.php';
        if(isset($_GET['seite'])){
            switch ($_GET['seite']){
                case 'alleadressen':
                    include 'alleadressen.php';
                    break;
                case 'strassenname':
                    include 'strassenname.php';
                    break;
                case 'strassennamen_aendern':
                    include 'strassennamen_aendern.php';
                    break;
                case 'Registrierung':
                    include 'Registrierung.php';
                    break;
                case 'tabelle':
                    include 'tabelle.php';
                    break;
                case 'neuer_ort':
                    include 'neuerOrt.php';
                    break;
                default:
                    include 'Home.php';
            }
        }
        else{
            include 'Home.php';
        }

        ?>
    </div>
</main>


<script src="bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>




</body>
</html>




