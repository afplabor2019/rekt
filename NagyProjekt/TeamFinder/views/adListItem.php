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
<div id="adItemWrapper">
    <div class="labelC adItemI searchMiddle">
        <table>
            <tr>
                <td id="searchMiddle">
                    <table>
                        <tr>
                            <td class="secondaryColor searchName"><?php
                                                                    echo $ad['teamName'] == '' || $ad['teamName'] == null ? $user['name'] : $ad['teamName'];
                                                                    // echo $user['name'];
                                                                    ?></td>
                            <td>
                                <?php
                                echo '<img class="searchGameIcon" src="' . $gameIcons[$ad['game']] . '"' . $ad['game'] . '" title="' . $ad['game'] . '" id="gameIcon">';
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td id="searchRanksTD" colspan="2">
                                <?php
                                $ranks = explode('-', $ad['skillRange']);
                                switch ($ad['game']) {
                                    case 'csgo':
                                        echo '<img src="' . $csgoRanksPics[$ranks[0]] . '" alt="' . $ranks[0] . '" title="' . $ranks[0] . ' " class="rankIcon">';
                                        echo '-';
                                        echo '<img src="' . $csgoRanksPics[$ranks[1]] . '" alt="' . $ranks[1] . '" title="' . $ranks[1] . ' "  class="rankIcon">';
                                        break;
                                    case 'lol':
                                        echo '<img src="' . $lolRanksPics[$ranks[0]] . '" alt="' . $ranks[0] . '" title="' . $ranks[0] . '" class="rankIcon">';
                                        echo '-';
                                        echo '<img src="' . $lolRanksPics[$ranks[1]] . '" alt="' . $ranks[1] . '" title="' . $ranks[1] . '" class="rankIcon">';
                                        break;
                                    case 'r6s':
                                        debug_to_console(strval($r6sRanksPics[$ranks[0]]));
                                        echo '<img src="' . $r6sRanksPics[$ranks[0]] . '" alt="' . $ranks[0] . '" title="' . $ranks[0] . '" class="rankIcon">';
                                        echo '-';
                                        echo '<img src="' . $r6sRanksPics[$ranks[1]] . '" alt="' . $ranks[1] . '" title="' . $ranks[1] . '" class="rankIcon">';
                                        break;
									case 'ow':
                                        debug_to_console(strval($owRanksPics[$ranks[0]]));
                                        echo '<img src="' . $owRanksPics[$ranks[0]] . '" alt="' . $ranks[0] . '" title="' . $ranks[0] . '" class="rankIcon">';
                                        echo '-';
                                        echo '<img src="' . $owRanksPics[$ranks[1]] . '" alt="' . $ranks[1] . '" title="' . $ranks[1] . '" class="rankIcon">';
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
                    <table>
                        <tr>
                            <td colspan="2">
                                <a href="<?php redirectToMessages($user['id']) ?>">
                                    <img src="Resources\envelope.svg" alt="messages" class="headerIcon">
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="searchHL">Communication:</td>
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
                            <td class="searchHL">Roles:</td>
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
                        <tr>
                            <td colspan="2" id="searchTop">
                                <?php
                                echo $user['name'] . "'s age:";
                                $date = new DateTime($user['birthDay']);
                                $now = new DateTime();
                                $interval = $now->diff($date);
                                echo $interval->y;
                                ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</div>