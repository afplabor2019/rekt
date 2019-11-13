<?php if (!defined("APP_VERSION")) {
    exit;
}
gate();
?>
<?php
$user = current_user($db);

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
    if (mysqli_num_rows($select) && $email !== $user['email']) {
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

        $sql = $db->prepare("UPDATE `players` SET `name` = ?, `birthDay` = ?, `email` = ?, `password` = ? WHERE `players`.`id` = ?;");
        $sql->bind_param("ssssi", $name, $birthDay, $email, $hashedPassword, $user['id']);
        $sql->execute();
        $sql->close();

        redirect(['page' => 'profile']);
    }
}

?>


<div class="labelC middle">
    <form action="<?php echo route(['page' => 'profileEdit']); ?>" method="POST" enctype="multipart/form-data">
        <table>
            <tr>
                <td class="secondaryColor" colspan=2>Registration</td>
            </tr>
            <tr>
                <td class="formLeft">User name:</td>
                <td class="textInput"><input id="name" type="text" name="name" value="<?php echo $user['name']; ?>">
                    <?php print_form_errors('name', $errors); ?></td>
            </tr>
            <tr>
                <td class="formLeft">Email:</td>
                <td class="textInput"><input id="email" type="email" name="email" value="<?php echo $user['email']; ?>">
                    <?php print_form_errors('email', $errors); ?>
                    <?php print_form_errors('emailRegistered', $errors); ?></td>
            </tr>
            <tr>
                <td class="formLeft">Birth day:</td>
                <td class="textInput"><input id="birthDay" type="date" name="birthDay" min='1900-01-01' max='2019-12-31' value="<?php echo $user['birthDay']; ?>">
                    <?php print_form_errors('birthDay', $errors); ?></td>
            </tr>
            <tr>
                <td class="formLeft">Password:</td>
                <td class="textInput"><input id="password" type="password" name="password" value="<?php echo isset($password) ? $password : ''; ?>">
                    <?php print_form_errors('password', $errors); ?>
                    <?php print_form_errors('shortPassword', $errors); ?></td>
            </tr>
            <tr>
                <td class="formLeft">Password again:</td>
                <td class="textInput"><input id="passwordAgain" type="password" name="passwordAgain" value="<?php echo isset($passwordAgain) ? $passwordAgain : ''; ?>">
                    <?php print_form_errors('passwordAgain', $errors); ?>
                    <?php print_form_errors('passwordsNotMatching', $errors); ?></td>
            </tr>
            <tr>
                <td colspan=2><button class="buttonC" type="submit">Update profile</button></td>
            </tr>
        </table>
    </form>
</div>
