<?php include "./db.php"?>
<?php include 'header.php'; include 'navbar.php';?>

<?php
$success = false;
$alert = false;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        extract($_POST);
        $data = '';
        foreach($_POST as $k => $v){
			if(!is_numeric($k)){
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
    
        $sql = "INSERT INTO message set $data";
        $result = mysqli_query($conn, $sql);
    
        if ($result) {
            $success = "Thank you for your message. We shall contact you soon.";
        } else {
            $alert = "Could not sent the message successfully !!";
        }
    }

?>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
<!-- Page Header Start -->
<div class="container-fluid bg-secondary py-5">
    <div class="container py-5">
        <div class="row align-items-center py-4">
            <div class="col-md-6 text-center text-md-left">
                <h1 class="mb-4 mb-md-0 text-primary text-uppercase">Contact Us</h1>
            </div>
            <div class="col-md-6 text-center text-md-right">
                <div class="d-inline-flex align-items-center">
                    <a class="btn btn-outline-primary" href="index.php">Home</a>
                    <i class="fas fa-angle-double-right text-primary mx-2"></i>
                    <a class="btn btn-outline-primary disabled" href="">Contact Us</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page Header Start -->

<!-- Contact Start -->
<div class="container-fluid bg-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="d-flex flex-column justify-content-center bg-primary h-100 p-5">

                    <?php
                    $sql = "SELECT * from info";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                ?>

                    <div class="d-inline-flex border border-secondary p-4 mb-4">
                        <h1 class="flaticon-office font-weight-normal text-secondary m-0 mr-3"></h1>
                        <div class="d-flex flex-column">
                            <h4>Our Office</h4>
                            <p class="m-0 text-white"><?php echo $row['address']?></p>
                        </div>
                    </div>
                    <div class="d-inline-flex border border-secondary p-4 mb-4">
                        <h1 class="flaticon-email font-weight-normal text-secondary m-0 mr-3"></h1>
                        <div class="d-flex flex-column">
                            <h4>Email Us</h4>
                            <p class="m-0 text-white"><?php echo $row['email']?></p>
                        </div>
                    </div>
                    <div class="d-inline-flex border border-secondary p-4">
                        <h1 class="flaticon-telephone font-weight-normal text-secondary m-0 mr-3"></h1>
                        <div class="d-flex flex-column">
                            <h4>Call Us</h4>
                            <p class="m-0 text-white"><?php echo $row['phone']?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 mb-5 my-lg-5 py-5 pl-lg-5">
                <div class="contact-form">
                    <div id="messagealert">
                        <?php if($success){?>
                        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                            <strong class="text-center"><?php echo $success;?></strong>
                            <button type="button" class="btn" data-bs-dismiss="alert" aria-label="Close">x</button>
                        </div><?php } ?>
                        <?php if($alert){?>
                        <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                            <strong class="text-center"><?php echo $alert;?></strong>
                            <button type="button" class="btn" data-bs-dismiss="alert" aria-label="Close">x</button>
                        </div><?php } ?>
                    </div>
                    <h2 class="text-center p-4">Enter your Details</h2>
                    <form action="contact.php" method="post">
                        <div class="control-group">
                            <input type="text" class="form-control p-4" id="name" name="name" placeholder="Your Name"
                                required="required" data-validation-required-message="Please enter your name" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="email" class="form-control p-4" id="email" name="email"
                                placeholder="Your Email" required="required"
                                data-validation-required-message="Please enter your email" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="text" class="form-control p-4" id="phone" name="phone" placeholder="phone"
                                required="required" data-validation-required-message="Please enter your phone number" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <textarea class="form-control p-4" rows="6" id="message" name="message"
                                placeholder="Message" required="required"
                                data-validation-required-message="Please enter your message"></textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div>
                            <button class="btn btn-primary py-3 px-5" type="submit" id="sendMessageButton">Send
                                Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->

<script>
setTimeout(function() {
    document.getElementById('messagealert').remove();
}, 10000);
</script>
<?php include 'footer.php';?>