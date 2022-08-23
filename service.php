<?php include "./db.php"?>
<?php include 'header.php'; include 'navbar.php';?>


<!-- Page Header Start -->
<div class="container-fluid bg-secondary py-5">
    <div class="container py-5">
        <div class="row align-items-center py-4">
            <div class="col-md-6 text-center text-md-left">
                <h1 class="mb-4 mb-md-0 text-primary text-uppercase">Our Services</h1>
            </div>
            <div class="col-md-6 text-center text-md-right">
                <div class="d-inline-flex align-items-center">
                    <a class="btn btn-outline-primary" href="index.php">Home</a>
                    <i class="fas fa-angle-double-right text-primary mx-2"></i>
                    <a class="btn btn-outline-primary disabled" href="">Our Services</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page Header Start -->


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


<?php include 'footer.php';?>