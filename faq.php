<?php include "./db.php"?>
<?php include 'header.php'; include 'navbar.php';?>

<!-- Page Header Start -->
<div class="container-fluid bg-secondary py-5">
    <div class="container py-5">
        <div class="row align-items-center py-4">
            <div class="col-md-6 text-center text-md-left">
                <h1 class="mb-4 mb-md-0 text-primary text-uppercase">Questions and Answers</h1>
            </div>
            <div class="col-md-6 text-center text-md-right">
                <div class="d-inline-flex align-items-center">
                    <a class="btn btn-outline-primary" href="index.php">Home</a>
                    <i class="fas fa-angle-double-right text-primary mx-2"></i>
                    <a class="btn btn-outline-primary disabled" href="">FAQ</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page Header end -->

<!-- FAQ Start -->
<div class="container">
    <h1 class="text-center py-4">Commonly Asked Questions and Answers</h1>
    <div class="accordion pb-5" id="accordionPanelsStayOpenExample">
        <?php
            $i=1;
            $sql = "SELECT * from faq";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)){
        ?>
        <div class="accordion-item">
            <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                <button class="accordion-button btn btn-outline-primary w-100 text-left" type="button" data-bs-toggle="collapse"
                    data-bs-target="#panelsStayOpen-<?php echo $row['id']?>" aria-expanded="true"
                    aria-controls="panelsStayOpen-<?php echo $row['id']?>">
                       <h5><?php echo $i.'. '.$row['question']?></h5> 
                </button>
            </h2>
            <div id="panelsStayOpen-<?php echo $row['id']?>" class="accordion-collapse collapse"
                aria-labelledby="panelsStayOpen-headingOne">
                <div class="accordion-body">
                <p><i class="fa fa-angle-right text-warning mr-2"></i><?php echo $row['ans']?></p>
                </div>
            </div>
        </div>
        <?php $i++; }?>
    </div>

</div>
<!-- FAQ End -->

<?php include 'footer.php';?>