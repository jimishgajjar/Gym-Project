<?php
include('checkSession.php');
include('header.php');
?>

<body>
    <?php include('menu.php'); ?>

    <section class="course-detail">
        <div class="course-detail-header">
            <div class="container">
                <div class="row pb-5">
                    <div class="col-md-12 mb-10">
                        <ol class="cd-breadcrumb">
                            <li><a href="#0">Home</a></li>
                            <li><a href="#0">Gallery</a></li>
                            <li><a href="#0">Web</a></li>
                            <li class="current"><em>Project</em></li>
                        </ol>
                    </div>
                    <div class="col-md-8 col-md-push-8">
                        <div class="course-detail-title">
                            <h4>2022 Complete Python Bootcamp From Zero to Hero in Python</h4>
                        </div>
                        <div class="course-detail-description">
                            <p>
                                Learn Python like a Professional Start from the basics and go all the way to creating your own applications and games
                            </p>
                        </div>
                        <div class="course-rating mb-30">
                            <h6 class="course-rating-num">(4.6)</h6>
                            <span class="stars">4.6</span>
                        </div>
                        <div class="course-detail-price mb-20">
                            <a href="#" class="detail-btn wishlist">
                                <i class="far fa-heart"></i>
                            </a>
                            <a href="#" class="detail-btn cart pl-5 pr-5">
                                Add to cart
                            </a>
                            <a href="#" class="detail-btn buy pl-5 pr-5">
                                Buy now
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 col-md-pull-4">
                        <img class="course-thumbline" src="assets/thumbnail/61ae1000549e3.jpg" style="border-radius: 10px;" alt="course1">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include('footer.php'); ?>

</body>

</html>