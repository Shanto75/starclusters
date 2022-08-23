<?php include "./db.php"?>
<?php include 'header.php'; include 'navbar.php';?>

<!-- Page Header Start -->
<div class="container-fluid bg-secondary py-5">
    <div class="container py-5">
        <div class="row align-items-center py-4">
            <div class="col-md-6 text-center text-md-left">
                <h1 class="mb-4 mb-md-0 text-primary text-uppercase">Our Projects</h1>
            </div>
            <div class="col-md-6 text-center text-md-right">
                <div class="d-inline-flex align-items-center">
                    <a class="btn btn-outline-primary" href="index.php">Home</a>
                    <i class="fas fa-angle-double-right text-primary mx-2"></i>
                    <a class="btn btn-outline-primary disabled" href="">Our Projects</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page Header Start -->

<div id="projectdetails" class=" pt-5 px-3 d-none mx-auto">
    <div class="d-flex justify-contect-center align-items-center">
        <div class="col-lg-8 mx-auto">
            <div class="d-flex flex-column text-left mb-4">
                <h6 class="text-primary font-weight-normal text-uppercase mb-3">Project Details</h6>
                <h1 id="name" class="mb-4 section-title"></h1>
                <div>
                    <i class="fa fa-calendar-alt text-primary"></i><span id="date" class="mr-3"> Date:</span>
                </div>
            </div>
    
            <div class="">
                <img id="projectimg" class="img-fluid w-100" src="" alt="Image">
                <p id="details" class="text-justify py-4"></p>
            </div>
        </div>
    </div>
</div>

<!-- Projects Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col text-center mb-4">
                <h6 class="text-primary font-weight-normal text-uppercase mb-3">Our Projects</h6>
                <h1 class="mb-4">Some Of Our Awesome Projects</h1>
            </div>
        </div>
        <div class="d-flex flex-wrap mx-1 portfolio-container">

            <?php
                $projectinfo = array();
                $sql = "SELECT * from project";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    $project = array("id"=> $row['id'], "name"=>$row['name'], "description"=>$row['description'], "time"=>$row['time']);
                    array_push($projectinfo, $project);
            ?>

            <div class=" portfolio-item first m-2">
                <div class="position-relative overflow-hidden">
                    <div class="portfolio-img d-flex align-items-center justify-content-center"
                        style="height: 10rem; height: 10rem; overflow: hidden;">
                        <img class="img-fluid w-100 h-100" src="image/project/<?php echo $row['id']?>.webp" alt="image">
                    </div>
                    <div
                        class="portfolio-text bg-secondary d-flex flex-column align-items-center justify-content-center">
                        <h4 class="text-white mb-4"><?php echo $row['name']?></h4>
                        <div class="d-flex align-items-center justify-content-center">
                            <button onclick="seedetails(this.id)" id="<?php echo $row['id']?>"
                                class="btn btn-outline-primary m-1">
                                <i class="fa fa-link"></i> Details
                            </button>
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

<script>
if (window.location.href.indexOf("id") > -1) {
    var baseUrl = (window.location).href;
    var id = baseUrl.substring(baseUrl.lastIndexOf('=') + 1);
    console.log(id)
    seedetails(id)
}

function seedetails(id) {
    <?php $info = json_encode($projectinfo);
    echo "var projectinfo = ". $info . ";\n";
    ?>

    var blog = projectinfo.filter(record => record.id === id);
    document.getElementById("projectdetails").classList.remove("d-none");

    document.getElementById('name').innerText = blog[0]['name'];
    document.getElementById('details').innerText = blog[0]['description'];
    document.getElementById('date').innerText = ' Date: ' + blog[0]['time'];
    document.getElementById('projectimg').src = "image/project/" + id + ".webp";

    // console.log(blog[0]['title']);
    location.href = "#projectdetails";
}
</script>

<?php include 'footer.php';?>