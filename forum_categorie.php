<?php

const pageTitle = Lang::forum_thread;
include("controller/forum_categories.php");

include("themes/" . $_Config_['General']['theme'] . "/assets/includes/header.php");

?>


<div class="container">
    <div class="row">
        <h3 class="text-muted"><b><?php if (isset($pagetitle)) echo ucfirst(strtolower($pagetitle)); ?></b></h3>
        <h6 class="text-muted"><?php if (isset($descriptionforum)) {
                                    echo $descriptionforum;
                                } ?></h6>
        <div class="separator"></div>



        <?php if (isset($_SESSION['id'])) { ?>
            <?php if (isset($permission_write_levelhere) and isset($userrank['PERMISSION_LEVEL']) and $userrank['PERMISSION_LEVEL'] >= $permission_write_levelhere) { ?>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#postmodal" class="btn btn-<?php echo $_ThemeOption_['Personnalisation']['theme_color']; ?>"><i class="far fa-plus-square"></i> Create a topic</button>
                <div class="separator"></div>
            <?php } ?>

        <?php } ?>
        <?php if ($listpinnedmessage->rowCount() > 0) { ?>

            <div class="card mb-3">
                <div class="card-header">
                    <b><i class="fas fa-paperclip"></i> PINNED TOPICS</b>
                </div>
                <div class="card-body py-3">
                    <?php while ($cat = $listpinnedmessage->fetch()) { ?>

                        <?php
                        if ($userrank['PERMISSION_LEVEL'] >= $permission_see_levelhere) {

                            if ($cat['PINNED'] == "on") {

                                $sfm = $bdd->prepare("SELECT * FROM " . $_Config_['Database']['table_prefix'] . "_messages WHERE TOPIC_ID = ?");
                                $sfm->execute(array($cat['id']));
                                $sfm = $sfm->rowCount();


                                $author = $bdd->prepare("SELECT * FROM " . $_Config_['Database']['table_prefix'] . "_members WHERE id = ?");
                                $author->execute(array($cat['USER_ID']));
                                $author = $author->fetch();

                                if (isset($cat['BADGE_ID'])) {
                                    $badge = $bdd->prepare("SELECT * FROM " . $_Config_['Database']['table_prefix'] . "_badges WHERE id = ?");
                                    $badge->execute(array($cat['BADGE_ID']));
                                    $badgerc = $badge->rowCount();
                                }


                        ?>
                                <div class="row no-gutters align-items-center">
                                    <div class="col"><a href="?page=topic&id=<?php echo $cat['id']; ?>" class="text-big font-weight-semibold" data-abc="true"><?php if ($cat['PINNED'] == "on") {
                                                                                                                                                                    echo "<i class='fas fa-thumbtack text-danger'></i> ";
                                                                                                                                                                } ?>

                                            <?php if ($badgerc > 0) {
                                                while ($bi = $badge->fetch()) {

                                                    echo '<span class="' . $bi['SPAN'] . '">' . $bi['NAME'] . '</span>';
                                                }
                                            }
                                            ?>

                                            <?php echo ucwords($cat['NAME']); ?></a></div>
                                    <div class="d-none d-md-block col-6">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-3 text-center">

                                                <?php echo $sfm; ?> <i class="fas fa-comment"></i><br><small>Messages</small>


                                            </div>
                                            <div class="media col-3 align-items-center">

                                                <a href="?page=profile&id=<?php echo $author['id']; ?>" class="d-block text-truncate" data-abc="true"><?php echo $author['NAMETAG']; ?></a>
                                                <div class="text-muted small text-truncate"><?php echo date("d/m/Y", strtotime($cat['DATE_CREATION'])); ?> &nbsp;·&nbsp; <?php echo date("H:m", strtotime($cat['DATE_CREATION'])); ?></div>

                                                <div class="media-body flex-truncate ml-2">


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php }
                        } ?>

                    <?php } ?>
                </div>
            </div>
        <?php } ?>


        <?php if ($listcategory->rowCount() > 0) { ?>
            <div class="card mb-3">

                <div class="card-body py-3">
                    <?php while ($cat = $listcategory->fetch()) { ?>

                        <?php
                        if ($userrank['PERMISSION_LEVEL'] >= $permission_see_levelhere) {

                            $sfm = $bdd->prepare("SELECT * FROM " . $_Config_['Database']['table_prefix'] . "_messages WHERE TOPIC_ID = ?");
                            $sfm->execute(array($cat['id']));
                            $sfm = $sfm->rowCount();


                            $author = $bdd->prepare("SELECT * FROM " . $_Config_['Database']['table_prefix'] . "_members WHERE id = ?");
                            $author->execute(array($cat['USER_ID']));
                            $author = $author->fetch();

                            if (isset($cat['BADGE_ID'])) {
                                $badge = $bdd->prepare("SELECT * FROM " . $_Config_['Database']['table_prefix'] . "_badges WHERE id = ?");
                                $badge->execute(array($cat['BADGE_ID']));
                                $badgerc = $badge->rowCount();
                            }


                        ?>
                            <div class="row no-gutters align-items-center">
                                <div class="col"><a href="?page=topic&id=<?php echo $cat['id']; ?>" class="text-big font-weight-semibold" data-abc="true"><?php if ($cat['PINNED'] == "on") {
                                                                                                                                                                echo "<i class='fas fa-thumbtack text-danger'></i> ";
                                                                                                                                                            } ?>

                                        <?php if ($badgerc > 0) {
                                            while ($bi = $badge->fetch()) {

                                                echo '<span class="' . $bi['SPAN'] . '">' . $bi['NAME'] . '</span>';
                                            }
                                        }
                                        ?>

                                        <?php echo ucwords($cat['NAME']); ?></a></div>
                                <div class="d-none d-md-block col-6">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-3 text-center">

                                            <?php echo $sfm; ?> <i class="fas fa-comment"></i><br><small>Messages</small>


                                        </div>
                                        <div class="media col-3 align-items-center">

                                            <a href="?page=profile&id=<?php echo $author['id']; ?>" class="d-block text-truncate" data-abc="true"><?php echo $author['NAMETAG']; ?></a>
                                            <div class="text-muted small text-truncate"><?php echo date("d/m/Y", strtotime($cat['DATE_CREATION'])); ?> &nbsp;·&nbsp; <?php echo date("H:m", strtotime($cat['DATE_CREATION'])); ?></div>

                                            <div class="media-body flex-truncate ml-2">


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<?php if (isset($_SESSION['id'])) { ?>
    <?php if (isset($permission_write_levelhere) and isset($userrank['PERMISSION_LEVEL']) and $userrank['PERMISSION_LEVEL'] >= $permission_write_levelhere) { ?>
        <div class="modal fade" id="postmodal" tabindex="-1" aria-labelledby="postmodal" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create a topic</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">


                        <?php if (isset($error)) {
                            echo $error;
                        } ?>
                        <form method="POST">
                            <label>Topic name</label>
                            <input class="form-control" type="text" name="name"><br>
                            <label>Topic content</label>
                            <textarea id="editor1" name="content"></textarea>
                            <script>
                                CKEDITOR.replace('editor1');
                            </script>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="post_topic" class="btn btn-<?php echo $_ThemeOption_['Personnalisation']['theme_color']; ?>">Create a topic</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
<?php }
} ?>

<?php include("themes/" . $_Config_['General']['theme'] . "/assets/includes/footer.php"); ?>
