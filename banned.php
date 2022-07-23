<?php

const pageTitle = "Currently Banned";
include("themes/" . $_Config_['General']['theme'] . "/assets/includes/header.php");

?>


<div class="container">
    <div class="row">
        <h3 class="text-muted"><b><?php echo pageTitle; ?></b></h3>
        <h6 class="text-muted"><?php if(isset($descriptionforum)){ echo $descriptionforum; } ?></h6>
        <div class="separator"></div>


        <div class="alert alert-danger text-center">
            <strong><i class="fas fa-exclamation-circle"></i></strong> <?php echo Lang::access_denied_banned; ?> <?php if(isset($cib['REASON'])) echo "Reason: <b>".$cib['REASON']."</b>"; ?>
        </div>

    </div>
</div>

<?php include("themes/" . $_Config_['General']['theme'] . "/assets/includes/footer.php"); ?>