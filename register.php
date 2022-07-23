<?php

const pageTitle = Lang::btn_register;

include("themes/" . $_Config_['General']['theme'] . "/assets/includes/header.php");
include("controller/registration.php");

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

                        <label>Nametag</label>
                        <input type="text" class="form-control" name="nametag"><br>
                        <label>Emaim</label>

                        <input type="email" class="form-control" name="mail"><br>

                        <label><?php echo Lang::account_password; ?></label>
                        <input type="password" class="form-control" name="pass"><br>

                        <label>pass confirmation </label>
                        <input type="password" class="form-control" name="passVerify"><br>


                        <hr class="m-0"><br>
                        <div class="d-grid gap-2">
                            <input type="submit" class="btn btn-primary" name="create_account" value="Create my account">
                        </div>
                    </form>
                </div>
                <a href="?page=login"><?php echo Lang::already_account; ?></a>
            </div>
        </div>

    </div>
</div>

<?php include("themes/" . $_Config_['General']['theme'] . "/assets/includes/footer.php"); ?>