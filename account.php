<?php

$pagetitle = "My Account";
$needconnection = true;

include("controller/edit_profile.php");

if(isset($_GET['subpage'])){
    $subpage = htmlspecialchars($_GET['subpage']);
}else{
    $subpage = "home";
}




?>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
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
                        <div class="card mb-3">
                            <div class="card-body py-3">
                                <div class="row ">
                                        <div class="col-4">
                                            <div id="my_account" class="card mb-3 <?php echo "text-".$_ThemeOption_['Personnalisation']['text_image_color'].""; ?>" style="background-image: url('<?php echo $_ThemeOption_['Personnalisation']['background_img']; ?>'); background-size: cover;">
                                            <div class="card-header pr-0 pl-0" style="background-image: url('<?php echo $_ThemeOption_['Personnalisation']['background_img']; ?>'); background-size: cover;">
                                                <div class="row no-gutters align-items-center w-100">
                                                    <div class="col font-weight-bold pl-3"><a href="#my_account" class="<?php echo "text-".$_ThemeOption_['Personnalisation']['text_image_color'].""; ?>"><b>MY ACCOUNT</b></a></div>
                                                </div>

                                            </div>

                                        </div>
                                        <div class="d-grid gap-2">

                                          <a href="?page=account" class="btn btn<?php if($subpage !== "home"){ echo "-outline"; } ?>-dark">Account details</a>
                                          <a href="?page=account&subpage=change_photo" class="btn btn<?php if($subpage !== "change_photo"){ echo "-outline"; } ?>-dark">Change avatar</a>
                                          <a href="?page=account&subpage=edit" class="btn btn<?php if($subpage !== "edit"){ echo "-outline"; } ?>-dark">Edit account</a>
                                          <a href="?page=account&subpage=signature" class="btn btn<?php if($subpage !== "signature"){ echo "-outline"; } ?>-dark">Signature</a>
                                        </div>
                                </div>
                                        <div class="col-8">
                                            <?php if($subpage == "home"){ ?>
                                        <div class="d-grid gap-2">
                                            <div class="d-flex flex-column align-items-center text-center">
                                                <img src="themes/uploaded/profiles/<?php echo $userinfo['AVATAR_PATH']; ?>" alt="Profile avatar" class="rounded-circle" width="150">
                                                <div class="mt-3">
                                                  <h4><?php echo $userinfo['NAMETAG']; ?></h4>
                                                  <p class="text-secondary mb-1">

                                                        <?php if($userrank['DISPLAY'] > 0){ ?><span class="badge <?php echo $userrank['BADGE_COLOR']; ?>"><?php echo strtoupper($userrank['NAME']); ?></span><br><?php }else{ echo "New member"; } ?>
                                                        <?php if($userrank['PERMISSION_LEVEL'] > $_Config_['General']['staff_permission_level']){ ?><span class="badge bg-secondary">Staff member</span><?php } ?>

                                                  </p>
                                                  <p class="text-muted font-size-sm">Registered on <?php echo date("d/m/Y", strtotime($userinfo['DATE_CREATION'])); ?></p>
                                                </div>
                                              </div>
                                              <?php if(!empty($userinfo['DISCORD'])){ ?> <a class="btn btn-outline-dark"><i class="fab fa-discord"></i> <?php echo $userinfo['DISCORD']; ?></a> <?php } ?>

                                              <?php if(!empty($userinfo['TWITTER'])){ ?> <a href="https://twitter.com/<?php echo $userinfo['TWITTER']; ?>" class="btn btn-outline-dark"><i class="fab fa-twitter"></i> <?php echo $userinfo['TWITTER']; ?></a> <?php } ?>
                                              
                                              <?php if(!empty($userinfo['BIRTHDAY'])){ ?> <a class="btn btn-outline-success"><i class="fas fa-birthday-cake"></i> <?php echo date("jS \of F", strtotime($userinfo['BIRTHDAY'])); ?></a> <?php } ?>
                                              

                                              <?php if(!empty($userinfo['GITHUB'])){ ?> <a href="https://github.com/<?php echo $userinfo['GITHUB']; ?>" class="btn btn-outline-dark"><i class="fab fa-github"></i> <?php echo $userinfo['GITHUB']; ?></a> <?php } ?>
                                              <?php if(!empty($userinfo['WEBSITE'])){ ?> <a href="<?php echo $userinfo['WEBSITE']; ?>" class="btn btn-outline-dark"><i class="fas fa-sitemap"></i> Member's own website</a> <?php } ?>
                                            </div><br><a href="?page=account&subpage=edit">See details</a>
                                            <?php }else if($subpage == "change_photo"){ ?>
                                                <form method="POST" enctype="multipart/form-data">


                                                        <label>Profile icon</label> <small>(Max. 2 Mo)</small>
                                                    <input type="file" name="avatar" class="form-control" >
                                                    <br>
                                                    Please note that your avatar must comply with our terms of service
                                                    <hr>
                                                    <input type="submit" name="edit_profile" value="Edit" class="btn btn-outline-dark">
                                                    <input type="submit" name="delete_avatar" value="Reset avatar" class="btn btn-outline-danger">

                                                </form>
                                            <?php }else if($subpage == "edit"){ ?>
                                                <form method="POST">

                                                        <label>Username</label>
                                                        <input type="text" class="form-control" name="nametag" value="<?php echo $userinfo['NAMETAG']; ?>"><br>
                                                        <label>Description</label>
                                                        <textarea class="form-control" name="description"><?php echo $userinfo['ABOUT']; ?></textarea><br>


                                                          <label>Github</label>
                                                          <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon3">github.com/</span>
                                                            <input type="text" class="form-control border-DARK" name="github" value='<?php echo $userinfo["GITHUB"]; ?>'>
                                                          </div>
                                                          <label>Discord</label>
                                                          <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon3"><i class="fab fa-discord"></i></span>
                                                            <input type="text" class="form-control border-DARK" name="discord" value='<?php echo $userinfo["DISCORD"]; ?>'>
                                                          </div>
                                                          <label>Twitter</label>
                                                          <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon3">twitter.com/</span>
                                                            <input type="text" class="form-control border-DARK" name="twitter" value='<?php echo $userinfo["TWITTER"]; ?>'>
                                                          </div>
                                                          <label>Website</label>
                                                          <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon3"><i class="fas fa-sitemap"></i></span>
                                                            <input type="text" class="form-control border-DARK" name="website" value='<?php echo $userinfo["WEBSITE"]; ?>'>
                                                          </div>
                                                    <br>

                                                    <input type="submit" name="edit_account" class="btn btn-outline-dark">

                                                </form>
                                            <?php }else if($subpage == "signature"){ ?>
                                                <form method="POST">

                                                        <label>Signature</label>
                                                        <textarea id="editor1" name="signature"><?php echo $userinfo['SIGNATURE']; ?></textarea>
                                                        <script>
                                                            CKEDITOR.replace( 'editor1' );
                                                        </script>
                                                    <br>

                                                    <input type="submit" name="edit_signature" class="btn btn-outline-dark">

                                                </form>
                                            <?php } ?>
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
