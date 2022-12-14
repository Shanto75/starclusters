<?php include "./db.php"?>
<?php include 'header.php'; include 'navbar.php';?>

<!-- Page Header Start -->
<div class="container-fluid bg-secondary py-5">
    <div class="container py-5">
        <div class="row align-items-center py-4">
            <div class="col-md-6 text-center text-md-left">
                <h1 class="mb-4 mb-md-0 text-primary text-uppercase">About Us</h1>
            </div>
            <div class="col-md-6 text-center text-md-right">
                <div class="d-inline-flex align-items-center">
                    <a class="btn btn-outline-primary" href="index.php">Home</a>
                    <i class="fas fa-angle-double-right text-primary mx-2"></i>
                    <a class="btn btn-outline-primary disabled" href="">About Us</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page Header Start -->

<!-- About Start -->
<div class="container-fluid bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="d-flex flex-column align-items-center justify-content-center bg-primary h-100 py-5 px-3">
                    <i class="flaticon-brickwall display-1 font-weight-normal text-secondary mb-3"></i>
                    <!-- <h4 class="display-3 mb-3">5+</h4>
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

<?php include 'footer.php';?>