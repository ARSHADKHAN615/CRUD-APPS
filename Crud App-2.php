<?php
//   connect to database 

$server = "localhost";
$username = "root";
$password = "";
$db = "notes";
$insert = false;
$delete = false;
$update = false;


$conn = mysqli_connect($server, $username, $password, $db);
if (!$conn) {
    echo "connection is not connect";
}

if (isset($_GET['delete'])) {
    $sno = $_GET['delete'];
    $sql = "DELETE FROM `table notes` WHERE `table notes`.`sno` = $sno";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $delete = true;
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['snoEdit'])) {

        // UPDATE DATA FROM DATABASE 
        $sno = $_POST['snoEdit'];
        $title = $_POST['titleEdit'];
        $description = $_POST['descEdit'];
        $sql = "UPDATE `table notes` SET `title` = '$title' , `description` = '$description' WHERE  `sno` = $sno";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $update = true;
        }
    } else {

        // INSERT DATA FROM DATABASE 
        $title = $_POST['title'];
        $description = $_POST['desc'];
        $sql = "INSERT INTO `table notes` (`title`, `description`) VALUES ('$title', '$description')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $insert = true;
        } else {
            $insert = false;
        }
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href=" //cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <title>Hello, world!</title>
</head>

<body>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit This Note</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="Crud App-2.php" method="POST">
                        <input type="hidden" name="snoEdit" id="snoEdit">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Note Title</label>
                            <input type="text" class="form-control" name="titleEdit" id="titleEdit" aria-describedby="emailHelp" placeholder="Enter Title">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Note Description</label>
                            <textarea class="form-control" name="descEdit" id="descEdit" rows="3" placeholder="Description"></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">TODO LIST</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">Contact us</a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- SHOW OPERATION DATA SUBMIT SUCCESSFULLY OR NOT OR DELETE -->
    <?php
    if ($insert) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                    <strong>Congratulation!   </strong>Your Notes Add Successfully.
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                    </div>
                ";
    } elseif ($update) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                    <strong>Congratulation!  </strong> Your Notes Update successfully.
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                    </div>
                ";
    } elseif ($delete) {
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    <strong>Congratulation!  </strong> Your Note Deleted.
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                    </div>
                ";
    }

    ?>
    <!-- ADD NOTES FROM  -->
    <div class="container my-5">
        <form action="Crud App-2.php" method="POST">
            <div class="form-group">
                <label for="exampleInputEmail1">Note Title</label>
                <input type="text" class="form-control" name="title" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Title" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Note Description</label>
                <textarea class="form-control" name="desc" id="exampleFormControlTextarea1" rows="3" placeholder="Description"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Notes</button>
        </form>
    </div>
    <!-- NOTES TABLE  -->
    <div class="container my-5 py-5">
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">S.No</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- SELECT DATA FROM DB AND SHOW IN FRONTEND  -->
                <?php
                $sql = "SELECT * FROM `table notes`";
                $rust = mysqli_query($conn, $sql);
                $num = 0;
                while ($array = mysqli_fetch_assoc($rust)) {
                    $num = $num + 1;
                    echo "<tr>
                      <th scope='row'>" . $num . "</ th>
                      <td>" . $array['title'] . "</td>
                      <td>" . $array['description'] . "</td>
                      <td> 
                            <button class='edit btn btn-primary btn-sm' id=" . $array['sno'] . ">Edit</button>
                            <button class='delete btn btn-primary btn-sm' id= d" . $array['sno'] . ">Delete</button>
                      </td>
                  </tr>";
                }
                ?>

            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>


    <script>
        // DATABLE CALL 
        $(document).ready(function() {
            $('#myTable').DataTable();
        });

        // EDIT DATA FROM MODAL 
        const editBtn = document.querySelectorAll(".edit");
        editBtn.forEach(e => {
            e.addEventListener("click", (e) => {
                tr = e.target.parentNode.parentNode;

                title = tr.getElementsByTagName("td")[0].innerHTML;
                desc = tr.getElementsByTagName("td")[1].innerHTML;

                titleEdit.value = title;
                descEdit.value = desc;

                $('#exampleModal').modal('toggle');

                snoEdit.value = e.target.id;
            })
        })

        // DELETE DATA FROM LIST 
        const deleteBtn = document.querySelectorAll(".delete");
        deleteBtn.forEach(e => {
            e.addEventListener("click", (e) => {
                let sno = e.target.id.substr(1)
                if (confirm("Are you sure you want to delete this note!")) {
                    console.log("yes");
                    window.location = `Crud App-2.php?delete=${sno}`;
                } else {
                    console.log("no");
                }
            })



        });
    </script>

</body>

</html>