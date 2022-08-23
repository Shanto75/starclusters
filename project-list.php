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

if (isset($_GET['deleteimg'])) {
   
    $sno = $_GET['deleteimg'];

    if(file_exists('./image/project/'.$sno.'.webp')){
        unlink('./image/project/'.$sno.'.webp');
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
        $location = "./image/project/".$id.".webp";
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
    $sql = "DELETE FROM `project` WHERE `id` = '$sno'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $success = "Deleted successfully.";
    }
    else{
        $alert = "Could not Delete the Information successfully.";
    }
}

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['snoEdit'])) {
        $id = $_POST["id"];
        $name = $_POST['name'];
        $des = $_POST['des'];
        $time = $_POST['time'];

        $sql = "UPDATE project set `name` = '$name', `description` = '$des' , `time` = '$time' where `project`.`id` = '$id'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $success = "Information Updated Successfully !!";
        } else {
            $alert = "Could not update the Information successfully !!";
        }
    }

    
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add']) ) {
    
        $name = $_POST['name'];
        $des = $_POST['des'];
        $time = $_POST['time'];

        $sql = "INSERT INTO `project` set `name` = '$name', `description` = '$des' , `time` = '$time'";
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
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class=" mx-auto p-5 " action="project-list.php" method="post">
                <h1 class="text-center pb-4">Update Project Information</h1>
                <input type="hidden" name="snoEdit" id="snoEdit">
                <div class="mb-3">
                    <label class="form-label">ID</label>
                    <input type="number" class="form-control" name="id" id="editid" required readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Project Name</label>
                    <input type="text" class="form-control" name="name" id="editname" required>
                </div>


                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" name="des" id="editdes" rows="6"></textarea required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Time</label>
                    <input type="text" class="form-control" name="time" id="edittime" required>
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
            <form class=" mx-auto p-5 " action="project-list.php" method="post">
                <h1 class="text-center pb-4">Add New Project</h1>
                <input type="hidden" name="add" id="add" value="add">

                <div class="mb-3">
                    <label class="form-label">Project Name</label>
                    <input type="text" class="form-control" name="name" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" name="des" rows="6"></textarea required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Time</label>
                    <input type="text" class="form-control" name="time" required>
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
            <form class=" mx-auto p-5" action="project-list.php" method="post" enctype="multipart/form-data">
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
    <h1 class="text-center mt-3">Project List</h1>
    <button id="add-project" class="float-end mb-5 py-2 btn btn-sm btn-outline-primary"> <i
            class="bi bi-person-plus-fill pe-2"></i>Add New Project</button>

    <table id="table" class="table table-bordered table-hover table-sm text-sm">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Project Name</th>
                <th>Description</th>
                <th>Time</th>
                <th>Photo</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $sql = "SELECT * from project";
                $result = mysqli_query($conn, $sql);
               while($row = mysqli_fetch_assoc($result)){
            ?>
            <tr>
                <td><?php echo $row['id']?></td>
                <td><?php echo $row['name']?></td>
                <td class="text-break"><?php echo $row['description']?></td>
                <td class="text-break"><?php echo $row['time']?></td>
                <td>
                    <?php
                    $location="./image/project/". $row['id'].".webp";
                    if(file_exists($location)){?>
                        <img class="p-2" style="width: 10rem;" src=<?php echo $location;?> />
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
        des = tr.getElementsByTagName("td")[2].innerText;
        time = tr.getElementsByTagName("td")[3].innerText;

        editid.value = id;
        editname.value = name;
        editdes.value = des;
        edittime.value = time;
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
            window.location = `project-list.php?delete=${sno}`;
        }
    })
})

document.getElementById("add-project").addEventListener("click", function() {
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

        if (confirm("Are you sure you want to Delete this!")) {
            window.location = `project-list.php?deleteimg=${sno}`;
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