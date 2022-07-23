<?php

$pagetitle = $cfp['NAME'];
$content = $cfp['CONTENU'];

if (!(isset($_SESSION['id']))) {
    $userrank['PERMISSION_LEVEL'] = 1;
}

include("themes/" . $_Config_['General']['theme'] . "/assets/includes/header.php");

?>


<div class="container">
    <div class="row">
        <h3 class="text-muted"><b><?php echo $pagetitle; ?></b></h3>
        <h6 class="text-muted"><?php if(isset($descriptionforum)){ echo $descriptionforum; } ?></h6>
        <div class="separator"></div>


        <?= $content; ?>

    </div>
</div>

<?php include("themes/" . $_Config_['General']['theme'] . "/assets/includes/footer.php"); ?>