<?php

const pageTitle = Lang::title_members;

include("themes/" . $_Config_['General']['theme'] . "/assets/includes/header.php");
include("controller/members.php");

?>

<div class="container">
    <div class="row">
        <h3 class="text-muted"><b><?php echo pageTitle; ?></b></h3>
        <div class="separator"></div>


        <div class="col-md-12">


            <?php if (isset($error)) {
                echo $error;
            } ?>

            <div class="card mb-3">
                <div class="card-body py-3">
                    <div class="row ">
                        <div class="col-4">
                            <div class="d-grid gap-2">
                                <a href="?page=members" class="btn btn<?php if ($page !== "user") {
                                                                            echo '-outline';
                                                                        } ?>-primary">User List</a>
                                <a href="?page=members&type=staff" class="btn btn<?php if ($page !== "staff") {
                                                                                        echo '-outline';
                                                                                    } ?>-primary">Staff List</a>
                            </div>
                        </div>
                        <div class="col-8">
                            <?php if ($page == "user") { ?>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Username</th>
                                            <th scope="col">Messages</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        while ($r = $memberslist->fetch()) {

                                            $messagenumber = $bdd->prepare("SELECT * FROM " . $_Config_['Database']['table_prefix'] . "_messages WHERE USER_ID = ?");
                                            $messagenumber->execute(array($r['id']));
                                            $messagenumber = $messagenumber->rowCount();

                                        ?>
                                            <tr>
                                                <td><a href="?page=profile&id=<?php echo $r['id']; ?>" class="text-dark"><img class="rounded-circle z-depth-2" width="30" height="30" src="themes/uploaded/profiles/<?php echo $r['AVATAR_PATH']; ?>" data-holder-rendered="true"> <?php echo $r['NAMETAG']; ?></a></td>
                                                <td><?php echo $messagenumber; ?> <i class="fas fa-comment-dots"></i></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            <?php } elseif ($page == "staff") { ?>

                                <div class="container">
                                    <div class="row justify-content-center">
                                        <?php

                                        $stafflist = $bdd->query("SELECT * FROM " . $_Config_['Database']['table_prefix'] . "_members");
                                        while ($r = $stafflist->fetch()) {

                                            $staffrank = $bdd->prepare("SELECT * FROM " . $_Config_['Database']['table_prefix'] . "_ranks WHERE id = ?");
                                            $staffrank->execute(array($r['RANK_ID']));
                                            $staffrank = $staffrank->fetch();
                                            if ($staffrank['PERMISSION_LEVEL'] >= $_Config_['General']['staff_permission_level']) {

                                        ?>
                                                <div class="col-12 col-sm-6 col-lg-4">
                                                    <div class="single_advisor_profile wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                                                        <!-- Team Thumb-->
                                                        <div class="advisor_thumb"><img src="themes/uploaded/profiles/<?php echo $r['AVATAR_PATH']; ?>" height="250" widht="250">
                                                            <!-- Social Info-->
                                                            <div class="social-info">

                                                                <?php if (!empty($r['GITHUB'])) { ?> <a href="https://github.com/<?php echo $r['GITHUB']; ?>"><i class="fab fa-github"></i></a> <?php } ?>
                                                                <?php if (!empty($r['TWITTER'])) { ?> <a href="https://twitter.com/<?php echo $r['TWITTER']; ?>"><i class="fab fa-twitter"></i></a> <?php } ?>



                                                            </div>
                                                        </div>
                                                        <!-- Team Details-->
                                                        <div class="single_advisor_details_info">
                                                            <h6><a href="?page=profile&id=<?php echo $r['id']; ?>"><?php echo $r['NAMETAG']; ?></a></h6>
                                                            <p class="designation"><?php echo $staffrank['NAME']; ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                        <?php }
                                        } ?>
                                    </div>
                                </div>
                            <?php } ?>

                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php include("themes/" . $_Config_['General']['theme'] . "/assets/includes/footer.php"); ?>