<?php

const pageTitle = Lang::btn_login;

include("themes/" . $_Config_['General']['theme'] . "/assets/includes/header.php");
include("controller/login.php");

?>
<div class="container">

    <div class="row ">

        <?php if (isset($error)) {
            echo $error;
        } ?>
        <div class="card mb-3">
            <div class="card-body py-3">
                <div class="row no-gutters align-items-center">
                    <form method="POST">

                    <label><?php echo Lang::account_email; ?></label>
                        <input type="email" class="form-control" name="mailconnexion"><br>

                        <label><?php echo Lang::account_password; ?></label>
                        <input type="password" class="form-control" name="passwordconnexion"><br>


                        <hr class="m-0"><br>
                        <div class="d-grid gap-2">
                            <input type="submit" class="btn btn-primary" name="connexion" value="<?php echo Lang::btn_login; ?>">
                        </div>
                    </form>
                </div>
                <a href="?page=register"><?php echo Lang::any_account; ?></a>
            </div>
        </div>

    </div>
</div>

<?php include("themes/" . $_Config_['General']['theme'] . "/assets/includes/footer.php"); ?>