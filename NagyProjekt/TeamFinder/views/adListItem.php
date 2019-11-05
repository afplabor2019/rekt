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
                        <td><?php
                            echo '<img src="' . $gameIcons[$ad['game']] . '" alt="Counter Strike: Global Offensive" id="gameIcon">';
                            ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <?php
                            $ranks = explode('-', $ad['skillRange']);
                            echo '<img src="' . $csgoRanksPics[$ranks[0]] . '" alt="' . $ranks[0] . '" class="rankIcon">';
                            echo '-';
                            echo '<img src="' . $csgoRanksPics[$ranks[1]] . '" alt="' . $ranks[1] . '" class="rankIcon">';
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
                    <tr>
                        <td colspan="2">
                            K/D:
                            <?php
                            if (array_key_exists('steamID', $user)) {
                                echo 'Not found!';
                            } else {
                                $json = getCsGoUserStats($user['steamid']);
                                $kd = intval($json['playerstats']['stats'][0]['value']) / intval($json['playerstats']['stats'][1]['value']);
                                echo number_format((float) $kd, 2, '.', '');
                            }

                            ?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>