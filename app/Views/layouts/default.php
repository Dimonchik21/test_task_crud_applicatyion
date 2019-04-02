<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $( function() {
            $( "#menu" ).menu();
        } );
    </script>
    <style>
        .ui-menu { width: 150px; }
        .ui-link { text-decoration: none; }
    </style>
</head>
<body>
    <?php echo $content; ?>
</body>
</html>