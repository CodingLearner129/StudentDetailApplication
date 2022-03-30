<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>LogIn Page</title>

</head>

<body>
    <?php include "./header.php"; ?>

    <div class="container my-5 p-5" style="min-height: 26rem;">
        <h1 class="mx-5 mb-4">LogIn Page</h1>
        <div id="companyform" class="formdiv mx-5" style="display: block;">
            <form class="needs-validation" method="POST" action="./_login.php">
                <div class="mb-3">
                    <label for="logname" class="form-label">Username</label>
                    <input type="text" class="form-control" id="logname" name="logname" minlength="4" maxlength="50" required>
                </div>
                <div class="mb-3">
                    <label for="logpassword" class="form-label">Password</label>
                    <input type="password" class="form-control" id="logpassword" name="logpassword" minlength="6" maxlength="15" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                </div>
                <button type="submit" class="btn btn-primary" name="LogIn">Submit</button>
            </form>
        </div>
        
    </div>

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
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <script src="./assets/js/jQuery.js"></script>

    <script>
    $(document).ready(function() {
        $("#employeeform").hide();
        $("input[name$='login']").click(function() {
            var name = $(this).val();
            $(".formdiv").hide();
            $("#" + name + "form").show();
        });
    });
    </script>

</body>

</html>