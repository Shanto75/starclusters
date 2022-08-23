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
            $sql = "DELETE FROM `faq` WHERE `id` = '$sno'";
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
            $question = $_POST['question'];
            $ans = $_POST['ans'];
            
            // Sql query to be executed
            $sql = "UPDATE `faq` SET `question` = '$question', `ans` = '$ans' WHERE `faq`.`id` = '$id'";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $success = "Information Updated Successfully !!";
            } else {
                $alert = "Could not update the Information successfully !!";
            }
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addfaq']) ) {

        $question = $_POST['question'];
        $ans = $_POST['answer'];
    
        $sql = "INSERT INTO `faq`(`question`, `ans`) VALUES ('$question', '$ans')";
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
            <form class="mx-auto p-5" action="faq-list.php" method="post">
                <h1 class="text-center py-2">Edit Information</h1>
                <hr>
                <input type="hidden" name="snoEdit" id="snoEdit">
                <div class="mb-3">
                    <label class="form-label">ID</label>
                    <input type="number" class="form-control" name="id" id="editid" required readonly>
                </div>
                <div class="form-floating pb-4">
                    <textarea class="form-control" placeholder="Leave a comment here" name="question" id="editquestion"
                        style="height: 100px;"></textarea>
                    <label for="question">Question</label>
                </div>

                <div class="form-floating">
                    <textarea class="form-control" placeholder="Leave a comment here" name="ans" id="editans"
                        style="height: 100px"></textarea>
                    <label for="ans">Answer</label>
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
            <form class="mx-auto p-5" action="faq-list.php" method="post">
                <h1 class="text-center py-2">Add FAQ</h1>
                <hr>
                <input type="hidden" name="addfaq" id="addfaq" value="addfaq">

                <div class="form-floating pb-4">
                    <textarea class="form-control" placeholder="Leave a comment here" name="question" id="question"
                        style="height: 100px;"></textarea>
                    <label for="question">Question</label>
                </div>

                <div class="form-floating">
                    <textarea class="form-control" placeholder="Leave a comment here" name="answer" id="answer"
                        style="height: 100px"></textarea>
                    <label for="answer">Answer</label>
                </div>

                <div class="d-flex align-items-center justify-content-center ">
                    <button type="submit" class="py-3 mt-4 px-5 btn btn-outline-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container">
    <h1 class="text-center p-2 ">Question and Answer List</h1>

    <button id="add" class="float-end mb-5 py-2 btn btn-sm btn-outline-primary"> <i
            class="bi bi-person-plus-fill pe-2"></i>Add New FAQ</button>

    <table id="table" class="table table-bordered table-sm text-sm table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Quentions</th>
                <th>Answers</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $sql = "SELECT * from faq";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
            <tr>
                <td><?php echo $row['id']?></td>
                <td class="text-break"><?php echo $row['question']?></td>
                <td class="text-break"><?php echo $row['ans']?></td>
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
        question = tr.getElementsByTagName("td")[1].innerText;
        ans = tr.getElementsByTagName("td")[2].innerText;

        editid.value = id;
        editquestion.value = question;
        editans.value = ans;
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
            window.location = `faq-list.php?delete=${sno}`;
        }
    })
})

document.getElementById("add").addEventListener("click", function() {
    $('#addModal').modal('toggle');
});
</script>
<?php include "./admin-footer.php" ?>
<script>
$(document).ready(function() {
    $('#table').DataTable();
});
</script>