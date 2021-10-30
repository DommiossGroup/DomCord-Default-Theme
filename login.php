<?php

$pagetitle = "Sign in";
include("controller/login.php");


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


                        <div id="login" class="card mb-3 <?php echo "text-".$_ThemeOption_['Personnalisation']['text_image_color'].""; ?>" style="background-image: url('<?php echo $_ThemeOption_['Personnalisation']['background_img']; ?>'); background-size: cover;">
                            <div class="card-header pr-0 pl-0" style="background-image: url('<?php echo $_ThemeOption_['Personnalisation']['background_img']; ?>'); background-size: cover;">
                                <div class="row no-gutters align-items-center w-100">
                                    <div class="col font-weight-bold pl-3"><a href="#login" class="<?php echo "text-".$_ThemeOption_['Personnalisation']['text_image_color'].""; ?>"><b>LOGIN TO MY ACCOUNT</b></a></div>
                                </div>
                            </div>
                        </div>
                        <?php if(isset($error)){ echo $error; } ?>
                        <div class="card mb-3">
                            <div class="card-body py-3">
                                <div class="row no-gutters align-items-center">
                                    <form method="POST">
                                    
                                    <div class="input-group mb-3">
                                      <span class="input-group-text" id="basic-addon1">Email adress <b class="text-danger">*</b></span>
                                      <input type="email" class="form-control" name="mailconnexion">
                                    </div>
                                    
                                    <div class="input-group mb-3">
                                      <span class="input-group-text" id="basic-addon1">Password <b class="text-danger">*</b></span>
                                      <input type="password" class="form-control" name="passwordconnexion">
                                    </div>
                                   
                                <hr class="m-0"><br>
                                <div class="d-grid gap-2">
                                    <input type="submit" class="btn btn-outline-dark" name="connexion" value="Login to my account">
                                </div>
                                </form>
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
