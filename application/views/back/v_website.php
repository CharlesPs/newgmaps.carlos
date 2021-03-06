<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <base href="<?php echo base_url(); ?>" />

        <link rel="stylesheet" href="static/css/backend/bootstrap.min.css">

        <style type="text/css">
          body {
            padding-top: 60px;
          }
        </style>

        <link rel="stylesheet" href="static/css/backend/bootstrap-responsive.min.css">
        <link rel="stylesheet" href="static/css/backend/main.css">

        <script src="static/js/backend/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>

        <script>
        var base_url = '<?php echo base_url(); ?>';
        </script>

    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <?php echo $web_content; ?>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="static/js/backend/vendor/jquery-1.9.1.min.js"><\/script>')</script>

        <script src="static/js/backend/vendor/bootstrap.min.js"></script>

        <script src="static/js/backend/plugins.js"></script>
        <script src="static/js/backend/main.js"></script>

        <script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
    </body>
</html>
