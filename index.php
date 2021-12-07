<?php
include('header.php');
?>

<body>
    <?php include('menu.php'); ?>

    <section class="xs-light-bg position-relative" data-scrollax-parent="true" id="home">
        <div class="container xs-clips-wraper">
            <div class="xs-clips">
                <img src="assets/images/shape/banner-light-clips.png" alt="clip">
            </div>
        </div>

        <div class="owl-carousel owl-theme xs-slider-light-owl">
            <div class="xs-slide-inner">
                <div class="container">
                    <div class="banner-inner-wraper">
                        <h2 class="xs-before-text" data-text="FITN">Fitn</h2>
                        <div class="xs-light-slide-img3 xs-fadeInRight">
                            <img src="assets/images/slider-light/slide-3.png" alt="shape">
                        </div>
                        <h2 class="xs-after-text" data-text="ESS">ess</h2>
                    </div>
                </div>
                <div class="xs-shape xs-banner-light-left" data-scrollax="properties: { translateY: '-250px' }" style="background-image: url(assets/images/shape/banner-light-left.png);"></div>
                <img src="assets/images/shape/banner-light-clips-right.png" class="banner_right_shape" data-scrollax="properties: { translateY: '250px' }" alt="">
            </div>
            <div class="xs-slide-inner">
                <div class="container">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="xs-light-slide2 xs-fadeInLeft">
                                <h1 class="xs-banner-title xs-line">Healthy Body, <span>Fresh Mind</span></h1>
                                <p>World is committed to making particiation in the harassment free experience for
                                    everyone regardless</p>
                                <a href="#" class="btn btn-primary">Join Classes <span class="icon icon-plus"></span></a>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="xs-light-slide-img2">
                                <div class="xs-water-mark xs-slideInDown">Body</div>
                                <img class="xs-fadeInRight" src="assets/images/slider-light/slide-2.png" alt="image">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="xs-shape xs-banner-light-left" data-scrollax="properties: { translateY: '-250px' }" style="background-image: url(assets/images/shape/banner-light-left.png);"></div>
                <div class="xs-shape xs-banner-light-right" data-scrollax="properties: { translateY: '250px' }" style="background-image: url(assets/images/shape/banner-light-right.png);"></div>
            </div>
            <div class="xs-slide-inner">
                <div class="container">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="xs-light-slide1 xs-fadeInLeft">
                                <h1 class="xs-banner-title xs-line">Don’t be Brat <span>Burn Fat</span></h1>
                                <p>World is committed to making particiation in the harassment free experience for
                                    everyone regardless</p>
                                <a href="#" class="btn btn-primary">Join Classes <span class="icon icon-plus"></span></a>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="xs-light-slide-img1 xs-fadeInRight">
                                <img src="assets/images/slider-light/slide-1.png" alt="images">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="xs-shape xs-banner-light-left" data-scrollax="properties: { translateY: '-250px' }" style="background-image: url(assets/images/shape/banner-light-left.png);"></div>
                <div class="xs-shape xs-banner-light-right" data-scrollax="properties: { translateY: '250px' }" style="background-image: url(assets/images/shape/banner-light-right.png);"></div>
            </div>
        </div>
    </section>

    <section class="xs-section-padding" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="xs-section-heading text-center">
                        <h2>Our Best <span>Courses</span></h2>
                        <!-- <p>World is committed to making participation in the event a harassment free experience for
                            everyone, regardless of level of experience.</p> -->
                    </div>
                </div>
            </div>
            <div id="rate"></div>

            <div class="row">
                <?php
                $courseList = getData('course');
                if ($courseList->num_rows > 0) {
                    while ($row = $courseList->fetch_assoc()) {
                        $Condition['id'] = $row['category_id'];
                        $response = getData('category', $Condition);
                        $response = $response->fetch_assoc();
                ?>
                        <div class="col-md-3 mb-25">
                            <div class="course">
                                <!-- <a href="" class="course-link"> -->
                                <img class="course-thumbline" src="assets/thumbnail/<?php echo $row['thumbnail']; ?>" alt="course1" />
                                <div class="course-content">
                                    <div class="course-category mb-1">
                                        <?php echo $response['category_name']; ?>
                                    </div>
                                    <div class="course-title mb-1">
                                        <?php
                                        if (strlen($row['title']) >= 85) {
                                            echo substr($row['title'], 0, 85) . "...";
                                        } else {
                                            echo substr($row['title'], 0, 85);
                                        }
                                        ?>
                                    </div>
                                    <div class="course-rating mb-1">
                                        <h6 class="course-rating-num">(<?php echo $row['rating']; ?>)</h6>
                                        <span class="stars"><?php echo $row['rating']; ?></span>
                                    </div>
                                    <a href="#" class="btn btn-primary">Know More</a>
                                </div>
                                <!-- </a> -->
                            </div>
                        </div>
                <?php }
                } ?>
            </div>
        </div>
    </section>

    <section class="xs-light-bg xs-section-padding xs-pb-sm" data-scrollax-parent="true" id="training">
        <div class="xs-team-wraper">
            <div class="xs-shape xs-team-shape" data-scrollax="properties: { translateY: '-100%' }" style="background-image: url(assets/images/shape/dot.png);"></div>
            <div class="xs-shape xs-team-right-shape" data-scrollax="properties: { translateY: '100%' }" style="background-image: url(assets/images/shape/memphis.png);"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="xs-section-heading text-center">
                            <h2>Our <span>Classes</span></h2>
                            <p>World is committed to making participation in the event a harassment free experience for
                                everyone, regardless of level of experience.</p>
                        </div>
                    </div>
                </div>
                <div class="xs-classes-light">
                    <div class="row">
                        <?php
                        $categoryList = getData('category');
                        if ($categoryList->num_rows > 0) {
                            while ($row = $categoryList->fetch_assoc()) {
                        ?>
                                <div class="col-lg-4 col-md-6">
                                    <div class="xs-service">
                                        <img src="assets/category/<?php echo $row['category_img']; ?>" alt="case">
                                        <div class="xs-overlay d-flex align-items-center">
                                            <div class="xs-service-content">
                                                <div class="xs-icon-wraper">
                                                    <i class="icon icon-dumble"></i>
                                                </div>
                                                <h3><?php echo $row['category_name']; ?></h3>
                                                <p>We have heap of fun piece of equi to build down every inh of your for body.
                                                </p>
                                                <a href="#" class="btn btn-primary">
                                                    <i class="icon icon-arrow"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="xs-pt-50 xs-pb-sm parallaxie" style="background-image: url(assets/images/bmi-bg.png);">
        <div class="container">
            <div class="xs-bmi">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="xs-colummn-heading2">
                            <h2>BMI <span>Chart</span></h2>
                        </div>
                        <div class="table-responsive xs-bmi-table">
                            <table class="table table-bordered">
                                <caption>Body Metabolic Rate / energy expenditure per unit time</caption>
                                <thead>
                                    <tr>
                                        <th scope="col">BMI</th>
                                        <th scope="col">WEIGHT STATUS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Below 18.5</td>
                                        <td>Underweight</td>
                                    </tr>
                                    <tr>
                                        <td>18.5 - 24.9</td>
                                        <td>Healthy</td>
                                    </tr>
                                    <tr>
                                        <td>25.0 - 29.9</td>
                                        <td>Overweight</td>
                                    </tr>
                                    <tr>
                                        <td>30 and Above</td>
                                        <td>Obese</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="xs-colummn-heading2">
                            <h2>Calculate <span>Your BMI</span></h2>
                            <p>World is committed to making participation in the event harass ment free on experience
                                for
                                everyone, regardless of leve of expenc</p>
                        </div>
                        <form action="#" class="xs-form xs-form-dark">
                            <div class="row">
                                <div class="col-md-6">
                                    <div id="heightWrap" class="form-group xs-form-anim">
                                        <label class="input-label" for="xs-height">Height / cm</label>
                                        <input type="number" min="1" max="500" id="xs-height" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div id="weightWrap" class="form-group xs-form-anim">
                                        <label class="input-label" for="xs-weight">Weight / kg</label>
                                        <input type="number" min="1" max="500" id="xs-weight" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group xs-form-anim">
                                        <label class="input-label" for="xs-age">Age</label>
                                        <input type="number" min="1" max="200" id="xs-age" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 align-self-end">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadio1" name="sex" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio1">Male</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadio2" name="sex" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio2">Female</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadio3" name="sex" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio3">Other</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group xs-mt-20">
                                        <button type="submit" id="calculate" class="btn btn-primary">Calculate</button>
                                    </div>
                                    <div id="xs-bmi-info" class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="position-relative xs-section-padding xs-bg-cover parallaxie" style="background-image: url(assets/images/testimonial/testimonial_img.jpg);" data-scrollax-parent="true">
        <div class="xs-testimonial-wraper">
            <div class="xs-shape xs-testimonial-shape" style="background-image: url(assets/images/shape/dot-2.png);" data-scrollax="properties: { translateY: '250px' }"></div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="xs-section-heading text-center">
                        <h2>Success <span>Stories</span></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-9 mx-auto">

                    <div class="owl-carousel owl-theme xs-testimonial-owl">
                        <div class="item">
                            <i class="icon icon-quote"></i>
                            <p>World is committed to making participa in the event that rassment free experience for
                                every, regardless level of experienc, gender identity.and expression orientation,
                                disability by the personal appearance</p>
                            <div class="xs-testimonial-profile clearfix">
                                <div class="xs-profile-thumb">
                                    <img src="assets/images/testimonial/testimonial-profile-2.png" class="rounded-circle" alt="testimonial">
                                </div>
                                <div class="xs-profile-info">
                                    <h3>David William</h3>
                                    <p>Yoga Trainer</p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <i class="icon icon-quote"></i>
                            <p>World is committed to making participa in the event that rassment free experience for
                                every, regardless level of experienc, gender identity.and expression orientation,
                                disability by the personal appearance</p>
                            <div class="xs-testimonial-profile clearfix">
                                <div class="xs-profile-thumb">
                                    <img src="assets/images/testimonial/testimonial-profile-3.png" class="rounded-circle" alt="testimonial">
                                </div>
                                <div class="xs-profile-info">
                                    <h3>William Mill</h3>
                                    <p>Body Building Trainer</p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <i class="icon icon-quote"></i>
                            <p>World is committed to making participa in the event that rassment free experience for
                                every, regardless level of experienc, gender identity.and expression orientation,
                                disability by the personal appearance</p>
                            <div class="xs-testimonial-profile clearfix">
                                <div class="xs-profile-thumb">
                                    <img src="assets/images/testimonial/testimonial-profile-1.png" class="rounded-circle" alt="testimonial">
                                </div>
                                <div class="xs-profile-info">
                                    <h3>Stive Mark</h3>
                                    <p>Yoga Trainer</p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <i class="icon icon-quote"></i>
                            <p>World is committed to making participa in the event that rassment free experience for
                                every, regardless level of experienc, gender identity.and expression orientation,
                                disability by the personal appearance</p>
                            <div class="xs-testimonial-profile clearfix">
                                <div class="xs-profile-thumb">
                                    <img src="assets/images/testimonial/testimonial-profile-2.png" class="rounded-circle" alt="testimonial">
                                </div>
                                <div class="xs-profile-info">
                                    <h3>David William</h3>
                                    <p>Yoga Trainer</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include('footer.php'); ?>

</body>

</html>