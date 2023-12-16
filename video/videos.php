<?php
include "../model/models.php";
$id = $_GET["a"];
$videos = Consultas::videoArtista($id);

?>

<!doctype html>
<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title> Videos</title>

    <!-- CSS -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,600">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/media-queries.css">

    <!-- Favicon and touch icons -->
    <link rel="shortcut icon" href="assets/ico/favicon.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

</head>

<body>

    <div class="container">
        <!-- Title and description row -->

        <!-- End title and description row -->
        <!-- Carousel row -->
        <div class="row align-items-center choose-c justify-content-md-center">
            <div class="col col-md-12 offset-md-1 col-lg-12 offset-lg-2">
                <!-- Carousel -->
                <div id="carousel-example" class="carousel slide">
                    <ol class="carousel-indicators">
                        <?php
                        for ($i = 0; $i <  count($videos); $i++) {
                            if ($i == 0) {
                                $activeVidLI = 'active';
                            } else {
                                $activeVidLI = '';
                            }
                        ?>
                            <li data-target="#carousel-example" data-slide-to=<?php echo $i; ?>" class="<?php echo $activeVidLI; ?>"></li>

                        <?php
                        }
                        ?>

                    </ol>



                    <div class="carousel-inner">

                        <?php
                        for ($i = 0; $i <  count($videos); $i++) {
                            if ($i == 0) {
                                $activeVid = 'active';
                            } else {
                                $activeVid = '';
                            }
                        ?>
                            <div class="carousel-item <?php echo $activeVid; ?>">
                                <div class="embed-responsive embed-responsive-16by9">
                                    <?php
                                    echo '<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/' . $videos[$i]["embed_multi"] . '" allowfullscreen></iframe>';
                                    ?>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>



                    <a class="carousel-control-prev" href="#carousel-example" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carousel-example" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <!-- End carousel -->
            </div>
        </div>
        <!-- End carousel row -->
    </div>


    <!-- Javascript -->
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/jquery-migrate-3.0.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="assets/js/jquery.backstretch.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
    <script src="assets/js/waypoints.min.js"></script>
    <script src="assets/js/scripts.js"></script>

</body>

</html>