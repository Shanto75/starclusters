<?php include "session.php"?>
<?php include "./db.php"?>
<?php
$success = false;
$alert = false;
    if (isset($_GET['delete'])) {
        
        $sql = "Select * from admin";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        if ($num != 1) {
            $sno = $_GET['delete'];
            $sql = "DELETE FROM `admin` WHERE `id` = '$sno'";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $success = "Admin Deleted successfully.";
            }
            else{
                $alert = "Could not Delete the Information successfully.";
            }
        }
        else{
            $alert = "Could not Delete the Information successfully";
        }

    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['snoEdit'])) {
            // Update the record

            $id = $_POST["id"];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $pass = $_POST['pass'];
            
            // Sql query to be executed
            $sql = "UPDATE `admin` SET `id` = '$id' , `email` = '$email', `name` = '$name' , `password` = '$pass' WHERE `admin`.`id` = '$id'";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $success = "Information Updated Successfully !!";
            } else {
                $alert = "Could not update the Information successfully !!";
            }
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addAdmin']) ) {

        $name = $_POST['name'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];
    
        // Sql query to be executed
        $sql = "Select * from admin where email = '$email' ";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        if ($num != 1) {
            $sql = "INSERT INTO `admin`(`name`, `email`, `password`) VALUES ('$name', '$email', '$pass')";
            $result = mysqli_query($conn, $sql);
    
            if ($result) {
                $success = "Information Added Successfully !!";
            } else {
                $alert = "Could not Added the Information successfully !!";
            }
        }
        else{
            $alert = "Could not Added the Information successfully. User Exist !!";
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
            <form class="mx-auto p-5" action="admin.php" method="post">
                <h1 class="text-center py-2">Edit Admin Information</h1>
                <hr>
                <input type="hidden" name="snoEdit" id="snoEdit">
                <div class="mb-3">
                    <label class="form-label">Admin ID</label>
                    <input type="number" class="form-control" name="id" id="editid" required readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" id="editname" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" name="email" id="editemail" aria-describedby="emailHelp"
                        required>
                </div>

                <div class="mb-3">
                    <label for="pass" class="form-label">Password</label>
                    <input type="password" class="form-control" name="pass" id="editpass" required>
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
            <form class="mx-auto p-5" action="admin.php" method="post">
                <h1 class="text-center py-2">Add Admin Information</h1>
                <hr>
                <input type="hidden" name="addAdmin" id="addAdmin" value="addAdmin">
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" name="email" aria-describedby="emailHelp" required>
                </div>

                <div class="mb-3">
                    <label for="pass" class="form-label">Password</label>
                    <input type="password" class="form-control" name="pass" required>
                </div>

                <div class="d-flex align-items-center justify-content-center ">
                    <button type="submit" class="py-3 mt-4 px-5 btn btn-outline-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container">
    <h1 class="text-center p-2 ">Admin Section</h1>

    <button id="add-admin" class="float-end mb-5 py-2 btn btn-sm btn-outline-primary"> <i
            class="bi bi-person-plus-fill pe-2"></i>Add New Admin</button>

    <table id="admintable" class="table table-bordered table-sm text-sm text-break ">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email Address</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $sql = "SELECT * from admin";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
            <tr>
                <td><?php echo $row['id']?></td>
                <td><?php echo $row['name']?></td>
                <td><?php echo $row['email']?></td>
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
        email = tr.getElementsByTagName("td")[2].innerText;

        editid.value = id;
        editname.value = name;
        editemail.value = email;
        snoEdit.value = e.target.id;

        $('#editModal').modal('toggle');
    })
})

deletes = document.getElementsByClassName('delete');
Array.from(deletes).forEach((element) => {
    element.addEventListener("click", (e) => {

        tr = e.target.parentNode.parentNode;
        sno = tr.getElementsByTagName("td")[0].innerText;

        if (confirm("Are you sure you want to Delete this Admin!")) {
            window.location = `admin.php?delete=${sno}`;
        }
    })
})

document.getElementById("add-admin").addEventListener("click", function() {
    $('#addModal').modal('toggle');
});
</script>
<?php include "./admin-footer.php" ?>
<script>
$(document).ready(function() {
    $('#admintable').DataTable();
});
</script>