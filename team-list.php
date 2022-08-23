<?php include "session.php"?>
<?php include "./db.php"?>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
<?php
$success = false;
$alert = false;
 
    if (isset($_GET['delete'])) {
   
        $sno = $_GET['delete'];
        $sql = "DELETE FROM `team` WHERE `id` = '$sno'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $success = "Deleted successfully.";
        }
        else{
            $alert = "Could not Delete the Information successfully.";
        }
    }

    if (isset($_GET['deleteimg'])) {
   
        $sno = $_GET['deleteimg'];
        if(file_exists('./image/team/'.$sno.'.webp')){
            unlink('./image/team/'.$sno.'.webp');
            $success = "Deleted successfully.";
        }
        else{
            $alert = "Could not Delete successfully.";
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['snoEdit'])) {
        
        $id = $_POST["id"];
        $name = $_POST['name'];
        $title = $_POST['title'];
        $email = $_POST['email'];
        $address = $_POST["address"];
        $phone = $_POST['phone'];
        $about = $_POST['about'];

        $sql = "UPDATE team set `name` = '$name', `title` = '$title', `email` = '$email', `address` = '$address', `phone` = '$phone', `about` = '$about' where `team`.`id` = '$id'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $success = "Information Updated Successfully !!";
        } else {
            $alert = "Could not update the Information successfully !!";
        }
    }

    
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add']) ) {

        $name = $_POST['name'];
        $title = $_POST['title'];
        $email = $_POST['email'];
        $address = $_POST["address"];
        $phone = $_POST['phone'];
        $about = $_POST['about'];

        $sql = "INSERT INTO team set `name` = '$name', `title` = '$title', `email` = '$email', `address` = '$address', `phone` = '$phone', `about` = '$about'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $success = "Information Added Successfully !!";
        } else {
            $alert = "Could not Added the Information successfully !!";
        }
    }


    if(isset($_POST['addphoto']) && !empty($_FILES["img"]["name"]) ){

        // Get file info 
        $id = $_POST['addphoto'];
        $allowTypes = array('jpg','png','jpeg','gif'); 

        $fileName = basename($_FILES["img"]["name"]);
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

        if(in_array($fileType, $allowTypes)){
            $image = $_FILES['img']['tmp_name'];
            $location = "./image/team/".$id.".webp";
            $img = '';
            if($fileType == 'jpg' || $fileType == 'jpeg'){
                $img = imagecreatefromjpeg($image);
            }
            elseif($fileType == 'png'){
                $img = imagecreatefrompng($image);
            }
            imagepalettetotruecolor($img);
            imagealphablending($img, true);
            imagesavealpha($img, true);

            imagewebp($img, $location, 50 );
            imagedestroy($img);
            
            if(file_exists($location)){
                $success = "Photo Added Successfully !!";
            }
            else{
                $alert = "Could not Added the Photo successfully !!";
            }
        }else{
            $alert = "Could not Added the Photo successfully !!";
        }
    }
?>

<?php include "./admin-header.php";  include "./success-alert.php";  include "./error-alert.php"; ?>
<!-- Edit Modal -->
<div class="modal fade mx-auto" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class=" mx-auto p-5 " action="team-list.php" method="post">
                <h1 class="text-center pb-4">Update Information</h1>
                <input type="hidden" name="snoEdit" id="snoEdit">
                <div class="mb-3">
                    <label class="form-label">ID</label>
                    <input type="number" class="form-control" name="id" id="editid" required readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">team Name</label>
                    <input type="text" class="form-control" name="name" id="editname" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" id="edittitle" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="editemail" aria-describedby="emailHelp"
                        required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <input type="text" class="form-control" name="address" id="editaddress" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Phone</label>
                    <input type="text" class="form-control" name="phone" id="editphone" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">About</label>
                    <textarea class="form-control" name="about" id="editabout" rows="6"></textarea required>
                </div>
                <div class="d-flex align-items-center justify-content-center ">
                    <button type="submit" class="py-3 mt-4 px-5 btn btn-outline-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- addmodal -->
<div class="modal fade mx-auto" id="addModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class=" mx-auto p-5 " action="team-list.php" method="post">
                <h1 class="text-center pb-4">Add New Member</h1>
                <input type="hidden" name="add" id="add" value="add">

                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" aria-describedby="emailHelp" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <input type="text" class="form-control" name="address" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Phone</label>
                    <input type="text" class="form-control" name="phone" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">About</label>
                    <textarea class="form-control" name="about" rows="6"></textarea required>
                </div>

                <div class="d-flex align-items-center justify-content-center ">
                    <button type="submit" class="py-3 mt-4 px-5 btn btn-outline-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--add img modal -->
<div class="modal fade mx-auto" id="imgmodal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class=" mx-auto p-5" action="team-list.php" method="post" enctype="multipart/form-data">
                <h5 class="text-center">Upload Image</h5>
                <input type="hidden" name="addphoto" id="addphoto">
                <div class="mb-3">
                    <label for="menu" class="form-label">Image</label>
                    <input type="file" class="form-control" name="img" id="img" required>
                </div>
                <div class="d-flex align-items-center justify-content-center ">
                    <button type="submit" class="py-3 mt-4 px-5 btn btn-outline-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="container overflow-auto">
    <h1 class="text-center mt-3">Team Member List</h1>
    <button id="add-team" class="float-end mb-5 py-2 btn btn-sm btn-outline-primary"> <i
            class="bi bi-person-plus-fill pe-2"></i>Add New Member</button>

    <table id="table" class="table table-bordered table-hover table-sm text-sm">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th class="text-break">Member Name</th>
                <th class="text-break">Title</th>
                <th class="text-break">Email</th>
                <th class="text-break">Address</th>
                <th>Phone</th>
                <th class="text-break">About</th>
                <th>Photo</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $sql = "SELECT * from team";
                $result = mysqli_query($conn, $sql);
               while($row = mysqli_fetch_assoc($result)){
            ?>
            <tr>
                <td><?php echo $row['id']?></td>
                <td ><?php echo $row['name']?></td>
                <td><?php echo $row['title']?></td>
                <td><?php echo $row['email']?></td>
                <td><?php echo $row['address']?></td>
                <td><?php echo $row['phone']?></td>
                <td><?php echo $row['about']?></td>
                <td>
                    <?php
                    $location="./image/team/". $row['id'].".webp";
                    if(file_exists($location)){?>
                        <img class="py-2" style="width: 10rem;" src=<?php echo $location;?> />
                    <?php } ?>
                    <button class="addimg bi bi-images btn btn-sm btn-outline-primary"></button>
                    <?php
                    if(file_exists($location)){?>
                        <button class="deleteimg bi bi-trash btn btn-sm btn-outline-danger"></button>
                    <?php } ?>
                </td>
                <td>
                    <button class="update bi bi-pencil-square btn btn-sm btn-outline-primary"></button>
                    <button class="delete bi bi-trash btn btn-sm btn-outline-danger"></button>
                </td>
            </tr>
            <?php }?>
        </tbody>
    </table>
</div>

<script>
updates = document.getElementsByClassName('update');
Array.from(updates).forEach((element) => {
    element.addEventListener("click", (e) => {
        tr = e.target.parentNode.parentNode;

        id = tr.getElementsByTagName("td")[0].innerText;
        name = tr.getElementsByTagName("td")[1].innerText;
        title = tr.getElementsByTagName("td")[2].innerText;
        email = tr.getElementsByTagName("td")[3].innerText;
        address = tr.getElementsByTagName("td")[4].innerText;
        phone = tr.getElementsByTagName("td")[5].innerText;
        about = tr.getElementsByTagName("td")[6].innerText;

        editid.value = id;
        editname.value = name;
        edittitle.value = title;
        editemail.value = email;
        editaddress.value = address;
        editphone.value = phone;
        editabout.value = about;

        snoEdit.value = id;

        $('#editModal').modal('toggle');
    })
})

deletes = document.getElementsByClassName('delete');
Array.from(deletes).forEach((element) => {
    element.addEventListener("click", (e) => {

        tr = e.target.parentNode.parentNode;
        sno = tr.getElementsByTagName("td")[0].innerText;

        if (confirm("Are you sure you want to Delete this!")) {
            window.location = `team-list.php?delete=${sno}`;
        }
    })
})

deleteimgs = document.getElementsByClassName('deleteimg');
Array.from(deleteimgs).forEach((element) => {
    element.addEventListener("click", (e) => {

        tr = e.target.parentNode.parentNode;
        sno = tr.getElementsByTagName("td")[0].innerText;

        if (confirm("Are you sure you want to Delete this!")) {
            window.location = `team-list.php?deleteimg=${sno}`;
        }
    })
})

document.getElementById("add-team").addEventListener("click", function() {
    $('#addModal').modal('toggle');
});

addimgs = document.getElementsByClassName('addimg');
Array.from(addimgs).forEach((element) => {
    element.addEventListener("click", (e) => {

        tr = e.target.parentNode.parentNode;
        id = tr.getElementsByTagName("td")[0].innerText;
        addphoto.value = id;
        
        $('#imgmodal').modal('toggle');
    })
})
</script>

<?php include "./admin-footer.php" ?>
<script>
$(document).ready(function() {
    $('#table').DataTable();
});
</script>