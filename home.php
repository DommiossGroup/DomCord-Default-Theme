<?php

const pageTitle = Lang::label_home;

include("themes/" . $_Config_['General']['theme'] . "/assets/includes/header.php");

$listcategory = $bdd->query("SELECT * FROM " . $_Config_['Database']['table_prefix'] . "_category ORDER BY ORDER_LISTING");

if (!(isset($_SESSION['id']))) $userrank['PERMISSION_LEVEL'] = 1;

?>
<div class="container">

    <div class="row">
        <h3 class="text-muted"><b><?php echo $_Config_['General']['name']; ?></b></h3>

        <?php if ($_maintenance_['status'] == "true") { ?>
            <div class="alert alert-danger text-center">
                <strong><i class="fas fa-exclamation-circle"></i></strong> <?php echo Lang::maintenance_superadmin; ?>
            </div>
        <?php } ?>

        <div class="alert alert-primary text-center alert-dismissible fade show" role="alert">
            <b><i class="far fa-bell"></i></b> <?php echo Lang::pub_alert.'<br>'.Lang::thank_you; ?> !
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    <?php while ($cat = $listcategory->fetch()) { ?>

        <?php
        if ($userrank['PERMISSION_LEVEL'] >= $cat['PERMISSION_SEE_LEVEL']) {

            $lffc =  $bdd->prepare("SELECT * FROM " . $_Config_['Database']['table_prefix'] . "_forum WHERE PARENT_ID = ? ORDER BY ORDER_LISTING");
            $lffc->execute(array($cat['id']));



        ?>
            <div class="row">
                <div class="category">
                    <h5><b><?php echo ucfirst(strtolower($cat['NAME'])); ?></b></h5>
                    <?php while ($f = $lffc->fetch()) {

                        $msgnumber = $bdd->prepare("SELECT * FROM " . $_Config_['Database']['table_prefix'] . "_messages WHERE FORUM_ID = ?");
                        $msgnumber->execute(array($f['id']));
                        $msgnumber = $msgnumber->rowCount();

                        $msgtopic = $bdd->prepare("SELECT * FROM " . $_Config_['Database']['table_prefix'] . "_topics WHERE FORUM_ID = ?");
                        $msgtopic->execute(array($f['id']));
                        $msgtopic = $msgtopic->rowCount();

                        if ($userrank['PERMISSION_LEVEL'] >= $f['PERMISSION_SEE_LEVEL']) {


                    ?>
                            <div class="card">
                                <div class="card-body py-3">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col">
                                            <a href="?page=forum_categorie&id=<?php echo $f['id']; ?>" class="text-big font-weight-semibold" data-abc="true">
                                                <?php if (!empty($f['ICON'])) {
                                                    echo '<i class="' . $f['ICON'] . '"></i> ';
                                                } else {
                                                    echo '<i class="fas fa-comment-alt"></i> ';
                                                } ?> <?php echo $f['NAME']; ?></a>
                                            <?php if (!empty($f['DESCRIPTION'])) {
                                                echo '<br><a class="text-muted" data-abc="true">' . $f['DESCRIPTION'] . '</a>';
                                            } ?>


                                        </div>
                                        <div class="d-none d-md-block col-6">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-3 text-center">

                                                    <?php echo $msgtopic; ?><br><small><?php echo Lang::forum_thread; ?></small>


                                                </div>
                                                <div class="col-3 text-center">

                                                    <?php echo $msgnumber; ?><br><small><?php echo Lang::forum_messages; ?></small>


                                                </div>
                                                <div class="media col-3 align-items-center">
                                                    <div class="text-muted small text-truncate">

                                                        <?php

                                                        $lastmessage = $bdd->query("SELECT * FROM " . $_Config_['Database']['table_prefix'] . "_topics WHERE FORUM_ID = " . $f['id'] . " ORDER BY DATE_CREATION DESC LIMIT 1");

                                                        if ($lastmessage->rowCount() > 0) {
                                                            while ($r = $lastmessage->fetch()) {


                                                                $author = $bdd->prepare("SELECT * FROM " . $_Config_['Database']['table_prefix'] . "_members WHERE id = ?");
                                                                $author->execute(array($r['USER_ID']));
                                                                $author = $author->fetch();


                                                                if (isset($r['BADGE_ID']) and !empty($r['BADGE_ID'])) {
                                                                    $badge = $bdd->prepare("SELECT * FROM " . $_Config_['Database']['table_prefix'] . "_badges WHERE id = ?");
                                                                    $badge->execute(array($r['BADGE_ID']));
                                                                    $badgerc = $badge->rowCount();
                                                                }

                                                        ?>
                                                                <a href="?page=topic&id=<?php echo $r['id']; ?>" class="d-block text-truncate" data-abc="true"><?php if (isset($badgerc) AND $badgerc > 0) {
                                                                                                                                                                    while ($bi = $badge->fetch()) {

                                                                                                                                                                        echo '<span class="' . $bi['SPAN'] . '">' . $bi['NAME'] . '</span> ';
                                                                                                                                                                    }
                                                                                                                                                                }
                                                                                                                                                                ?><?php echo $r['NAME']; ?></a>
                                                                <?php echo date("d/m/Y", strtotime($r['DATE_CREATION'])); ?> &nbsp;·&nbsp;<a href="?page=profile&id=<?php echo $author['id']; ?>" class="text-muted" data-abc="true"><?php echo $author['NAMETAG']; ?></a><?php }
                                                                                                                                                                                                                                                                    } else { ?>
                                                            <a class="text-muted" data-abc="true"><?php echo Lang::forum_no_topics; ?></a>
                                                        <?php } ?>
                                                    </div>

                                                    <div class="media-body flex-truncate ml-2">


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="small-separator"></div>
                    <?php }
                    } ?>
                </div>
            </div>
            <div class="medium-separator"></div>
        <?php } ?>
    <?php } ?>
</div>

<?php include("themes/" . $_Config_['General']['theme'] . "/assets/includes/footer.php"); ?>
