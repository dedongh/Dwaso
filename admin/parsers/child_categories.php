<?php
/**
 * Created by PhpStorm.
 * User: Bra Emma
 * Date: 9/4/2018
 * Time: 1:22 AM
 */

require_once "../../db.php";

    $parentID = (int)$_POST["parentID"];
$selected = sanitize($_POST["selected"]);
    #$parentID = 25;
    $childQry = $con->query("select * from categories where parent = '$parentID' order by name");

ob_start();?>
<option value=""></option>
<?php while ($child = $childQry->fetch_assoc()): ?>
<option value="<?= $child["c_id"] ?>" <?= (($selected == $child["c_id"])?" selected":"")?>><?= $child["name"] ?></option>

<?php endwhile;  ?>
<?php echo ob_get_clean();?>
