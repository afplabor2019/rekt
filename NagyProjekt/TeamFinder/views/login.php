<?php if (!defined('APP_VERSION')) {
    exit;
} ?>
<?php
if (user_logged_in()) {
    redirect(['page' => 'home']);
}

$errors = [];

if (is_post()) {
    $name = trim($_POST['name']);
    $password = trim($_POST['password']);

    $sql = $db->prepare("SELECT * FROM players WHERE name = ?");
    $sql->bind_param('s', $name);
    $sql->execute();

    $result = $sql->get_result();

    if ($user = $result->fetch_assoc()) {
        if (!password_verify($password, $user['password'])) {
            $errors[] = 'Incorrect user name or password';
        }
    } else {
        $errors[] = 'Incorrect user name or password';
    }

    if (count($errors) == 0) {
        log_in_user($user['id']);

        if (isset($_SESSION['intended']) && $_SESSION['intended'] != null) {
            $url = $_SESSION['intended'];
            header("Location: $url");
            die();
        }
        redirect(['page' => 'home']);
    }
}
?>
<div class="labelC middle" id="login">
    <form action="<?php echo route(['page' => 'login']); ?>" method="POST">
        <?php if (count($errors)) : ?>
            <div class="alert alert-error">
                <?php foreach ($errors as $error) : ?>
                    <p><?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <table>
            <tr>
                <td colspan=2>
                    <h1 id="loginTitle">Sign in</h1>
                </td>
            </tr>
            <tr>
                <td class="loginLeft"><label for="name">User name</label></td>
                <td><input class="textInput" id="name" type="text" name="name" value="<?php echo isset($name) ? $name : ''; ?>"></td>
            </tr>
            <tr>
                <td class="loginLeft"><label for="password">Password</label></td>
                <td><input class="textInput" id="password" type="password" name="password" value=""></td>
            </tr>

            <tr>
                <td colspan=2><button class="buttonC" id="signinbt" type="submit">Sign in</button></td>
            </tr>
        </table>
    </form>
</div>