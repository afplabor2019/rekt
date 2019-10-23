<?php if (!defined("APP_VERSION")) {
    exit;
} ?>

<?php

debug_to_console("sa");
if (is_post()) {
    debug_to_console("asd");
    $game = trim('csgo');
    $rank = trim($_POST['minRank']) . '-' . trim($_POST['maxRank']);
    $lookingFor = trim('player');
    $age = trim($_POST['minAge']) . '-' . trim($_POST['maxAge']);
    $region = trim($_POST['region']);
    $role = trim($_POST['roles']);
    $goal = trim($_POST['goal']);
    $advertiserID = current_user($db)['id'];
    $language = trim($_POST['language']);
    $communication = trim($_POST['communication']);
    $teamName = trim($_POST['']);


    if (isset($_POST['search'])) {
        // search
    } else {
        // add
        $sql = $db->prepare("INSERT INTO advertisement (game,rank,lookingFor,age,region,role,goal,advertiserID,language,communication,teamName) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
        $sql->bind_param("sssssssisss", $game, $rank, $lookingFor, $age, $region, $role, $goal, $advertiserID, $language, $communication, $teamName);
        $sql->execute();
        $sql->close();

        // redirect(['page' => 'csgo']);
    }
    // route(['page' => 'csgo']);
}
?>

<div class="label">
    <form action="<?php echo route(['page' => 'csgo']); ?>" method="POST" enctype="multipart/form-data">
        <div class="label">
            <Table>
                <tr>
                    <td>Minimum skill:</td>
                    <td>
                        <select id="minRank">
                            <?php
                            $fn = fopen("Resources\csgoRanks.txt", "r");
                            $i = 0;
                            while (!feof($fn)) {
                                $result = fgets($fn);
                                echo '<option value="' . $result . '" ';
                                if ($i === 0) {
                                    echo 'selected="selected" ';
                                }
                                echo  '>' . $result . '</option>';
                                $i++;
                            }
                            fclose($fn);
                            ?>
                        </select>
                    </td>
                    <td>Maximum skill:</td>
                    <td>
                        <select id="maxRank">
                            <?php
                            $fn = fopen("Resources\csgoRanks.txt", "r");
                            $i = 0;
                            while (!feof($fn)) {
                                $result = fgets($fn);
                                echo '<option value="' . $result . '" ';
                                if ($i === 0) {
                                    echo 'selected="selected" ';
                                }
                                echo  '>' . $result . '</option>';
                                $i++;
                            }
                            fclose($fn);
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Minimum age:</td>
                    <td>
                        <select id="minAge">
                            <?php
                            for ($i = 1; $i <= 100; $i++) {
                                echo '<option value="' . $i . '" ';
                                if ($i === 0) {
                                    echo 'selected="selected" ';
                                }
                                echo '>' . $i . '</option>';
                            }
                            ?>
                        </select>
                    </td>
                    <td>Maximum age:</td>
                    <td>
                        <select id="maxAge">
                            <?php
                            for ($i = 1; $i <= 100; $i++) {
                                echo '<option value="' . $i . '" ';
                                if ($i === 0) {
                                    echo 'selected="selected" ';
                                }
                                echo '>' . $i . '</option>';
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        Region:
                    </td>
                    <td>
                        <select id=region>
                            <?php
                            $fn = fopen('Resources\regions.txt', "r");
                            $i = 0;
                            while (!feof($fn)) {
                                $result = fgets($fn);
                                echo '<option value="' . $result . '" ';
                                if ($i === 0) {
                                    echo 'selected="selected" ';
                                }
                                echo  '>' . $result . '</option>';
                                $i++;
                            }
                            fclose($fn);
                            ?>
                        </select>
                    </td>
                    <td>
                        Team goal:
                    </td>
                    <td>
                        <select id=goal>
                            <option value="any">any</option>
                            <option value="havefun">Have fun</option>
                            <option value="competitive">Play competitive</option>
                            <option value="pro">Become a pro</option>
                        </select>
                    </td>
                </tr>
            </Table>
        </div>
        <div class="label">
            <table>
                <tr>
                    <td>Language:</td>
                    <td>
                        <select id=language>
                            <?php
                            $fn = fopen('Resources\languages.txt', "r");
                            while (!feof($fn)) {
                                $result = fgets($fn);
                                echo '<option value=' . $result . '>' . $result . '</option>';
                            }
                            fclose($fn);
                            ?>
                        </select>
                    </td>
                    </td>
                </tr>
                <tr>
                    <td>Communication:</td>
                    <td>
                        <input type="checkbox" name="communication[]" value="dc"> Discord
                    </td>
                    <td>
                        <input type="checkbox" name="communication[]" value="ts"> Team speak
                    </td>
                    <td>
                        <input type="checkbox" name="communication[]" value="ig"> Ingame
                    </td>
                </tr>
            </table>
        </div>
        <div class="label">
            <table>
                <th>Roles</th>
                <tr>
                    <td>
                        <input type="checkbox" name="roles[]" value="entry"> Entry fragger
                    </td>
                    <td>
                        <input type="checkbox" name="roles[]" value="strategy"> Strategy caller
                    </td>
                    <td>
                        <input type="checkbox" name="roles[]" value="refragger"> Refragger
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" name="roles[]" value="lurker"> Lurker
                    </td>
                    <td>
                        <input type="checkbox" name="roles[]" value="awper"> AWPer
                    </td>
                </tr>
            </table>
        </div>
        <input type="submit" name="search" value="Search" />
        <input type="submit" name="add" value="Add" />
    </form>
</div>