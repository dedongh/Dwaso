<?php include_once "../db.php";
if (!is_logged_in()) {
    login_error_redirect();
}
if (!has_permission("admin")) {
    permission_error_redirect("index.php");
}
ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>GiLo User Permissions</title>
    <?php include_once "includes/header.php" ?>
</head>
<body>
<?php include_once "includes/nav.php"; ?>
<div class="page-title">
    <div class="container">
        <div class="column">
            <h1><?= ((isset($_GET["add"]))? "Add New Users":"Users") ?></h1>
        </div>
        <div class="column">
            <ul class="breadcrumbs">
                <li><a href="index.php">Home</a>
                </li>
                <li class="separator">&nbsp;</li>
                <li>Users</li>
            </ul>
        </div>
    </div>
</div>

<?php
if (isset($_GET["delete"])) {
    $delete_id = sanitize($_GET["delete"]);
    $con->query("delete from users where id = '$delete_id'");

    $_SESSION["success_msg"] = "User deleted successfully";
    header("Location: user_permissions.php");
}
if (isset($_GET["add"])) {
    $fName = ((isset($_POST["first_name"])) ? sanitize($_POST["first_name"]) : "");
    $lName = ((isset($_POST["last_name"])) ? sanitize($_POST["last_name"]) : "");
    $email = ((isset($_POST["email"])) ? sanitize($_POST["email"]) : "");
    $password = ((isset($_POST["password"])) ? sanitize($_POST["password"]) : "");
    $confirm = ((isset($_POST["confirm"])) ? sanitize($_POST["confirm"]) : "");
    $permission = ((isset($_POST["permission"])) ? sanitize($_POST["permission"]) : "");

    if ($_POST) {

        $emailQry = $con->query("select * from users where email = '$email'");
        $eCount = $emailQry->num_rows;

        if ($eCount != 0) {
            $errors[] = "Email Already Exists in the database";
        }
        $required = array("name","email","password","confirm","permission");
        foreach ($required as $f) {
            if (empty($f)) {
                $errors[] = "You must fill out all fields";
                break;
            }
        }
        if (strlen($password ) < 6) {
            $errors[] = "Password should must be at least 6 characters";
        }
        if ($password != $confirm) {
            $errors[] = "Your passwords do not match";
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "You must enter a valid email";
        }
        if (!empty($errors)) {
            echo display_errors($errors);
        } else {
            $full_name = $fName ." ".$lName;
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $con->query("insert into users (full_name, email, Password, permissions) VALUES ('$full_name','$email','$hashed','$permission')");
            $_SESSION["success_msg"] = "User has been added";
            header("Location: user_permissions.php");
        }
    }
    ?>
<div class="col-md-6 offset-3">
    <form class="row " action="user_permissions.php?add=1" method="post">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="reg-fn">First Name</label>
                <input class="form-control" name="first_name" type="text" id="reg-fn" value="<?= $fName ?>" required>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="reg-ln">Last Name</label>
                <input class="form-control" name="last_name" type="text" value="<?= $lName ?>" id="reg-ln" required>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="reg-email">E-mail Address</label>
                <input class="form-control" name="email" value="<?= $email ?>" type="email" id="reg-email" required>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="reg-pass">Password</label>
                <input class="form-control" name="password" value="<?= $password ?>" type="password" id="reg-pass" required>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="reg-pass-confirm">Confirm Password</label>
                <input class="form-control" name="confirm" value="<?= $confirm ?>" type="password" id="reg-pass-confirm" required>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="reg-pass-perm">Permission</label>
                <select class="form-control" name="permission" id="reg-pass-perm">
                    <option value="" <?= (($permission == "")?"selected":"") ?>></option>
                    <option value="editor" <?= (($permission == "editor")?"selected":""); ?>>Editor</option>
                    <option value="admin,editor" <?= (($permission == "admin,editor")?"selected":""); ?>>Admin</option>
                    <option value="admin,editor,developer" <?= (($permission == "admin,editor,developer")?"selected":""); ?>>Developer</option>
                </select>
            </div>
        </div>
        <div class="col-12 text-center text-sm-right">
            <a href="user_permissions.php" class="btn btn-secondary">Cancel</a>
            <button class="btn btn-primary margin-bottom-none" type="submit">Register</button>
        </div>
    </form>
</div>


<?php } else{
    $userQry = $con->query("select * from users order by  full_name");
?>



<div class="col-md-10 offset-1">
    <a href="user_permissions.php?add=1" class="btn btn-outline-success float-right" id="add-users">Add User</a>
<table class="table table-responsive table-condensed table-bordered table-striped">
    <thead>
    <tr>
        <th></th>
        <th>Name</th>
        <th>Email</th>
        <th>Join Date</th>
        <th>Last Login</th>
        <th>Permissions</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <?php while ($user = $userQry->fetch_assoc()): ?>
        <td>
            <?php if ($user["id"] != $user_data["id"]):?>
            <a href="user_permissions.php?delete=<?= $user["id"] ?>" class="btn btn-sm btn-outline-danger"><span class="icon-delete"></span></a>
            <?php endif;?>
        </td>
        <td><?= $user["full_name"]; ?></td>
        <td><?= $user["email"]; ?></td>
        <td><?= pretty_date($user["join_date"]); ?></td>
        <td><?= (($user["last_login"] == $user["join_date"])?"Never": pretty_date($user["last_login"])); ?></td>
        <td><?= $user["permissions"]; ?></td>
    </tr>
    <?php endwhile; ?>
    </tbody>
</table>
</div>

<?php } include_once "includes/footer.php" ?>
</body>
</html>
<?php ob_end_flush(); ?>