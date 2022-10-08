<?php

include '_dbconnect.php';

$delete = false;
$insert = false;
$update = false;


// DELETION OF NODE
if (isset($_GET['delete'])) {
    $sno = $_GET['delete'];

    $sql = "DELETE FROM `notes` WHERE `sno`= '$sno'";
    $result = mysqli_query($conn, $sql);

    if ($result) {

        $delete = true;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['snoEdit'])) {
        //UPDATE THE RECORD
        $sno = $_POST["snoEdit"];
        $title = $_POST["titleedit"];
        $description = $_POST["descriptionedit"];

        $sql = "UPDATE `notes` SET `title` ='$title' , `description`='$description' WHERE `notes`.`sno`=$sno";


        $result = mysqli_query($conn, $sql);

        if ($result) {

            $update = true;
        } else {
            echo "Record was not inserted successfully. ";
        }
    } else {

        // INSERT THE TABLE

        $title = $_POST["title"];
        $description = $_POST["description"];

        $sql = "INSERT INTO `notes` (`title`, `description`) VALUES ('$title','$description')";


        $result = mysqli_query($conn, $sql);

        if ($result) {

            $insert = true;
        } else {
            echo "Record was not inserted successfully. ";
        }
    }
}


?>



<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iNotes- Notes making made easy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">




</head>

<body>
    <!-- Edit modal -->
    <div class="modal" tabindex="-1" id="editModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit this Note</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="" method="post">
                        <input type="hidden" name="snoEdit" id="snoEdit">
                        <div class="mb-3">
                            <label for="titleedit" class="form-label">Note Title</label>
                            <input type="text" class="form-control" id="titleedit" name="titleedit" aria-describedby="emailHelp">
                        </div>

                        <div class="mb-3">
                            <label for="descriptionedit" class="form-label">Note Description</label>
                            <textarea type="text" class="form-control" id="descriptionedit" name="descriptionedit" aria-describedby="text"></textarea>
                        </div>

                        <br>


                </div>
                <div class="modal-footer d-block mr-auto">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>


    <nav class="navbar navbar-expand-lg bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand text-light" href="#">iNodes</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>


            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">


                    <li class="nav-item">
                        <a class="nav-link active text-light" aria-current="page" href="#">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-light" href="#">About</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-light" href="#">Contact Us</a>
                    </li>


                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>



    <?php

    if ($delete) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Great! </strong> Your record was deleted successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
    }

    if ($insert) {
        echo '<div class="alert alert-success alert-dismissible fade  show" role="alert">
            <strong>Congratulations!</strong> Your record was inserted successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
    }

    if ($update) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Wonderful! </strong> You existing record was updated successfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }


    ?>


    <div class="container mt-3">
        <h2>Add a Note</h2>
        <form action="" method="post">

            <div class="mb-3">
                <label for="title" class="form-label">Note Title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Note Description</label>
                <textarea type="text" class="form-control" id="descripton" name="description" aria-describedby="text"></textarea>
            </div>

            <br>

            <button type="submit" class="btn btn-primary">Add Note</button>
        </form>
    </div>




    <div class="container mb-3">

        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope=" col">#</th>
                    <th scope="col">Title></th>
                    <th scope="col">Desription</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>

                <?php

                $sql = "SELECT * FROM `notes`";
                $result = mysqli_query($conn, $sql);
                $no = 1;
                while ($row = mysqli_fetch_assoc($result)) {

                    echo " <tr>
                    <th scope='row'>$no</th>
                    <td>" . $row['title'] . "</td>
                    <td>" . $row['description'] . "</td>
                    <td><button class='edit btn btn-sm btn-primary' id=" . $row['sno'] . ">Edit</button> <button class='delete btn btn-sm btn-primary' id=" . $row['sno'] . ">Delete</button></td>
                </tr>";

                    $no += 1;
                }


                ?>

            </tbody>
        </table>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>


    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>

    <script>
        edit = document.getElementsByClassName('edit');
        Array.from(edit).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("edit", e.target.parentNode.parentNode);
                tr = e.target.parentNode.parentNode;
                title = tr.getElementsByTagName("td")[0].innerText;
                description = tr.getElementsByTagName("td")[1].innerText;
                console.log(title, description);
                descriptionedit.value = description;
                titleedit.value = title;
                snoEdit.value = e.target.id;
                $('#editModal').modal('toggle');
            })
        })



        deletes = document.getElementsByClassName('delete');
        Array.from(deletes).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("edit", );
                sno = e.target.id;



                if (confirm("Are you sure you want to delete this!")) {
                    console.log("Yes");
                    window.location = `/abhi/curd/index.php?delete=${sno}`;
                } else {
                    console.log("No");
                }
            })

        })
    </script>
</body>

</html>