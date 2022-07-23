<?php

const pageTitle = Lang::profile_member;

include("themes/" . $_Config_['General']['theme'] . "/assets/includes/header.php");
include("controller/profile.php");

$recent = $bdd->prepare("SELECT * FROM " . $_Config_['Database']['table_prefix'] . "_topics WHERE USER_ID = ? ORDER BY DATE_CREATION DESC LIMIT 3");
$recent->execute(array($profileinfo['id']));
$recentNb = $recent->rowCount();

?>
<div class="container">
    <?php if ($profileinfo['STATUS'] == 2) { ?>
        <div class="row">
            <div class="alert alert-danger text-center" role="alert">
                <b><i class="far fa-bell"></i></b> This account is not active anymore. It has been banned because of a violation of our rules.<br>
            </div>
        </div>
    <?php } ?>

    <div class="row ">
        <div class="col-4">
            <div class="card mb-3">
                <div class="card-body py-3">
                    <div class="d-grid gap-2">
                        <div class="d-flex flex-column align-items-center text-center">
                            <?php if ($profileinfo['STATUS'] == 2) { ?>
                                <img src="themes/uploaded/profiles/default.png" alt="Profile avatar" class="rounded-circle" width="150">
                            <?php } else { ?>
                                <img src="themes/uploaded/profiles/<?php echo $profileinfo['AVATAR_PATH']; ?>" alt="Profile avatar" class="rounded-circle" width="150">
                            <?php } ?>
                            <div class="mt-3">
                                <h4>
                                    <?php if ($profileinfo['STATUS'] == 2) {
                                        echo "Member #" . $profileinfo['id'];
                                    } else {
                                        echo $profileinfo['NAMETAG'];
                                    } ?>
                                </h4>
                                <small><?php if (isset($_Config_['Additional']['email_display']) AND $_Config_['Additional']['email_display'] == 'true') {
                                            echo $profileinfo['MAIL'];
                                        } ?></small>
                                <p class="text-secondary mb-1">

                                    <?php if ($profileinfo['STATUS'] == 2) {
                                        echo "Unknown member"; ?>
                                    <?php } else { ?>
                                        <?php if ($profilerank['DISPLAY'] > 0) { ?><span class="badge <?php echo $profilerank['BADGE_COLOR']; ?>"><?php echo strtoupper($profilerank['NAME']); ?></span><br>
                                        <?php } else {
                                            echo "New member";
                                        } ?>
                                        <?php if ($profilerank['PERMISSION_LEVEL'] >= $_Config_['General']['staff_permission_level']) { ?><span class="badge bg-secondary">Staff member</span>
                                        <?php } ?>
                                    <?php } ?>


                                </p>
                                <p class="text-muted font-size-sm">Registered on
                                    <?php echo date("d/m/Y", strtotime($profileinfo['DATE_CREATION'])); ?>
                                </p>
                            </div>
                        </div>
                        <?php if ($profileinfo['STATUS'] != 2) { ?>
                            <?php if (!empty($profileinfo['DISCORD'])) { ?> <a class="btn btn-outline-dark"><i class="fab fa-discord"></i> <?php echo $profileinfo['DISCORD']; ?></a>
                            <?php } ?>

                            <?php if (!empty($profileinfo['TWITTER'])) { ?> <a href="https://twitter.com/<?php echo $profileinfo['TWITTER']; ?>" class="btn btn-outline-dark"><i class="fab fa-twitter"></i> <?php echo $profileinfo['TWITTER']; ?></a>
                            <?php } ?>
                            <?php if (isset($_Config_['Additional']['birthday_display']) AND $_Config_['Additional']['birthday_display'] == 'true') { ?>
                                <?php if (!empty($profileinfo['BIRTHDAY'])) { ?> <a class="btn btn-outline-success"><i class="fas fa-birthday-cake"></i> <?php echo date("jS \of F", strtotime($profileinfo['BIRTHDAY'])); ?></a>
                                <?php } ?>
                            <?php } ?>

                            <?php if (!empty($profileinfo['GITHUB'])) { ?> <a href="https://github.com/<?php echo $profileinfo['GITHUB']; ?>" class="btn btn-outline-dark"><i class="fab fa-github"></i> <?php echo $profileinfo['GITHUB']; ?></a>
                            <?php } ?>
                            <?php if (!empty($profileinfo['WEBSITE'])) { ?> <a href="<?php echo $profileinfo['WEBSITE']; ?>" class="btn btn-outline-dark"><i class="fas fa-sitemap"></i> Member's own website</a>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card mb-3">
                <div class="card-body py-3">
                    <div class="row">
                        <div class="col-4 text-center">
                            <b><?php echo $lof->rowCount(); ?></b><br> <?php echo Lang::forum_messages; ?>
                        </div>
                        <div class="col-4 text-center">
                            <b><?php echo $rs; ?></b><br> <?php echo Lang::profile_reactionscore; ?>
                        </div>
                        <div class="col-4 text-center">
                            <b><?php echo $lot->rowCount(); ?></b><br> <?php echo Lang::forum_thread; ?>
                        </div>

                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-body py-3">
                    <b><?php echo strtoupper(Lang::forum_about); ?> <?php if ($profileinfo['STATUS'] == 2) {
                                        echo strtoupper("Member #" . $profileinfo['id']);
                                    } else {
                                        echo strtoupper($profileinfo['NAMETAG']);
                                    } ?></b>
                    <hr>
                    <?php if ($profileinfo['STATUS'] == 2) {
                        echo "No description given";
                    } else {
                        echo htmlspecialchars($profileinfo['ABOUT']);
                    } ?>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-body py-3">
                    <b>LAST THREADS</b>
                    <hr>
                    <?php if ($recentNb < 1 OR $profileinfo['STATUS'] == 2) { 
                        echo "<p class='text-center'>" . Lang::forum_no_topics . "</p>";
                    } else {
                    ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php

                                while ($r = $recent->fetch()) {
                                    if (isset($r['BADGE_ID'])) {
                                        $badge = $bdd->prepare("SELECT * FROM " . $_Config_['Database']['table_prefix'] . "_badges WHERE id = ?");
                                        $badge->execute(array($r['BADGE_ID']));
                                    }

                                ?>

                                    <tr>
                                        <th><a href="?page=topic&id=<?php echo $r['id']; ?>"><?php if(isset($badge)) while ($bi = $badge->fetch()) {
                                                                                                    echo '<span class="' . $bi['SPAN'] . '">' . $bi['NAME'] . '</span> ';
                                                                                                } ?><?php echo $r['NAME']; ?></a></th>
                                        <td>
                                            <?php echo date("d/m/Y · H:m", strtotime($r['DATE_CREATION'])); ?>
                                        </td>
                                    </tr>

                                <?php } ?>
                            </tbody>
                        </table>
                    <?php } ?>
                </div>
            </div>
        </div>

    </div>
</div>

<?php include("themes/" . $_Config_['General']['theme'] . "/assets/includes/footer.php"); ?>