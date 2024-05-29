<?php
/**
 *   View file
 *   php version 8
 *
 * @category Content
 * @package  Lodur
 * @author   Ylva Sjölin <yso@spektatum.com>
 * @license  MIT 
 * @link     https://www.spektatum.com
 **/
?>

<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link rel="stylesheet" href="style/style.css?v=9">
    
    <meta property="og:image" 
          content="https://www.spektatum.com/img/stamp/stamp2.jpg">
    <meta name="description" content="Lodur Test">
    <link rel="icon" href="img/logo.png" type="image/jpg">

    <!-- Preload for faster perfomance-->
    <link rel="preload" href="style/style.css?v=9" as="style">
    <title>  LODUR test program </title>

</head> 
<body>
    
    <div class = 'mainWrapper'>
    
        <!-- Section 1 for header -->
        <div class='header'>
            <?php if (isset($header)) {
                echo $header;
            } ?>
                <a href='add' id='add'> ADD </a> 
                <a href='edit' id='edit'> EDIT </a> 
                <a href='delete' id='delete'> DELETE </a>
                <a href='list' id='list'> LIST </a>  
        </div>

        <!-- Section 1 for form -->
        <div class='section1'>
            <?php if (isset($data)) {
                echo $data;
            } ?>

        </div>

        <!-- Section 2 for display content -->
        <div class='section2'>
            <?php if (isset($list)) {
                echo $list;
            } ?>
        </div>

        <!-- Database feedback -->
        <div class='feedback'>
            <?php if (isset($dbFeedback)) {
                    echo $dbFeedback;
            } ?>
        </div>
    
        <!-- Section for footer -->
        <div class='footer'>
            <?php if (isset($footer)) {
                echo $footer;
            } ?>
            <?php if (isset($version)) {
                echo $version;
            } ?>
            
        </div>

    </div>

</body> 

<script src="js/main.js?v=1"></script>

</html>