<?php

const pageTitle = Lang::title_verification;

include("themes/" . $_Config_['General']['theme'] . "/assets/includes/header.php");
include("controller/mail_validation.php");

?>


<div class="container">
    <div class="row">
        <h3 class="text-muted"><b><?php echo pageTitle; ?></b></h3>
        <h6 class="text-muted"><?php if (isset($descriptionforum)) {
                                    echo $descriptionforum;
                                } ?></h6>
        <div class="separator"></div>




        <div class="col-md-12">

            <?php if (isset($error)) {
                echo $error;
            } ?>
        </div>

    </div>
</div>

<?php include("themes/" . $_Config_['General']['theme'] . "/assets/includes/footer.php"); ?>