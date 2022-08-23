<?php include "./db.php"?>
<?php include 'header.php'; include 'navbar.php';?>
<!-- Page Header Start -->
<div class="container-fluid bg-secondary py-5">
    <div class="container py-5">
        <div class="row align-items-center py-4">
            <div class="col-md-6 text-center text-md-left">
                <h1 class="mb-4 mb-md-0 text-primary text-uppercase">Our Blog</h1>
            </div>
            <div class="col-md-6 text-center text-md-right">
                <div class="d-inline-flex align-items-center">
                    <a class="btn btn-outline-primary" href="">Home</a>
                    <i class="fas fa-angle-double-right text-primary mx-2"></i>
                    <a class="btn btn-outline-primary disabled" href="">Our Blog</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page Header Start -->


<div class="container py-5">

    <!-- Detail Start -->
    <div id="blogdetails" class="row pt-5 d-none">
        <div class="d-flex justify-contect-center align-items-center">
            <div class="col-lg-8 mx-auto">
                <div class="d-flex flex-column text-left mb-4">
                    <h6 class="text-primary font-weight-normal text-uppercase mb-3">Blog Details</h6>
                    <h1 id="title" class="mb-4 section-title"></h1>
                    <div>
                        <i class="fa fa-calendar-alt text-primary"></i><span id="date" class="mr-3"> Date:</span>
                    </div>
                </div>
                <div class="mb-5">
                    <img id="blogimg" class="img-fluid w-100 mb-4" src="" alt="Image">
                    <p id="details" class="text-justify"></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Detail End -->



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
                
                $bloginfo = array();
                
                $sql = "SELECT * from blog";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    $i = $row['id'];
                    $blog = array("id"=> $row['id'], "title"=>$row['title'], "details"=>$row['details'], "date"=>$row['date']);
                    array_push($bloginfo, $blog);
                ?>
                <div class="col-md-4 mb-4">
                    <div class="card border-0 mb-2">
                        <img class="card-img-top" src="image/blog/<?php echo $i;?>.webp" alt="image">
                        <div class="card-body bg-white p-4">
                            <div class="d-flex flex-column mb-3">
                                <h5 class="text-truncate"><?php echo $row['title']?></h5>
                                <small class="mb-2"><i class="fa fa-calendar-alt text-primary"></i> Date:
                                    <?php echo $row['date']?></small>
                                <button onclick="seedetails(this.id)" class="mb-2 btn btn-primary"
                                    id="<?php echo $row['id']?>"><i class="fa fa-link"> Details</i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php }?>
            </div>
        </div>
    </div>

</div>
<!-- Blog End -->

<script>
if (window.location.href.indexOf("id") > -1) {
    var baseUrl = (window.location).href;
    var id = baseUrl.substring(baseUrl.lastIndexOf('=') + 1);
    console.log(id)
    seedetails(id)
}

function seedetails(id) {
    <?php $info = json_encode($bloginfo);
    echo "var bloginfo = ". $info . ";\n";
    
    ?>

    var blog = bloginfo.filter(record => record.id === id);
    document.getElementById("blogdetails").classList.remove("d-none");

    document.getElementById('title').innerText = blog[0]['title'];
    document.getElementById('details').innerText = blog[0]['details'];
    document.getElementById('date').innerText = ' Date: ' + blog[0]['date'];
    document.getElementById('blogimg').src = "image/blog/" + id + ".webp";

    // console.log(blog[0]['title']);
    location.href = "#blogdetails";
}
</script>

<?php include 'footer.php';?>