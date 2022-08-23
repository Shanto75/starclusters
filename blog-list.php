<?php include "session.php"?>
<?php include "./db.php"?>
<script>
if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}
</script>
<?php
$success = false;
$alert = false;


if (isset($_GET['deleteimg'])) {
   
    $sno = $_GET['deleteimg'];

    if(file_exists('./image/blog/'.$sno.'.webp')){
        unlink('./image/blog/'.$sno.'.webp');
        $success = "Deleted successfully.";
    }
    else{
        $alert = "Could not Delete successfully.";
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
        $location = "./image/blog/".$id.".webp";
        
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


    if (isset($_GET['delete'])) {

            $sno = $_GET['delete'];
            $sql = "DELETE FROM `blog` WHERE `id` = '$sno'";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $success = "Deleted successfully.";
            }
            else{
                $success = "Could not Delete the Information successfully.";
            }
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['snoEdit'])) {
            // Update the record

            $id = $_POST["id"];
            $title = $_POST['title'];
            $details = $_POST['details'];
            
            // Sql query to be executed
            $sql = "UPDATE `blog` SET `title` = '$title', `details` = '$details' WHERE `blog`.`id` = '$id'";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $success = "Information Updated Successfully !!";
            } else {
                $alert = "Could not update the Information successfully !!";
            }
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addblog']) ) {

        $title = $_POST['title'];
        $details = $_POST['details'];
    
        $sql = "INSERT INTO `blog`(`title`, `details`) VALUES ('$title', '$details')";
            $result = mysqli_query($conn, $sql);
    
            if ($result) {
                $success = "Information Added Successfully !!";
            } else {
                $alert = "Could not Added the Information successfully !!";
            }
    }

?>

<?php include "./admin-header.php";  include "./success-alert.php";  include "./error-alert.php"; ?>
<!-- Edit Modal -->

<div class="modal fade mx-auto" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="mx-auto p-5" action="blog-list.php" method="post">
                <h1 class="text-center py-2">Edit Information</h1>
                <hr>
                <input type="hidden" name="snoEdit" id="snoEdit">
                <div class="mb-3">
                    <label class="form-label">ID</label>
                    <input type="number" class="form-control" name="id" id="editid" required readonly>
                </div>

                <div class="form-floating pb-4">
                    <textarea class="form-control" placeholder="Leave a comment here" name="title" id="edittitle"
                        style="height: 100px;"></textarea>
                    <label for="title">Title</label>
                </div>

                <div class="form-floating">
                    <textarea class="form-control" placeholder="Leave a comment here" name="details" id="editdetails"
                        style="height: 100px"></textarea>
                    <label for="details">Details</label>
                </div>

                <div class="d-flex align-items-center justify-content-center ">
                    <button type="submit" class="py-3 mt-4 px-5 btn btn-outline-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--add img modal -->
<div class="modal fade mx-auto" id="imgmodal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class=" mx-auto p-5" action="blog-list.php" method="post" enctype="multipart/form-data">
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

<div class="modal fade mx-auto" id="addModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="mx-auto p-5" action="blog-list.php" method="post">
                <h1 class="text-center py-2">Add Blog</h1>
                <hr>
                <input type="hidden" name="addblog" id="addblog" value="addblog">

                <div class="form-floating pb-4">
                    <textarea class="form-control" placeholder="Leave a comment here" name="title" id="title"
                        style="height: 100px;"></textarea>
                    <label for="title">Title</label>
                </div>

                <div class="form-floating">
                    <textarea class="form-control" placeholder="Leave a comment here" name="details" id="details"
                        style="height: 100px"></textarea>
                    <label for="details">Details</label>
                </div>

                <div class="d-flex align-items-center justify-content-center ">
                    <button type="submit" class="py-3 mt-4 px-5 btn btn-outline-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container">
    <h1 class="text-center p-2 ">Blog List</h1>

    <button id="add" class="float-end mb-5 py-2 btn btn-sm btn-outline-primary"> <i
            class="bi bi-person-plus-fill pe-2"></i>Add New Blog</button>

    <table id="table" class="table table-bordered table-sm text-sm table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Details</th>
                <th>Date and Time </th>
                <th>Photo </th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $sql = "SELECT * from blog";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
            <tr>
                <td><?php echo $row['id']?></td>
                <td class="text-break"><?php echo $row['title']?></td>
                <td class="text-break"><?php echo $row['details']?></td>
                <td><?php echo $row['date']?></td>
                <td>
                    <?php
                    if(file_exists("./image/blog/". $row['id'].".webp")){?>
                    <img class="p-2" style="width: 10rem;" src='./image/blog/<?php echo $row['id'];?>.webp' />
                    <?php } ?>
                    <button class="addimg bi bi-images btn btn-sm btn-outline-primary"></button>
                    <?php
                    if(file_exists("./image/blog/". $row['id'].".webp")){?>
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
        title = tr.getElementsByTagName("td")[1].innerText;
        details = tr.getElementsByTagName("td")[2].innerText;

        editid.value = id;
        edittitle.value = title;
        editdetails.value = details;
        snoEdit.value = e.target.id;

        $('#editModal').modal('toggle');
    })
})

deletes = document.getElementsByClassName('delete');
Array.from(deletes).forEach((element) => {
    element.addEventListener("click", (e) => {

        tr = e.target.parentNode.parentNode;
        sno = tr.getElementsByTagName("td")[0].innerText;

        if (confirm("Are you sure you want to Delete this!")) {
            window.location = `blog-list.php?delete=${sno}`;
        }
    })
})

document.getElementById("add").addEventListener("click", function() {
    $('#addModal').modal('toggle');
});

// add img
addimgs = document.getElementsByClassName('addimg');
Array.from(addimgs).forEach((element) => {
    element.addEventListener("click", (e) => {

        tr = e.target.parentNode.parentNode;
        id = tr.getElementsByTagName("td")[0].innerText;
        addphoto.value = id;

        $('#imgmodal').modal('toggle');
    })
})

deleteimgs = document.getElementsByClassName('deleteimg');
Array.from(deleteimgs).forEach((element) => {
    element.addEventListener("click", (e) => {

        tr = e.target.parentNode.parentNode;
        sno = tr.getElementsByTagName("td")[0].innerText;
        console.log(sno)
        if (confirm("Are you sure you want to Delete this!")) {
            window.location = `blog-list.php?deleteimg=${sno}`;
        }
    })
})
</script>
<?php include "./admin-footer.php" ?>
<script>
$(document).ready(function() {
    $('#table').DataTable();
});
</script>