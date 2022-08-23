<?php include "./db.php"?>
<?php include 'header.php'; include 'navbar.php';?>
<!-- Carousel Start -->
<div class="container-fluid p-0">
    <div id="header-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <?php
                $sql = "SELECT * from cover";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result) ?>
            <div style="max-height: 50rem;" class="carousel-item active">
                <img class="w-100 h-100" src="image/cover/<?php echo $row['id']?>.webp" alt="Image">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 800px;">
                        <h3 class="display-3 text-white mb-md-4"><?php echo $row['title']?></h3>
                        <h4 class="text-primary text-uppercase font-weight-normal mb-md-3"><?php echo $row['details'];?>
                        </h4>
                    </div>
                </div>
            </div>

            <?php
                while ($row = mysqli_fetch_assoc($result)) {?>

            <div style="max-height: 50rem;" class="carousel-item">
                <img class="w-100 h-100" src="image/cover/<?php echo $row['id'];?>.webp" alt="Image">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 800px;">
                        <h3 class="display-3 text-white mb-md-4"><?php echo $row['title']?></h3>
                        <h4 class="text-primary text-uppercase font-weight-normal mb-md-3"><?php echo $row['details']?>
                        </h4>
                    </div>
                </div>
            </div>
            <?php }?>

        </div>
        <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
            <div class="btn btn-primary" style="width: 45px; height: 45px;">
                <span class="carousel-control-prev-icon mb-n2"></span>
            </div>
        </a>
        <a class="carousel-control-next" href="#header-carousel" data-slide="next">
            <div class="btn btn-primary" style="width: 45px; height: 45px;">
                <span class="carousel-control-next-icon mb-n2"></span>
            </div>
        </a>
    </div>
</div>
<!-- Carousel End -->


<!-- About Start -->
<div class="container-fluid bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="d-flex flex-column align-items-center justify-content-center bg-primary h-100 py-5 px-3">
                    <i class="flaticon-brickwall display-1 font-weight-normal text-secondary mb-3"></i>
                    <!-- <h4 class="display-3 mb-3">2+</h4>
                    <h1 class="m-0">Years Experience</h1> -->
                </div>
            </div>
            <div class="col-lg-7 m-0 my-lg-5 pt-5 pb-5 pb-lg-2 pl-lg-5">
                <h6 class="text-primary font-weight-normal text-uppercase mb-3">Learn About Us</h6>
                <h1 class="mb-4 section-title">We Are The Best building ingredients provider In Your City</h1>
                <p><?php $sql = "SELECT * from info"; $result = mysqli_query($conn, $sql); $row = mysqli_fetch_assoc($result);
                echo $row['about']?></p>
                <div class="row py-2">

                    <!-- <div class="col-sm-6">
                        <div class="d-flex align-items-center mb-4">
                            <h1 class="flaticon-house font-weight-normal text-primary m-0 mr-3"></h1>
                            <h5 class="text-truncate m-0">Project Planning</h5>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="d-flex align-items-center mb-4">
                            <h1 class="flaticon-stairs font-weight-normal text-primary m-0 mr-3"></h1>
                            <h5 class="text-truncate m-0">Exterior & Interior</h5>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center mb-4">
                            <h1 class="flaticon-office font-weight-normal text-primary m-0 mr-3"></h1>
                            <h5 class="text-truncate m-0">Commercial Design</h5>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center mb-4">
                            <h1 class="flaticon-living-room font-weight-normal text-primary m-0 mr-3"></h1>
                            <h5 class="text-truncate m-0">Residential Design</h5>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About End -->


<!-- Services Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-6 pr-lg-5">
                <h6 class="text-primary font-weight-normal text-uppercase mb-3">Our Awesome Services</h6>
                <h1 class="mb-4 section-title">The Best Materials For Your House</h1>
            </div>
            <div class="col-lg-6 p-0 pt-5 pt-lg-0">
                <div class="owl-carousel service-carousel position-relative">
                    <?php
                        $sql = "SELECT * from service";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {?>
                    <div class="d-flex flex-column text-center bg-light mx-3 p-4">
                        <h3 class="flaticon-office display-3 font-weight-normal text-primary mb-3"></h3>
                        <h5 class="mb-3"><?php echo $row['title']?></h5>
                        <p class="m-0"><?php echo $row['description']?></p>
                    </div>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Services End -->

<!-- Projects Start -->
<div class="container-fluid pb-5">
    <div class="container pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col text-center mb-4">
                <h6 class="text-primary font-weight-normal text-uppercase mb-3">Our Projects</h6>
                <h1 class="mb-4">Some Of Our Awesome Projects</h1>
            </div>
        </div>
        <div class="d-flex flex-wrap justify-content-center align-items-center mx-1 ">

            <?php
                $sql = "SELECT * from project";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {?>

            <div class=" portfolio-item first m-2">
                <div class="position-relative overflow-hidden">
                    <div class="portfolio-img d-flex align-items-center justify-content-center"
                        style="height: 10rem; width: 15rem; overflow: hidden;">
                        <img class="img-fluid w-100 h-100" src="image/project/<?php echo $row['id']?>.webp" alt="">
                    </div>
                    <div
                        class="portfolio-text bg-secondary d-flex flex-column align-items-center justify-content-center">
                        <h4 class="text-white mb-4"><?php echo $row['name']?></h4>
                        <div class="d-flex align-items-center justify-content-center">
                            <a class="btn btn-primary" href="project.php?id=<?php echo $row['id']?>"><i
                                    class="fa fa-link"> Details</i></a>

                            <a class="btn btn-outline-primary m-1" href="image/project/<?php echo $row['id']?>.webp"
                                data-lightbox="portfolio">
                                <i class="fa fa-eye"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php }?>
        </div>
    </div>
</div>
<!-- Projects End -->


<!-- Team Start -->
<div class="container-fluid bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-6">
                <div class="py-5 px-4 h-100 bg-primary d-flex flex-column align-items-center justify-content-center">
                    <h6 class="text-white font-weight-normal text-uppercase mb-3">Our Team</h6>
                    <h1 class="mb-0 text-center">Meet Our Team Members</h1>
                </div>
            </div>
            <div class="col-md-8 col-sm-6 p-0 py-sm-5">
                <div class="owl-carousel team-carousel position-relative p-0 py-sm-5">

                    <?php
                $sql = "SELECT * from team";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {?>
                    <div class="team d-flex flex-column text-center mx-3">
                        <div class="position-relative">
                            <img class="img-fluid w-100" src="image/team/<?php echo $row['id']?>.webp" alt="img">
                        </div>
                        <div class="d-flex flex-column bg-secondary text-center py-3">
                            <h5 class="text-white"><?php echo $row['name']?></h5>
                            <p class="m-0"><?php echo $row['title']?></p>
                        </div>
                    </div>
                    <?php }?>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Team End -->


<!-- Blog Start -->
<div class="container-fluid bg-light pt-5">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col text-center mb-4">
                <h6 class="text-primary font-weight-normal text-uppercase mb-3">Our Blog</h6>
                <h1 class="mb-4">Read The Latest Blogs</h1>
            </div>
        </div>
        <div class="row pb-3">

            <?php
            $i = 1;
            $sql = "SELECT * from blog";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {?>
            <div class="col-md-4 mb-4">
                <div class="card border-0 mb-2">
                    <img class="card-img-top" src="image/blog/<?php echo $row['id']?>.webp" alt="">
                    <div class="card-body bg-white p-4">
                        <div class="d-flex flex-column mb-3">
                            <h5 class="text-truncate"><?php echo $row['title']?></h5>
                            <a class="btn btn-primary" href="blog.php?id=<?php echo $row['id']?>"><i class="fa fa-link">
                                    Details</i></a>
                        </div>
                        <div class="d-flex">
                            <small class="mr-3"><i class="fa fa-calendar-alt text-primary"></i>Date:
                                <?php echo $row['date']?></small>
                        </div>
                    </div>
                </div>
            </div>
            <?php }?>
        </div>
    </div>
</div>
<!-- Blog End -->

<?php include 'footer.php';?>