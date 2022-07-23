<?php

const pageTitle = Lang::forum_topic;

include("controller/topic.php");
include("themes/" . $_Config_['General']['theme'] . "/assets/includes/header.php");

?>


<div class="container">
    <div class="row">
        <h3 class="text-muted"><b><?php echo pageTitle; ?></b></h3>
        <h6 class="text-muted"><?php if (isset($descriptionforum)) {
                                    echo $descriptionforum;
                                } ?></h6>
        <div class="separator"></div>

        <?php if (isset($_SESSION['id']) and $userrank['ADMIN_TOPIC_EDIT'] == "on") { ?>
            <a type="button" class="text-purple" data-bs-toggle="modal" data-bs-target="#editmodal"><i class="fas fa-cog"></i> Moderation tools</a>
            <div class="separator"></div>

            <div class="modal fade text-dark" id="editmodal" tabindex="-1" aria-labelledby="editmodal" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit topic</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">


                            <?php if (isset($error)) {
                                echo $error;
                            } ?>
                            <form method="POST">
                                <?php if ($userrank['ADMIN_TOPIC_PREFIXCHANGE'] == "on") { ?>
                                    <label>Topic badge</label>
                                    <select class="form-control" name="badge">
                                        <option value="0">Any prefix</option>
                                        <?php

                                        $lb = $bdd->query("SELECT * FROM " . $_Config_['Database']['table_prefix'] . "_badges");
                                        while ($r = $lb->fetch()) {


                                        ?>

                                            <option <?php if ($sfc['BADGE_ID'] == $r['id']) {
                                                        echo "selected";
                                                    } ?> value="<?php echo $r['id']; ?>" class="<?php echo $r['SPAN']; ?>"><?php echo $r['NAME']; ?></option>

                                        <?php } ?>

                                    </select><br>
                                <?php } ?>

                                <label>Topic name</label>
                                <input class="form-control" type="text" name="name" value="<?php echo $sfc['NAME']; ?>"><br>
                                <div class="row text-center">
                                    <div class="col-6">
                                        <label>Pin</label><br>
                                        <input <?php if ($sfc['PINNED'] == "on") {
                                                    echo "checked";
                                                } ?> class="form-check-input" type="checkbox" name="pinned">
                                    </div>
                                    <div class="col-6">
                                        <label>Lock thread</label><br>
                                        <input <?php if ($sfc['STATUT'] == "1") {
                                                    echo "checked";
                                                } ?> class="form-check-input" type="checkbox" name="lock">
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" name="edit_topic" class="btn btn-<?php echo $_ThemeOption_['Personnalisation']['theme_color']; ?>">Edit a topic</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>

        <div class="col-md-12">


            <?php if($lom) while ($m = $lom->fetch()) {
                $author = $bdd->prepare("SELECT * FROM " . $_Config_['Database']['table_prefix'] . "_members WHERE id = ?");
                $author->execute(array(htmlspecialchars($m['USER_ID'])));
                $author = $author->fetch();


                $authorrank = $bdd->prepare("SELECT * FROM " . $_Config_['Database']['table_prefix'] . "_ranks WHERE id = ?");
                $authorrank->execute(array($author['RANK_ID']));
                $authorrank = $authorrank->fetch();

                $isreport = $bdd->prepare("SELECT * FROM " . $_Config_['Database']['table_prefix'] . "_reports WHERE MESSAGE_ID = ?");
                $isreport->execute(array($m['id']));
                $isreport = $isreport->rowCount();


            ?>

                <?php if ($m['STATUS'] == 0) { ?>
                    <div class="card mb-3">
                        <div class="card-header bg-purple">
                            <div class="col-8">
                                <a href="?page=profile&id=<?php echo $author['id']; ?>" class="<?php echo "text-" . $_ThemeOption_['Personnalisation']['text_image_color'] . ""; ?>"><img src="themes/uploaded/profiles/<?php echo $author['AVATAR_PATH']; ?>" alt="Profile avatar" class="rounded-circle" style='width: 32px;'> <?php echo $author['NAMETAG']; ?></a>

                                <?php if ($authorrank['DISPLAY'] > 0) { ?><span class="badge <?php echo $authorrank['BADGE_COLOR']; ?>"><?php echo strtoupper($authorrank['NAME']); ?></span><?php } else {
                                                                                                                                                                                                echo "New member";
                                                                                                                                                                                            } ?>
                                <?php if ($authorrank['PERMISSION_LEVEL'] > $_Config_['General']['staff_permission_level']) { ?><span class="badge bg-secondary">Staff member</span><?php } ?>

                            </div>
                            <div class="col-4 float-right">

                                <?php if (isset($userrank['MESSAGE_DELETE']) AND $userrank['MESSAGE_DELETE'] == "on") { ?>
                                    <a href="?page=topic&id=<?php echo htmlspecialchars($_GET['id']); ?>&action=delete&messageid=<?php echo $m['id']; ?>" type="button" class="text-white"><i class="fa-solid fa-trash-can"></i></a>
                                <?php } ?>

                                <?php if (isset($_SESSION['id']) and $isreport < 1 and $author['id'] != $userinfo['id']) { ?>
                                    <a href="?page=topic&id=<?php echo htmlspecialchars($_GET['id']); ?>&action=report&messageid=<?php echo $m['id']; ?>" class="text-white" type="button"><i class="fa-solid fa-flag"></i></a>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="card-body py-3">
                            <div class="row ">
                                <div class="col-8">
                                    <div class="d-grid gap-2">
                                        <div class="d-flex flex-column">
                                            <?php echo $m['CONTENT']; ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><?php if (isset($author['SIGNATURE']) and !empty($author['SIGNATURE'])) { ?><div class="card-footer"><?php echo $author['SIGNATURE']; ?></div>
                        <?php } ?>

                    </div>
                    <?php } else {

                    if ($userrank['PERMISSION_LEVEL'] >= $_Config_['General']['staff_permission_level']) {
                        // Deleted message viewable only by staff
                    ?>
                        <p>
                        <div class="alert alert-danger"><b><i class="fas fa-exclamation-circle text-danger"></i></b> Message deleted from <?php echo $author['NAMETAG']; ?> posted on <?php echo date("d/m/Y - H:m", strtotime($m['DATE_POST'])); ?> | <a data-bs-toggle="collapse" href="#deleted-<?php echo $m['id']; ?>" role="button" aria-expanded="false" aria-controls="#deleted-<?php echo $m['id']; ?>">
                                Show...
                            </a>
                            </p>
                            <div class="collapse" id="deleted-<?php echo $m['id']; ?>">

                                <div class="card mb-3 text-dark">
                                    <div class="card-header bg-purple">
                                        <div class="col-8">
                                            <a href="?page=profile&id=<?php echo $author['id']; ?>" class="<?php echo "text-" . $_ThemeOption_['Personnalisation']['text_image_color'] . ""; ?>"><img src="themes/uploaded/profiles/<?php echo $author['AVATAR_PATH']; ?>" alt="Profile avatar" class="rounded-circle" style='width: 32px;'> <?php echo $author['NAMETAG']; ?></a>

                                            <?php if ($authorrank['DISPLAY'] > 0) { ?><span class="badge <?php echo $authorrank['BADGE_COLOR']; ?>"><?php echo strtoupper($authorrank['NAME']); ?></span><?php } else {
                                                                                                                                                                                                            echo "New member";
                                                                                                                                                                                                        } ?>
                                            <?php if ($authorrank['PERMISSION_LEVEL'] > $_Config_['General']['staff_permission_level']) { ?><span class="badge bg-secondary">Staff member</span><?php } ?>

                                        </div>
                                        <div class="col-4 float-right">

                                            <?php if (isset($userrank['MESSAGE_DELETE']) AND $userrank['MESSAGE_DELETE'] == "on") { ?>
                                                <a href="?page=topic&id=<?php echo htmlspecialchars($_GET['id']); ?>&action=repost&messageid=<?php echo $m['id']; ?>" type="button" class="text-white"><i class="fa-solid fa-share"></i></a>
                                            <?php } ?>

                                        </div>
                                    </div>
                                    <div class="card-body py-3">
                                        <div class="row ">
                                            <div class="col-8">
                                                <div class="d-grid gap-2">
                                                    <div class="d-flex flex-column">
                                                        <?php echo $m['CONTENT']; ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><?php if (isset($author['SIGNATURE']) and !empty($author['SIGNATURE'])) { ?><div class="card-footer"><?php echo $author['SIGNATURE']; ?></div>
                                    <?php } ?>

                                </div>
                            </div>
                        </div><?php }
                        }
                    } ?>

            <?php if ($sfc['STATUT'] == "1") { ?>
                <div class="alert alert-warning text-center">
                    <i class="fa-solid fa-lock" aria-hidden="true"></i> <?= Lang::topic_locked; ?>
                </div>
            <?php } else { ?>
                <?php if (!(isset($_SESSION['id']))) { ?>

                    <div class="alert alert-danger text-center">
                        <i class="fa-solid fa-lock" aria-hidden="true"></i> <?= Lang::topic_reply_unlogin; ?>
                    </div>
                <?php } ?>
                <?php if (isset($_SESSION['id'])) {

                    if ($cfp['PERMISSION_WRITE_LEVEL'] > $userrank['PERMISSION_LEVEL']) {
                ?>

                        <div class="alert alert-danger text-center">
                            <i class="fa-solid fa-lock" aria-hidden="true"></i> <?= Lang::topic_reply_notperms; ?>
                        </div>


                    <?php } else { ?>
                        <div class="card mb-3">
                            <div class="card-body py-3">

                                <div class="row"><?php if (isset($error)) {
                                                        echo $error;
                                                    } ?><form method="POST">
                                        <textarea id="editor1" name="content"></textarea>
                                        <script>
                                            // Replace the <textarea id="editor1"> with a CKEditor 4
                                            // instance, using default configuration.
                                            CKEDITOR.replace('editor1');
                                        </script>
                                        <hr>
                                        <button type="submit" name="reply" class="btn btn-outline-<?php echo $_ThemeOption_['Personnalisation']['theme_color']; ?>">Reply</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                <?php } ?>
            <?php } ?>
        </div>
    </div>
</div>
</div>
</div>

<?php include("themes/" . $_Config_['General']['theme'] . "/assets/includes/footer.php"); ?>