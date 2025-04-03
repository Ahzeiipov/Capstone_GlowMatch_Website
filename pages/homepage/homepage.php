<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../../js/slider.js"></script>
    <script src="../../js/navigation.js"></script>
    <link rel="stylesheet" href="../../asset/css/homepage.css">
    <link rel="stylesheet" href="../../asset/global-style/product.css">
    <link rel="stylesheet" href="../../asset/css/navigation.css">  
    <script src="../../pages/homepage/homepage.js"></script>
    <title>Glow Match</title>
</head>

<body id ="homepage">
    <section>
        <?php include '../../component/navigation/navigation.php'; ?>
    </section>
    <section>
        <div class="main-wrapper">
            <div class="slider-wrapper">
                <div class="slides">
                    <!-- <img src="../../asset/image/slider/setpro.jpg" alt="nature"> -->
                     <video autoplay loop muted  src="../../asset/image/slider/slider_video.mp4"></video>
                </div>
                <h3 class="welcometext">Glow with Confidence Your Skin, Your Match</h3>
            </div>
        </div>
    </section>

    <section class="container">
        <div class="card card1" style="margin-left: 10px;">
            <img src="../../asset/image/card-image/card1.jpeg" alt="nature" id="image1">
            <p>The Check Ingredients feature analyzes skincare product ingredients and calculates their compatibility
                with the user’s skin type. By uploading an image, or entering ingredients manually, users receive a
                percentage match score that indicates how well the product suits their skin and beneficial of those
                ingredients.</p>
        </div>
 
    </section>
    
    <section>
        <h3 style="margin: 40px; font-size: 30px;">Moisturizer</h3>
        <?php include './product/moisturizer.php'; ?>
    </section>
    <section>   
        <h3 style="margin: 40px; font-size: 30px;">Sun Screen</h3>
        <?php include './product/sunscreen.php'; ?>
    </section>
    <section>
    <h3 style="margin: 40px; font-size: 30px;">Foam</h3>
        <?php include './product/foam.php'; ?>
    </section>
    <section>
        <?php include '../../component/footer/footer.php'; ?>
    </section>

    <?php if(isset($_SESSION['login_error'])): ?>
        <script>
            alert('<?php echo $_SESSION['login_error']; unset($_SESSION['login_error']); ?>');
        </script>
    <?php endif; ?>
</body>

</html>