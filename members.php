<?php

include("controller/members.php");

$pagetitle = "Members list";
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
body{margin-top:20px;
background:#eee;
}
.single_advisor_profile {
    position: relative;
    margin-bottom: 50px;
    -webkit-transition-duration: 500ms;
    transition-duration: 500ms;
    z-index: 1;
    border-radius: 15px;
    -webkit-box-shadow: 0 0.25rem 1rem 0 rgba(47, 91, 234, 0.125);
    box-shadow: 0 0.25rem 1rem 0 rgba(47, 91, 234, 0.125);
}
.single_advisor_profile .advisor_thumb {
    position: relative;
    z-index: 1;
    border-radius: 15px 15px 0 0;
    margin: 0 auto;
    padding: 30px 30px 0 30px;
    background-color: #3f43fd;
    overflow: hidden;
}
.single_advisor_profile .advisor_thumb::after {
    -webkit-transition-duration: 500ms;
    transition-duration: 500ms;
    position: absolute;
    width: 150%;
    height: 80px;
    bottom: -45px;
    left: -25%;
    content: "";
    background-color: #ffffff;
    -webkit-transform: rotate(-15deg);
    transform: rotate(-15deg);
}
@media only screen and (max-width: 575px) {
    .single_advisor_profile .advisor_thumb::after {
        height: 160px;
        bottom: -90px;
    }
}
.single_advisor_profile .advisor_thumb .social-info {
    position: absolute;
    z-index: 1;
    width: 100%;
    bottom: 0;
    right: 30px;
    text-align: right;
}
.single_advisor_profile .advisor_thumb .social-info a {
    font-size: 14px;
    color: #020710;
    padding: 0 5px;
}
.single_advisor_profile .advisor_thumb .social-info a:hover,
.single_advisor_profile .advisor_thumb .social-info a:focus {
    color: #3f43fd;
}
.single_advisor_profile .advisor_thumb .social-info a:last-child {
    padding-right: 0;
}
.single_advisor_profile .single_advisor_details_info {
    position: relative;
    z-index: 1;
    padding: 30px;
    text-align: right;
    -webkit-transition-duration: 500ms;
    transition-duration: 500ms;
    border-radius: 0 0 15px 15px;
    background-color: #ffffff;
}
.single_advisor_profile .single_advisor_details_info::after {
    -webkit-transition-duration: 500ms;
    transition-duration: 500ms;
    position: absolute;
    z-index: 1;
    width: 50px;
    height: 3px;
    background-color: #3f43fd;
    content: "";
    top: 12px;
    right: 30px;
}
.single_advisor_profile .single_advisor_details_info h6 {
    margin-bottom: 0.25rem;
    -webkit-transition-duration: 500ms;
    transition-duration: 500ms;
}
@media only screen and (min-width: 768px) and (max-width: 991px) {
    .single_advisor_profile .single_advisor_details_info h6 {
        font-size: 14px;
    }
}
.single_advisor_profile .single_advisor_details_info p {
    -webkit-transition-duration: 500ms;
    transition-duration: 500ms;
    margin-bottom: 0;
    font-size: 14px;
}
@media only screen and (min-width: 768px) and (max-width: 991px) {
    .single_advisor_profile .single_advisor_details_info p {
        font-size: 12px;
    }
}
.single_advisor_profile:hover .advisor_thumb::after,
.single_advisor_profile:focus .advisor_thumb::after {
    background-color: #070a57;
}
.single_advisor_profile:hover .advisor_thumb .social-info a,
.single_advisor_profile:focus .advisor_thumb .social-info a {
    color: #ffffff;
}
.single_advisor_profile:hover .advisor_thumb .social-info a:hover,
.single_advisor_profile:hover .advisor_thumb .social-info a:focus,
.single_advisor_profile:focus .advisor_thumb .social-info a:hover,
.single_advisor_profile:focus .advisor_thumb .social-info a:focus {
    color: #ffffff;
}
.single_advisor_profile:hover .single_advisor_details_info,
.single_advisor_profile:focus .single_advisor_details_info {
    background-color: #070a57;
}
.single_advisor_profile:hover .single_advisor_details_info::after,
.single_advisor_profile:focus .single_advisor_details_info::after {
    background-color: #ffffff;
}
.single_advisor_profile:hover .single_advisor_details_info h6,
.single_advisor_profile:focus .single_advisor_details_info h6 {
    color: #ffffff;
}
.single_advisor_profile:hover .single_advisor_details_info p,
.single_advisor_profile:focus .single_advisor_details_info p {
    color: #ffffff;
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

                                            <div id="my_account" class="card mb-3 <?php echo "text-".$_ThemeOption_['Personnalisation']['text_image_color'].""; ?>" style="background-image: url('<?php echo $_ThemeOption_['Personnalisation']['background_img']; ?>'); background-size: cover;">
                                            <div class="card-header pr-0 pl-0" style="background-image: url('<?php echo $_ThemeOption_['Personnalisation']['background_img']; ?>'); background-size: cover;">
                                                <div class="row no-gutters align-items-center w-100">
                                                    <div class="col font-weight-bold pl-3"><a href="#my_account" class="<?php echo "text-".$_ThemeOption_['Personnalisation']['text_image_color'].""; ?>"><b>Members list</b></a></div>
                                                </div>

                                            </div>

                                        </div>

                        <?php if(isset($error)){ echo $error; } ?>

                        <div class="card mb-3">
                            <div class="card-body py-3">
                                <div class="row ">
                                        <div class="col-4">
                                            <div id="my_account" class="card mb-3 <?php echo "text-".$_ThemeOption_['Personnalisation']['text_image_color'].""; ?>" style="background-image: url('<?php echo $_ThemeOption_['Personnalisation']['background_img']; ?>'); background-size: cover;">
                                            <div class="card-header pr-0 pl-0" style="background-image: url('<?php echo $_ThemeOption_['Personnalisation']['background_img']; ?>'); background-size: cover;">
                                                <div class="row no-gutters align-items-center w-100">
                                                    <div class="col font-weight-bold pl-3"><a href="#my_account" class="<?php echo "text-".$_ThemeOption_['Personnalisation']['text_image_color'].""; ?>"><b>USERS RANKS</b></a></div>
                                                </div>

                                            </div>

                                        </div>
                                        <div class="d-grid gap-2">
                                          <a href="?page=members" class="btn btn<?php if($page !== "user"){ echo '-outline'; } ?>-dark">User List</a>
                                          <a href="?page=members&type=staff" class="btn btn<?php if($page !== "staff"){ echo '-outline'; } ?>-dark">Staff List</a>
                                        </div>
                                </div>
                                        <div class="col-8">
                                            <?php if($page == "user"){ ?>
                                                <table class="table table-striped">
                                                  <thead>
                                                    <tr>
                                                      <th scope="col">Username</th>
                                                      <th scope="col">Messages</th>
                                                    </tr>
                                                  </thead>
                                                  <tbody>
                                                    <?php 

                                                    while($r = $memberslist->fetch()){ 

                                                        $messagenumber = $bdd->prepare("SELECT * FROM dc_messages WHERE USER_ID = ?");
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
                                            <?php }elseif($page == "staff"){ ?>

                                                        <div class="container">
                                                        <div class="row justify-content-center">
                                                    <?php 

                                                    $stafflist = $bdd->query("SELECT * FROM ".$_Config_['Database']['table_prefix']."_members");
                                                    while($r = $stafflist->fetch()){ 

                                                                $staffrank = $bdd->prepare("SELECT * FROM ".$_Config_['Database']['table_prefix']."_ranks WHERE id = ?");
                                                                $staffrank->execute(array($r['RANK_ID']));
                                                                $staffrank = $staffrank->fetch();
                                                                if($staffrank['PERMISSION_LEVEL'] >= $_Config_['General']['staff_permission_level']){

                                                        ?>
                                                      <div class="col-12 col-sm-6 col-lg-3">
                                                        <div class="single_advisor_profile wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                                                          <!-- Team Thumb-->
                                                          <div class="advisor_thumb"><img src="themes/uploaded/profiles/<?php echo $r['AVATAR_PATH']; ?>" height="250" widht="250">
                                                            <!-- Social Info-->
                                                            <div class="social-info">

                                          <?php if(!empty($r['GITHUB'])){ ?> <a href="https://github.com/<?php echo $r['GITHUB']; ?>"><i class="fab fa-github"></i></a> <?php } ?>
                                          <?php if(!empty($r['TWITTER'])){ ?> <a href="https://twitter.com/<?php echo $r['TWITTER']; ?>"><i class="fab fa-twitter"></i></a> <?php } ?>



                                                            </div>
                                                          </div>
                                                          <!-- Team Details-->
                                                          <div class="single_advisor_details_info">
                                                            <h6><a href="?page=profile&id=<?php echo $r['id']; ?>"><?php echo $r['NAMETAG']; ?></a></h6>
                                                            <p class="designation"><?php echo $staffrank['NAME']; ?></p>
                                                          </div>
                                                        </div>
                                                      </div>
                                                <?php }} ?>
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
        </section>

        <?php if($_Config_['developper_mod'] == "true"){ ?>
        <section id="developper_mod_theme">
            <div class="container px-4">
                <div class="row gx-4 justify-content-center">
                    <div class="col-lg-8">
                        <h2>About this theme</h2>
                        <p class="lead">Everyone can create a theme. These are this theme informations:</p>
                        <ul>
                            <li>Author: <b><?php echo $_ThemeOption_['author']; ?></b></li>
                            <li>Theme version: <b><?php echo $_ThemeOption_['version']; ?></b></li>
                            <li>Theme description: <b><?php echo $_ThemeOption_['version']; ?></b></li>
                            <li>Full name: <b><?php echo $_ThemeOption_['full_name']; ?></b></li>
                            <li>Showable name: <b><?php echo $_ThemeOption_['name']; ?></b></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <?php } ?>

        <!-- Footer-->
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
