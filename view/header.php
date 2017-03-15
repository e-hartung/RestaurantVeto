<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <!-- the head section -->
    <head>
        <title>Decision Time! Restaurant Veto</title>
        <?php echo $app_path ?>
        <link rel="stylesheet" type="text/css"
              href="<?php echo $app_path ?>css/normalize.css" />
        <link rel="stylesheet" type="text/css"
              href="<?php echo $app_path ?>css/skeleton.css" />
        
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
        
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">
        <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
            
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <script src="<?php echo $app_path ?>js/scripts.js"></script>
    </head>

    <!-- the body section -->
    <body>
    <div id="page" class="container">
        <div id="header" class="twelve columns">
            <h1>Decision Time!</h1>
            <nav>
                <ul>
                    <li>
                        <a href="<?php echo $app_path ?>">Home</a>
                    </li>
                    <?php if (isset($_SESSION['user'])) : ?>
                    <li>
                        <p>You are logged in as <?php echo $_SESSION['user']['username']; ?> 
                        <a href="?action=logout">Log Out</a>
                    </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
       