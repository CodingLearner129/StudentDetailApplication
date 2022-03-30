<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>SDA</title>
</head>

<body>
    <?php
    include "./header.php";
    if ($_SESSION["id"] == "") {
        header("location:login.php");
    }
    ?>
    <!-- <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">SDA</a>

            <form class="d-flex" id="searchForm">
                <input class="form-control me-2" type="search" name="key" id="search-key" placeholder="Search" aria-label="Search" autocomplete="off">
                <button class="btn btn-outline-success" id="search-btn" type="submit">Search</button>
            </form>
        </div>
    </nav> -->

    <!-- THis Form Used For Update Purpose-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="edit-form">
                        <div class="mb-3">
                            <!-- <label for="editid" class="col-form-label">Name :</label> -->
                            <input type="text" class="form-control" id="edit-id" name="sid" hidden>
                            <label for="edit-name" class="col-form-label">Name :</label>
                            <input type="text" class="form-control" id="edit-name" name="sname">
                        </div>
                        <div class="mb-3">
                            <label for="edit-address" class="col-form-label">Address :</label>
                            <input type="text" class="form-control" id="edit-address" name="saddress">
                        </div>
                        <div class="mb-3">
                            <label for="edit-dob" class="col-form-label">DOB :</label>
                            <input type="date" class="form-control" id="edit-dob" name="sdob">
                        </div>
                        <div class="mb-3">
                            <label for="edit-phone" class="col-form-label">Phone :</label>
                            <input type="tel" class="form-control" id="edit-phone" name="sphone" maxlength="10">
                        </div>
                        <div class="mb-3">
                            <label for="edit-course" class="col-form-label">Course :</label>
                            <input type="text" class="form-control" id="edit-course" name="scourse">
                        </div>
                        <!-- <div class="mb-3">
                            <label for="message-text" class="col-form-label">Message:</label>
                            <textarea class="form-control" id="message-text"></textarea>
                        </div> -->
                    </form>
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                    <button type="button" id="update-edit-btn" class="btn btn-success">Update</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Show success message -->
    <div class="alert alert-success alert-dismissible fade show" id="success-alert" role="alert"
        style="display: none !important;">
        <strong>Success, </strong>
        <span id="success-message"></span>
    </div>
    <!-- Show error message -->
    <div class="alert alert-danger alert-dismissible fade show" id="error-alert" role="alert"
        style="display: none !important;">
        <strong>Error, </strong>
        <span id="error-message"></span>
    </div>

    <!-- To Insert New Data -->
    <form id="addForm" style="background-color: burlywood;">
        <div class="container-fluid p-4 row">
            <div class="col-md-4 d-flex p-2">
                <label for="sname" class="form-label my-1 mx-2">Name&nbsp;:&nbsp;</label>
                <input type="text" class="form-control" id="sname" name="sname">
                <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
            </div>
            <div class="col-md-4 d-flex p-2">
                <label for="saddress" class="form-label my-1 mx-2">Address&nbsp;:&nbsp;</label>
                <input type="text" class="form-control" id="saddress" name="saddress">
                <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
            </div>
            <div class="col-md-4 d-flex p-2">
                <label for="sdob" class="form-label my-1 mx-2">DOB&nbsp;:&nbsp;</label>
                <input type="date" class="form-control" id="sdob" name="sdob">
                <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
            </div>
            <div class="col-md-4 d-flex p-2">
                <label for="sphone" class="form-label my-1 mx-2">Phone&nbsp;:&nbsp;</label>
                <input type="tel" class="form-control" id="sphone" name="sphone" maxlength="10">
                <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
            </div>
            <div class="col-md-4 d-flex p-2">
                <label for="scourse" class="form-label my-1 mx-2">Course&nbsp;:&nbsp;</label>
                <input type="text" class="form-control" id="scourse" name="scourse">
                <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
            </div>
            <div class="col-md-4 p-2">
                <center><button type="submit" name="save" id="save-btn"
                        class="btn btn-success text-center px-4">Save</button>
                    <center>
            </div>
        </div>
    </form>

    <!-- Table That Shoews All Data -->
    <div class="container-fluid my-5 p-5 overflow-auto" style="min-height: 19.6rem; max-height: 50rem;">
        <table class="table table-bordered border-dark">
            <thead class="table-bordered border-dark text-light text-center" style="background-color: crimson;">
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Address</th>
                    <th scope="col">DOB</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Course</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody id="load-table" class="table-bordered border-dark text-center">

            </tbody>
        </table>
    </div>

    <div class="b-example-divider"></div>


    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 mb-0 border-top bg-dark">
        <div class="col-md-4 px-4 d-flex align-items-center">
            <a href="index.php" class="me-2 mb-md-0 text-decoration-none lh-1 text-light">
                SDA
            </a>
            <span class="text-light">© 2022
            </span>
        </div>

        <div class="nav col-md-4 justify-content-end px-4 list-unstyled d-flex">
            <span class="text-light">By Dhgp</span>
        </div>
    </footer>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
        <script type="text/javascript" src="./js/jQuery.js"></script>
        <script type="text/javascript" src="./js/jQuery1.js"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
</body>

</html>