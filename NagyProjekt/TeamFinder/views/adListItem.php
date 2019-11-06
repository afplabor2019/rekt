<?php if (!defined("APP_VERSION")) {
    exit;
} ?>
<?php
$url = route([
    'page' => 'details',
    'id' => $ad['id'],
]);
$user = getUserById($db, $ad['advertiserID']);
?>

<div>
    <table border="1px solids">
        <tr>
            <td>
                <table border="1px solid">
                    <tr>
                        <td><?php
                            echo $user['name'];
                            ?></td>
                        <td>
                            <?php
                            echo '<img src="' . $gameIcons[$ad['game']] . '"'.$ad['game'].'" id="gameIcon">';
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <?php
                            $ranks = explode('-', $ad['skillRange']);
                            switch ($ad['game']){
                            case 'csgo':
                            echo '<img src="' . $csgoRanksPics[$ranks[0]] . '" alt="' . $ranks[0] . '" class="rankIcon">';
                            echo '-';
                            echo '<img src="' . $csgoRanksPics[$ranks[1]] . '" alt="' . $ranks[1] . '" class="rankIcon">';
                            break;
                            case 'lol':
                            echo '<img src="' . $lolRanksPics[$ranks[0]] . '" alt="' . $ranks[0] . '" class="rankIcon">';
                            echo '-';
                            echo '<img src="' . $lolRanksPics[$ranks[1]] . '" alt="' . $ranks[1] . '" class="rankIcon">';
                            break;
                            case 'r6s':
                            debug_to_console(strval($r6sRanksPics[$ranks[0]]));
                            echo '<img src="' . $r6sRanksPics[$ranks[0]] . '" alt="' . $ranks[0] . '" class="rankIcon">';
                            echo '-';
                            echo '<img src="' . $r6sRanksPics[$ranks[1]] . '" alt="' . $ranks[1] . '" class="rankIcon">';
                            break;
                             }
                              ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Age:
                        </td>
                        <td>
                            <?php
                            echo $ad['age'];
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Region:
                        </td>
                        <td>
                            <?php
                            echo $ad['region'];
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Goal:
                        </td>
                        <td>
                            <?php
                            echo $ad['goal'];
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Language:
                        </td>
                        <td>
                            <?php
                            echo $ad['language'];
                            ?>
                        </td>
                    </tr>
                </table>
            </td>
            <td>
                <table border="1px solid">
                    <tr>
                        <td colspan="2">
                            <a href="<?php echo route(['page' => 'messages']); ?>">
                                <img src="Resources\envelope.svg" alt="messages" class="headerIcon">
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>Communication:</td>
                        <td>
                            <ul>
                                <?php
                                $comm = explode('/', $ad['communication']);
                                foreach ($comm as $c) {
                                    $c = trim($c);
                                    if (!(trim($c) == "" || trim($c) == null)) {
                                        if ($c == "NaN") {
                                            echo '<li>Any</li>';
                                        } else {
                                            echo '<li>' . $c . '</li>';
                                        }
                                    }
                                }
                                ?>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td>Roles:</td>
                        <td>
                            <ul>
                                <?php
                                $comm = explode('/', $ad['role']);
                                foreach ($comm as $c) {
                                    $c = trim($c);
                                    if (!(trim($c) == "" || trim($c) == null)) {
                                        if ($c == "NaN") {
                                            echo '<li>Any</li>';
                                        } else {
                                            echo '<li>' . $c . '</li>';
                                        }
                                    }
                                }
                                ?>
                            </ul>
                        </td>
                    </tr>                   
                </table>
            </td>
        </tr>
    </table>
</div>