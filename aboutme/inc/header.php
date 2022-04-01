<?php
    session_start();
    ob_start();
    require_once $_SERVER['DOCUMENT_ROOT'] . '/util/DatabaseConnectUtil.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/util/ConstantUtil.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/util/Utf8ToLatinUtil.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aboutme</title>
    <link rel="stylesheet" type="text/css" href="/templates/aboutme/style.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">       
    <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript" src="/libraries/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="/libraries/jquery.validate.min.js"></script>
    <script type="text/javascript" src="/libraries/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="/libraries/ckfinder/ckfinder/ckfinder.js"></script>
   
</head>
<body>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v11.0" nonce="a9BsGEqa"></script>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v11.0" nonce="7INGEf5I"></script>
    <nav class="navbar navbar-expand-md fixed-top navbar-light sticky-top">
        <div class="container">
            <a class="navbar-branch" href="http://beritaharibaru.xyz/">
                <img src="/templates/aboutme/img/logo.png" height="50">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" 
                data-target="#navbarResponsive">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="/">Giới thiệu</a>
                    </li>
                    <li class="nav-item">
                        <?php
                            $query1 = "SELECT * FROM cat";
                            $ketqua1 = $mysqli->query($query1);
                            $ar_cat = mysqli_fetch_assoc($ketqua1);
                            $id_cat = $ar_cat['id_cat'];
                            $ten_danhmuc = $ar_cat['ten_danhmuc'];
                            $nameRepalace = utf8ToLatin($ten_danhmuc);
                            $url = '/' . $nameRepalace . '-' . $id_cat;
                        ?>
                        <a class="nav-link" href="<?php echo $url; ?>">Tin tức</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/lien-he">Liên hệ</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>