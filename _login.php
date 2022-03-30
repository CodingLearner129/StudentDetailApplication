<?php
include "./conn.php";
session_start();

$message = "";
$status = false;

if (isset($_POST["LogIn"])) {
    $username = $_POST['logname'];
    $password = $_POST['logpassword'];

    $sql = "SELECT * FROM `login` WHERE `username`='$username'";

    $resultSql = mysqli_query($conn, $sql);

    if ($resultSql == TRUE) {
        if ($resultSql->num_rows > 0) {
            while ($rowSql = $resultSql->fetch_assoc()) {
                $dbPass = $rowSql["password"];
                // echo $dbPass;
                // $pass_Decode = password_verify($password, $dbPass);
                // echo $pass_Decode;
                if ($password == $dbPass) {
                    $_SESSION['id'] = $rowSql['id'];
                    $message = "Log in successfully...";
                    $status = true;
?>
                    <script>
                        window.location.href = './index.php?id=<?php echo $_SESSION['id']; ?>&message=<?php echo $message ?>&status=<?php echo $status; ?>';
                    </script>";
                <?php
                } else {
                    // echo "<script> alert('Invalid Password!!!'); window.location.href = 'log_in.php'; </script>";
                    $message = "Invalid Password!!!";
                    $status = false;
                ?>
                    <script>
                        window.location.href = './login.php?message=<?php echo $message ?>&status=<?php echo $status; ?>';
                    </script>";
            <?php
                }
            }
        } else {
            // echo "<script> alert('Register first!!!'); window.location.href = 'sign_up.php'; </script>";
            $message = "Register first!!!";
            $status = false;
            ?>
            <script>
                window.location.href = './login.php?message=<?php echo $message ?>&status=<?php echo $status; ?>';
            </script>";
        <?php
        }
    } else {
        // echo "<script> alert('Log in failed!!!'); window.location.href = 'log_in.php'; </script>";
        $message = "Log in failed!!!";
        $status = false;
        ?>
        <script>
            window.location.href = './login.php?message=<?php echo $message ?>&status=<?php echo $status; ?>';
        </script>";
<?php
    }
}
$conn->close();
?>