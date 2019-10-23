<?php if (!defined('APP_VERSION')) {
    exit;
} ?>
<?php
$errors = [];

if (is_post()) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $passwordAgain = trim($_POST['passwordAgain']);
    $steamID = trim($_POST['steamID']);
    $ubisoftID = trim($_POST['ubisoftID']);
    $lolID = trim($_POST['lolID']);
    $birthDay = trim($_POST['birthDay']);

    if ($name == null) {
        $errors['name'][] = "Name is required!";
    }

    if ($email == null) {
        $errors['email'][] = "Email is required!";
    }

    if ($birthDay == null) {
        $errors['birthDay'][] = "Birth date required!";
    }

    $select = mysqli_query($db, "SELECT `email` FROM `players` WHERE `email` = '" . $_POST['email'] . "'") or exit(mysqli_error($connectionID));
    if (mysqli_num_rows($select)) {
        $errors['emailRegistered'][] = "Email is already taken!";
    }

    if ($password == null) {
        $errors['password'][] = "Password is required!";
    } else if (strlen($password) < 8) {
        $errors['shortPassword'][] = "Passwords must be atleast 8 character!";
    }

    if ($passwordAgain == null) {
        $errors['passwordAgain'][] = "Password Again is required!";
    }

    if ($password != $passwordAgain) {
        $errors['passwordsNotMatching'][] = "Passwords not matching!";
    }

    if (count($errors) == 0) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = $db->prepare("INSERT INTO players (email, password, name, steamID,uplayName,lolName,birthDay) VALUES (?,?,?,?,?,?,?)");
        $sql->bind_param("sssssss", $email, $hashedPassword, $name, $steamID, $ubisoftID, $lolID, $birthDay);
        $sql->execute();
        $sql->close();

        log_in_user($db->insert_id);
        redirect(['page' => 'home']);
    }
}

?>

<div class="formTables">
    <form action="<?php echo route(['page' => 'register']); ?>" method="POST" enctype="multipart/form-data">
        <table>
            <tr>
                <td colspan=2>Registration</td>
            </tr>
            <tr>
                <td>User name:</td>
                <td><input id="name" type="text" name="name" value="<?php echo isset($name) ? $name : ''; ?>">
                    <?php print_form_errors('name', $errors); ?></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><input id="email" type="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>">
                    <?php print_form_errors('email', $errors); ?>
                    <?php print_form_errors('emailRegistered', $errors); ?></td>
            </tr>
            <tr>
                <td>Birth day:</td>
                <td><input id="birthDay" type="date" name="birthDay" value="<?php echo isset($birthDay) ? $birthDay : ''; ?>">
                    <?php print_form_errors('birthDay', $errors); ?></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input id="password" type="password" name="password" value="<?php echo isset($password) ? $password : ''; ?>">
                    <?php print_form_errors('password', $errors); ?>
                    <?php print_form_errors('shortPassword', $errors); ?></td>
            </tr>
            <tr>
                <td>Password again:</td>
                <td><input id="passwordAgain" type="password" name="passwordAgain" value="<?php echo isset($passwordAgain) ? $passwordAgain : ''; ?>">
                    <?php print_form_errors('passwordAgain', $errors); ?>
                    <?php print_form_errors('passwordsNotMatching', $errors); ?></td>
            </tr>
            <tr>
                <td>Steam ID:</td>
                <td><input id="steamID" type="text" name="steamID" value="<?php echo isset($steamID) ? $steamID : ''; ?>">
                    <?php print_form_errors('steamID', $errors); ?></td>
            </tr>
            <tr>
                <td>Ubisoft account name:</td>
                <td><input id="ubisoftID" type="text" name="ubisoftID" value="<?php echo isset($ubisoftID) ? $ubisoftID : ''; ?>">
                    <?php print_form_errors('ubisoftID', $errors); ?></td>
            </tr>
            <tr>
                <td>LOL name:</td>
                <td><input id="lolID" type="text" name="lolID" value="<?php echo isset($lolID) ? $lolID : ''; ?>">
                    <?php print_form_errors('lolID', $errors); ?></td>
            </tr>
            <tr>
                <td colspan=2><button class="btn" type="submit">Register</button></td>
            </tr>
        </table>
    </form>
</div>