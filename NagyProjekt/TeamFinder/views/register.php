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

        $sql = $db->prepare("INSERT INTO players (email, password, name, birthDay) VALUES (?,?,?,?)");
        $sql->bind_param("ssss", $email, $hashedPassword, $name, $birthDay);
        $sql->execute();
        $sql->close();

        log_in_user($db->insert_id);
        redirect(['page' => 'home']);
    }
}

?>

<div class="labelC middle">
    <form action="<?php echo route(['page' => 'register']); ?>" method="POST" enctype="multipart/form-data">
        <table>
            <tr>
                <td class="secondaryColor" colspan=2>Registration</td>
            </tr>
            <tr>
                <td class="formLeft">User name:</td>
                <td><input class="textInput" id="name" type="text" name="name" value="<?php echo isset($name) ? $name : ''; ?>">
                    <?php print_form_errors('name', $errors); ?></td>
            </tr>
            <tr>
                <td class="formLeft">Email:</td>
                <td><input class="textInput" id="email" type="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>">
                    <?php print_form_errors('email', $errors); ?>
                    <?php print_form_errors('emailRegistered', $errors); ?></td>
            </tr>
            <tr>
                <td class="formLeft">Birth day:</td>
                <td><input class="textInput" id="birthDay" type="date" name="birthDay" min='1900-01-01' max='2019-12-31' value="<?php echo isset($birthDay) ? $birthDay : ''; ?>">
                    <?php print_form_errors('birthDay', $errors); ?></td>
            </tr>
            <tr>
                <td class="formLeft">Password:</td>
                <td><input class="textInput" id="password" type="password" name="password" value="<?php echo isset($password) ? $password : ''; ?>">
                    <?php print_form_errors('password', $errors); ?>
                    <?php print_form_errors('shortPassword', $errors); ?></td>
            </tr>
            <tr>
                <td class="formLeft">Password again:</td>
                <td><input class="textInput" id="passwordAgain" type="password" name="passwordAgain" value="<?php echo isset($passwordAgain) ? $passwordAgain : ''; ?>">
                    <?php print_form_errors('passwordAgain', $errors); ?>
                    <?php print_form_errors('passwordsNotMatching', $errors); ?></td>
            </tr>
            <tr>
                <td colspan=2><button class="buttonC" type="submit">Register</button></td>
            </tr>
        </table>
    </form>
</div>

<script>
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();
    if (dd < 10) {
        dd = '0' + dd
    }
    if (mm < 10) {
        mm = '0' + mm
    }

    today = yyyy + '-' + mm + '-' + dd;
    document.getElementById("birthDay").setAttribute("max", today);
</script>