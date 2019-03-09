<?php include_once "../db.php"; 
if (!is_logged_in()) {
    login_error_redirect();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Product Comments</title>
    <?php include_once "includes/header.php" ?>
</head>
<body>
<?php include_once "includes/nav.php"; ?>

<div class="container padding-top-2x">
    <div class="row">
        <div class="col-md-4">
            <section class="widget widget-categories">
                <h3 class="widget-title">Filter Comments</h3>
                <ul>
                    <li><a href="comments.php?unapproved=1">Unapproved</a><span>(<?= count_reviews(0);  ?>)</span></li>
                    <li><a href="comments.php?approved=1">Approved</a><span>(<?= count_reviews(1);  ?>)</span></li>
                </ul>
            </section>
        </div>
        <div class="col-md-8">
            <h3 class="padding-bottom-1x">Latest Reviews</h3>
            <?php
            function count_reviews($status)
            {
                global $con;
                $sql = $con->query("select count(*) as cout from reviews where status = '$status'");
                $res = $sql->fetch_assoc();
                $row = $res["cout"];
                return $row;
            }
            if (isset($_GET["yes"])) {
                $id = (int)$_GET["yes"];
                $sql = $con->query("update reviews set status = 1 where uid = '$id'");
            }
            if (isset($_GET["dabi"])) {
                $id = (int)$_GET["dabi"];
                $sql = $con->query("update reviews set status = 0 where uid = '$id'");
            }
             if (isset($_GET["no"]) and isset($_GET["pid"])) {
                $id = (int)$_GET["no"];
                $pid = (int)$_GET["pid"];
                $sql = $con->query("delete from reviews where uid = '$id' and p_id = '$pid'");
            }

            if (isset($_GET["unapproved"])) {
                $revSql = "select * from reviews where  status = 0 order by id desc ";
            }elseif (isset($_GET["approved"])){
                $revSql = "select * from reviews where  status = 1 order by id desc ";
            }else{
                $revSql = "select * from reviews where  status = 0 order by id desc ";
            }

            $revRes = $con->query($revSql);
            if ($revRes->num_rows > 0) {
                while ($resRow = $revRes->fetch_assoc()) {
                    $revUID = $resRow["uid"];
                    $revSubj = $resRow["subject"];
                    $revRev = $resRow["review"];
                    $revRate = $resRow["rating"];
                     $pro_id = $resRow["p_id"];
                    $revUser = $con->query("select first_name, last_name from user_info where uid = '$revUID'");
                    while ($revRow = $revUser->fetch_assoc()) {
                        $revFullName = $revRow["first_name"] . " " . $revRow["last_name"];

                    } ?>
                    <div class="comment">
                <div class="comment-author-ava"><img class="txtAva" data-name="<?= $revFullName ?>"></div>
                <div class="comment-body">
                    <div class="comment-header d-flex flex-wrap justify-content-between">
                        <h4 class="comment-title"><?= $revSubj ?></h4>
                        <div class="mb-2">
                            <div class="rating-stars">
                               <?= individual_ratings($revRate) ?>
                            </div>
                        </div>
                    </div>
                    <p class="comment-text"><?= $revRev ?></p>
                    <div class="comment-footer">
                    <span class="comment-meta"><?= $revFullName ?></span>
                    <div class="text-right">
                    <a class="text-<?= ((isset($_GET["approved"]))? "gray-dark":"success");  ?>" href="comments.php?<?= ((isset($_GET["approved"]))? "dabi=".$revUID:"yes=".$revUID);  ?>"><span class="icon-thumbs-up"><?= ((isset($_GET["approved"]))? "Unapproved":"Approve");  ?></span></a>&nbsp;&nbsp;
                    <a class="text-danger" href="comments.php?no=<?= $revUID ?>&pid=<?=  $pro_id ?>"><span class="icon-delete">Delete</span></a>
                    </div>
                    </div>
                </div>
            </div>

            <?php    }
            } else{
                echo "<p>No Reviews yet</p>";
            } ?>
        </div>
    </div>

</div>

</body>
</html>