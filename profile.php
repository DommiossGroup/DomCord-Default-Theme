<?php

$pagetitle = "Profile";



include("controller/profile.php");






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
                <h1 class="fw-bolder <?php echo "text-".$_ThemeOption_['Personnalisation']['text_image_color'].""; ?>"><?php echo $pagetitle; ?></h1>
            </div>
        </header>
        <!-- Services section--><?php if($_maintenance_['status'] == "true"){ ?><div class="alert alert-danger"><strong><i class="fas fa-exclamation-circle"></i></strong> Your website is actually under maintenance. Only ranks with "SUPERADMIN" permission can access to the website.</div><?php } ?>
        <section>
            <div class="container-fluid">
                <div class="row">


                    <div class="col-md-12" >


                        <?php if(isset($error)){ echo $error; } ?>
                                <div class="row ">
                                        <div class="col-4">
                                        <div class="card mb-3">
                                            <div class="card-body py-3">
                                            <div id="my_account" class="card mb-3 <?php echo "text-".$_ThemeOption_['Personnalisation']['text_image_color'].""; ?>" style="background-image: url('<?php echo $_ThemeOption_['Personnalisation']['background_img']; ?>'); background-size: cover;">
                                            <div class="card-header pr-0 pl-0" style="background-image: url('<?php echo $_ThemeOption_['Personnalisation']['background_img']; ?>'); background-size: cover;">
                                                <div class="row no-gutters align-items-center w-100">
                                                    <div class="col font-weight-bold pl-3"><a href="#my_account" class="<?php echo "text-".$_ThemeOption_['Personnalisation']['text_image_color'].""; ?>"><b>MEMBER PROFILE</b></a></div>
                                                </div>

                                            </div>

                                        </div>
                                        <div class="d-grid gap-2">
                        <div class="d-flex flex-column align-items-center text-center">
                                            <img src="themes/uploaded/profiles/<?php echo $profileinfo['AVATAR_PATH']; ?>" alt="Profile avatar" class="rounded-circle" width="150">
                                            <div class="mt-3">
                                              <h4><?php echo $profileinfo['NAMETAG']; ?></h4>
                                              <small><?php if($_Config_['Additional']['email_display'] == 'true'){ echo $profileinfo['MAIL']; }?></small>
                                              <p class="text-secondary mb-1">

                                                    <?php if($profilerank['DISPLAY'] > 0){ ?><span class="badge <?php echo $profilerank['BADGE_COLOR']; ?>"><?php echo strtoupper($profilerank['NAME']); ?></span><br><?php }else{ echo "New member"; } ?>
                                                    <?php if($profilerank['PERMISSION_LEVEL'] >= $_Config_['General']['staff_permission_level']){ ?><span class="badge bg-secondary">Staff member</span><?php } ?>

                                              </p>
                                              <p class="text-muted font-size-sm">Registered on <?php echo date("d/m/Y", strtotime($profileinfo['DATE_CREATION'])); ?></p>
                                            </div>
                                          </div>
                                          <?php if(!empty($profileinfo['DISCORD'])){ ?> <a class="btn btn-outline-dark"><i class="fab fa-discord"></i> <?php echo $profileinfo['DISCORD']; ?></a> <?php } ?>

                                          <?php if(!empty($profileinfo['TWITTER'])){ ?> <a href="https://twitter.com/<?php echo $profileinfo['TWITTER']; ?>" class="btn btn-outline-dark"><i class="fab fa-twitter"></i> <?php echo $profileinfo['TWITTER']; ?></a> <?php } ?>
                                          <?php if($_Config_['Additional']['birthday_display'] == 'true'){ ?>
                                          <?php if(!empty($profileinfo['BIRTHDAY'])){ ?> <a class="btn btn-outline-success"><i class="fas fa-birthday-cake"></i> <?php echo date("jS \of F", strtotime($profileinfo['BIRTHDAY'])); ?></a> <?php } ?>
                                            <?php } ?>

                                          <?php if(!empty($profileinfo['GITHUB'])){ ?> <a href="https://github.com/<?php echo $profileinfo['GITHUB']; ?>" class="btn btn-outline-dark"><i class="fab fa-github"></i> <?php echo $profileinfo['GITHUB']; ?></a> <?php } ?>
                                          <?php if(!empty($profileinfo['WEBSITE'])){ ?> <a href="<?php echo $profileinfo['WEBSITE']; ?>" class="btn btn-outline-dark"><i class="fas fa-sitemap"></i> Member's own website</a> <?php } ?>
                                            </div>
                                                </div>
                                                </div>
                                                </div>
                                            <div class="col-8">
                                                <div class="card mb-3">
                                                    <div class="card-body py-3">
                                                        <div class="row">
                                                            <div class="col-4 text-center">
                                                                <b><?php echo $lof->rowCount(); ?></b><br> Messages
                                                            </div>
                                                            <div class="col-4 text-center">
                                                                <b><?php echo $rs; ?></b><br> Reaction score
                                                            </div>
                                                            <div class="col-4 text-center">
                                                                <b><?php echo $lot->rowCount(); ?></b><br> Threads
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card mb-3">
                                                    <div class="card-body py-3">
                                                        <b>ABOUT <?php echo strtoupper($profileinfo['NAMETAG']); ?></b><hr>
                                                        <?php echo htmlspecialchars($profileinfo['ABOUT']); ?>
                                                    </div>
                                                </div>
                                                <div class="card mb-3">
                                                    <div class="card-body py-3">
                                                        <b>LAST THREADS</b><hr>
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col">Name</th>
                                                                        <th scope="col"></th>
                                                                    </tr>
                                                                </thead>
                                                            <tbody>

                                                            <?php 
                                                                $recent = $bdd->prepare("SELECT * FROM ".$_Config_['Database']['table_prefix']."_topics WHERE USER_ID = ? ORDER BY DATE_CREATION DESC LIMIT 3");
                                                                $recent->execute(array($profileinfo['id']));

                                                                while($r = $recent->fetch()){
                                                                    if(isset($r['BADGE_ID'])){ 
                                                                        $badge = $bdd->prepare("SELECT * FROM ".$_Config_['Database']['table_prefix']."_badges WHERE id = ?");
                                                                        $badge->execute(array($r['BADGE_ID']));
                                                                    }

                                                            ?>

                                                                    <tr>
                                                                      <th><a href="?page=topic&id=<?php echo $r['id']; ?>"><?php while($bi = $badge->fetch()){ echo '<span class="'.$bi['SPAN'].'">'.$bi['NAME'].'</span> '; } ?><?php echo $r['NAME']; ?></a></th>
                                                                      <td><?php echo date("d/m/Y · H:m", strtotime($r['DATE_CREATION'])); ?></td>
                                                                    </tr>

                                                            <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- Footer-->
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
