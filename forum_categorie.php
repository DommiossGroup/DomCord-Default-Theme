<?php

if (!(isset($_SESSION['id']))) {


    $userrank['PERMISSION_LEVEL'] = 1;
}

include("controller/forum_categories.php");



?>
<style>
    .mt-100 {
        margin-top: 100px
    }

    .card {
        box-shadow: 0 0.46875rem 2.1875rem rgba(4, 9, 20, 0.03), 0 0.9375rem 1.40625rem rgba(4, 9, 20, 0.03), 0 0.25rem 0.53125rem rgba(4, 9, 20, 0.05), 0 0.125rem 0.1875rem rgba(4, 9, 20, 0.03);
        border-width: 0;
        transition: all .2s
    }

    .card-header:first-child {
        border-radius: calc(.25rem - 1px) calc(.25rem - 1px) 0 0
    }

    .card-header {
        display: flex;
        align-items: center;
        border-bottom-width: 1px;
        padding-top: 0;
        padding-bottom: 0;
        padding-right: .625rem;
        height: 3.5rem;
        background-color: #fff;
        border-bottom: 1px solid rgba(26, 54, 126, 0.125)
    }

    .card-body {
        flex: 1 1 auto;
        padding: 1.25rem
    }

    .flex-truncate {
        min-width: 0 !important
    }

    .d-block {
        display: block !important
    }

    a {
        color: #E91E63;
        text-decoration: none !important;
        background-color: transparent
    }

    .media img {
        width: 40px;
        height: auto
    }
</style>


<body id="page-top">
    <!-- Navigation-->
    <!-- Header-->
    <header class="text-white" style="background-image: url('<?php echo $_ThemeOption_['Personnalisation']['background_img']; ?>'); background-size: cover;">
        <div class="container px-4 text-center">
            <h1 class="fw-bolder <?php echo "text-" . $_ThemeOption_['Personnalisation']['text_image_color'] . ""; ?>"><?php echo $pagetitle; ?></h1>
        </div>
    </header>
    <!-- Services section--><?php if ($_maintenance_['status'] == "true") { ?><div class="alert alert-danger"><strong><i class="fas fa-exclamation-circle"></i></strong> Your website is actually under maintenance. Only ranks with "SUPERADMIN" permission can access to the website.</div><?php } ?>
    <section>
        <div class="container-fluid">
            <div class="row">
                <?php if (isset($_SESSION['id'])) {
                    $lfff = $bdd->prepare("SELECT * FROM " . $_Config_['Database']['table_prefix'] . "_follow WHERE TYPE = 'FORUM' AND SPACE_ID = ? AND USER_ID = ?");
                    $lfff->execute(array(htmlspecialchars($_GET['id']), $userinfo['id']));
                    $lfff = $lfff->rowCount();
                ?>
                    <div class="col-10"></div>
                    <div class="col-2">
                        <?php if ($lfff > 0) { ?>
                            <form method="POST"><button type="submit" name="follow" class="btn btn-<?php echo $_ThemeOption_['Personnalisation']['theme_color']; ?> btn-sm"><i class="fas fa-external-link-alt"></i> Unfollow forum</button></form>
                            <br>
                    </div>
                <?php } else { ?>
                    <form method="POST"><button type="submit" name="follow" class="btn btn-<?php echo $_ThemeOption_['Personnalisation']['theme_color']; ?> btn-sm"><i class="fas fa-external-link-alt"></i> Follow forum</button></form>
                    <br>
            </div><?php } ?>
    <?php } ?>
    <div class="col-md-12">

        <div id="forum_<?php echo $pagetitle; ?>" class="card mb-3 <?php echo "text-" . $_ThemeOption_['Personnalisation']['text_image_color'] . ""; ?>" style="background-image: url('<?php echo $_ThemeOption_['Personnalisation']['background_img']; ?>'); background-size: cover;">
            <div class="card-header pr-0 pl-0" style="background-image: url('<?php echo $_ThemeOption_['Personnalisation']['background_img']; ?>'); background-size: cover;">
                <div class="row no-gutters align-items-center w-100">
                    <div class="col font-weight-bold pl-3">
                        <div class="row">
                            <div class="col-10">
                                <a href="#forum_<?php echo $pagetitle; ?>" class="<?php echo "text-" . $_ThemeOption_['Personnalisation']['text_image_color'] . ""; ?>"><b><?php echo strtoupper($pagetitle); ?></b></a>
                            </div>
                            <?php if (isset($_SESSION['id'])) { ?>
                                <?php if ($permission_write_levelhere < $userrank['PERMISSION_LEVEL']) { ?>
                                    <div class="col-2 <?php echo "text-" . $_ThemeOption_['Personnalisation']['text_image_color'] . ""; ?>">
                                        <button type="button" class="btn btn-<?php echo $_ThemeOption_['Personnalisation']['theme_color']; ?>" data-bs-toggle="modal" data-bs-target="#postmodal" class="btn btn-<?php echo $_ThemeOption_['Personnalisation']['theme_color']; ?>"><i class="far fa-plus-square"></i> Create a topic</button>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-2 <?php echo "text-" . $_ThemeOption_['Personnalisation']['text_image_color'] . ""; ?>">
                                        <button disabled class="btn btn-outline-<?php echo $_ThemeOption_['Personnalisation']['theme_color']; ?>"><i class="far fa-stop-circle"></i> <strike>Create a topic</strike></button>
                                    </div>
                                <?php } ?>

                            <?php } ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php if ($listpinnedmessage->rowCount() > 0) { ?>
            <div class="card mb-3">

                <div class="card-header bg-secondary py-3">
                    <b class="text-white"><i class="fas fa-paperclip"></i> PINNED TOPICS</b>
                </div>
                <div class="card-body py-3">
                    <?php while ($cat = $listpinnedmessage->fetch()) { ?>

                        <?php
                        if ($cat['PERMISSION_SEE_LEVEL'] < $userrank['PERMISSION_LEVEL']) {

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
                        if ($cat['PERMISSION_SEE_LEVEL'] < $userrank['PERMISSION_LEVEL']) {

                            $lffc =  $bdd->prepare("SELECT * FROM " . $_Config_['Database']['table_prefix'] . "_forum WHERE PARENT_ID = ? ORDER BY ORDER_LISTING");
                            $lffc->execute(array($cat['id']));


                            $sfm = $bdd->prepare("SELECT * FROM " . $_Config_['Database']['table_prefix'] . "_messages WHERE TOPIC_ID = ?");
                            $sfm->execute(array($cat['id']));
                            $sfm = $sfm->rowCount();


                            $author = $bdd->prepare("SELECT * FROM " . $_Config_['Database']['table_prefix'] . "_members WHERE id = ?");
                            $author->execute(array($cat['USER_ID']));
                            $author = $author->fetch();

                            if (isset($cat['BADGE_ID']) and !empty($cat['BADGE_ID'])) {
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

                                                echo '<span class="' . $bi['SPAN'] . '">' . $bi['NAME'] . '</span> ';
                                            }
                                        }
                                        ?><?php echo ucwords($cat['NAME']); ?></a></div>
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
            <?php } else {
            if ($listpinnedmessage->rowCount() == 0) {
            ?>

                This forum is empty.

        <?php }
        } ?>

    </div>
        </div>
        </div>
    </section>
    <!-- Button trigger modal -->

    <!-- Modal -->
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

    <!-- Footer-->
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>