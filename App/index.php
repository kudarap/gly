<?php
    include_once('config.php');

    if(isset($_SERVER['REQUEST_URI']) && trim($_SERVER['REQUEST_URI'], '/') != '') {
        $new = $_SERVER['REQUEST_URI'];

        function httpGet($url) {
            $ch = curl_init();  
         
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $output = curl_exec($ch);
            curl_close($ch);

            return $output;
        }
         
        $res = json_decode(httpGet(API_CLICK . $new), true);
        $loc = '/';
        if(!isset($res['error'])) {
            $loc = $res['url'];
        }

        header('Location: ' . $loc);
    }
?>
<!doctype html>
<html ng-app="glyus">
    <head>
        <title>Glyus</title>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="keywords" content="chiligarlic, glyus, shortlink, shortener, linker">
        <meta name="description" content="Just another link shortener with a litle bit of twist">
        <meta name="author" content="glyus">

        <!-- Latest compiled and minified JQuery -->
        <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <!-- Latest compiled and minified Angular -->
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js"></script>
        
        <link rel="stylesheet" href="main.css">
        <script src="config.js"></script>
        <script src="app.js"></script>
    </head>
    <body>
        <div ng-controller="ShorterController" align="center" id="container">
            <h1>
                <span id="total_text">0</span>
                G l y . <span class="us">u s</span>
            </h1>
            <form ng-submit="create()">
                <input class="glyus" type="text" ng-model="url" autofocus required placeholder="Paste URL here to make it Simple">
            </form>
            <!-- <p class="new">{{new}}</p> -->
            <br />
            <p id="clicks_text" hidden>clicks <span class="badge">{{clicks}}</span></p>
        </div>

        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-53683442-4', 'auto');
            ga('send', 'pageview');
        </script>
    </body>
</html>