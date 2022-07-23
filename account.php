<?php

const pageTitle = Lang::title_account;
$needconnection = true;

include("themes/" . $_Config_['General']['theme'] . "/assets/includes/header.php");
include("controller/edit_profile.php");

if (isset($_GET['subpage'])) {
    $subpage = htmlspecialchars($_GET['subpage']);
} else {
    $subpage = "home";
}
?>

<div class="container">
    <div class="row">
        <h3 class="text-muted"><b><?php echo pageTitle; ?></b></h3>
        <div class="separator"></div>

        <div class="col-md-12">


            <?php if (isset($error)) {
                echo $error;
            } ?>
            <div class="row ">
                <div class="col-4">
                    <div class="d-grid gap-2">

                        <a href="?page=account" class="btn btn<?php if ($subpage !== "home") {
                                                                    echo "-outline";
                                                                } ?>-primary">Account details</a>
                        <a href="?page=account&subpage=change_photo" class="btn btn<?php if ($subpage !== "change_photo") {
                                                                                        echo "-outline";
                                                                                    } ?>-primary">Change avatar</a>
                        <a href="?page=account&subpage=edit" class="btn btn<?php if ($subpage !== "edit") {
                                                                                echo "-outline";
                                                                            } ?>-primary">Edit account</a>
                        <a href="?page=account&subpage=signature" class="btn btn<?php if ($subpage !== "signature") {
                                                                                    echo "-outline";
                                                                                } ?>-primary">Signature</a>
                    </div>
                </div>
                <div class="col-8">
                    <?php if ($subpage == "home") { ?>
                        <div class="d-grid gap-2">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="themes/uploaded/profiles/<?php echo $userinfo['AVATAR_PATH']; ?>" alt="Profile avatar" class="rounded-circle" width="150">
                                <div class="mt-3">
                                    <h4><?php echo $userinfo['NAMETAG']; ?></h4>
                                    <p class="text-secondary mb-1">

                                        <?php if ($userrank['DISPLAY'] > 0) { ?><span class="badge <?php echo $userrank['BADGE_COLOR']; ?>"><?php echo strtoupper($userrank['NAME']); ?></span><br><?php } else {
                                                                                                                                                                                                    echo "New member";
                                                                                                                                                                                                } ?>
                                        <?php if ($userrank['PERMISSION_LEVEL'] > $_Config_['General']['staff_permission_level']) { ?><span class="badge bg-secondary">Staff member</span><?php } ?>

                                    </p>
                                    <p class="text-muted font-size-sm">Registered on <?php echo date("d/m/Y", strtotime($userinfo['DATE_CREATION'])); ?></p>
                                </div>
                            </div>
                            <?php if (!empty($userinfo['DISCORD'])) { ?> <a class="btn btn-outline-primary"><i class="fab fa-discord"></i> <?php echo $userinfo['DISCORD']; ?></a> <?php } ?>

                            <?php if (!empty($userinfo['TWITTER'])) { ?> <a href="https://twitter.com/<?php echo $userinfo['TWITTER']; ?>" class="btn btn-outline-primary"><i class="fab fa-twitter"></i> <?php echo $userinfo['TWITTER']; ?></a> <?php } ?>

                            <?php if (!empty($userinfo['BIRTHDAY'])) { ?> <a class="btn btn-outline-success"><i class="fas fa-birthday-cake"></i> <?php echo date("jS \of F", strtotime($userinfo['BIRTHDAY'])); ?></a> <?php } ?>


                            <?php if (!empty($userinfo['GITHUB'])) { ?> <a href="https://github.com/<?php echo $userinfo['GITHUB']; ?>" class="btn btn-outline-primary"><i class="fab fa-github"></i> <?php echo $userinfo['GITHUB']; ?></a> <?php } ?>
                            <?php if (!empty($userinfo['WEBSITE'])) { ?> <a href="<?php echo $userinfo['WEBSITE']; ?>" class="btn btn-outline-primary"><i class="fas fa-sitemap"></i> Member's own website</a> <?php } ?>
                        </div><br><a href="?page=account&subpage=edit">See details</a>
                    <?php } else if ($subpage == "change_photo") { ?>
                        <form method="POST" enctype="multipart/form-data">


                            <label>Profile icon</label> <small>(Max. 2 Mo)</small>
                            <input type="file" name="avatar" class="form-control">
                            <br>
                            Please note that your avatar must comply with our terms of service
                            <hr>
                            <input type="submit" name="edit_profile" value="Edit" class="btn btn-outline-primary">
                            <input type="submit" name="delete_avatar" value="Reset avatar" class="btn btn-outline-danger">

                        </form>
                    <?php } else if ($subpage == "edit") { ?>
                        <form method="POST">

                            <label>Username</label>
                            <input type="text" class="form-control" name="nametag" value="<?php echo $userinfo['NAMETAG']; ?>"><br>
                            <label>Description</label>
                            <textarea class="form-control" name="description"><?php echo $userinfo['ABOUT']; ?></textarea><br>


                            <label>Github</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon3">github.com/</span>
                                <input type="text" class="form-control border-primary" name="github" value='<?php echo $userinfo["GITHUB"]; ?>'>
                            </div>
                            <label>Discord</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon3"><i class="fab fa-discord"></i></span>
                                <input type="text" class="form-control border-primary" name="discord" value='<?php echo $userinfo["DISCORD"]; ?>'>
                            </div>
                            <label>Twitter</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon3">twitter.com/</span>
                                <input type="text" class="form-control border-primary" name="twitter" value='<?php echo $userinfo["TWITTER"]; ?>'>
                            </div>
                            <label>Website</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon3"><i class="fas fa-sitemap"></i></span>
                                <input type="text" class="form-control border-primary" name="website" value='<?php echo $userinfo["WEBSITE"]; ?>'>
                            </div>
                            <br>

                            <input type="submit" name="edit_account" class="btn btn-outline-primary">

                        </form>
                    <?php } else if ($subpage == "signature") { ?>
                        <form method="POST">

                            <label>Signature</label>
                            <textarea id="editor1" name="signature"><?php echo $userinfo['SIGNATURE']; ?></textarea>
                            <script>
                                CKEDITOR.replace('editor1');
                            </script>
                            <br>

                            <input type="submit" name="edit_signature" class="btn btn-outline-primary">

                        </form>
                    <?php } ?>
                </div>

            </div>
        </div>

    </div>
</div>

<?php include("themes/" . $_Config_['General']['theme'] . "/assets/includes/footer.php"); ?>