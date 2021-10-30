<?php

$pagetitle = "Home";

$listcategory = $bdd->query("SELECT * FROM ".$_Config_['Database']['table_prefix']."_category ORDER BY ORDER_LISTING");

if(!(isset($_SESSION['id']))){


    $userrank['PERMISSION_LEVEL'] = 1;

}

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
        <header class="<?php echo "text-".$_ThemeOption_['Personnalisation']['text_image_color'].""; ?>" style="background-image: url('<?php echo $_ThemeOption_['Personnalisation']['background_img']; ?>'); background-size: cover;"> 
            <div class="container px-4 text-center">
                <h1 class="fw-bolder <?php echo "text-".$_ThemeOption_['Personnalisation']['text_image_color'].""; ?>">Welcome to <?php echo $_Config_['General']['name']; ?></h1>
                <p class="lead <?php echo "text-".$_ThemeOption_['Personnalisation']['text_image_color'].""; ?>"><?php echo $_Config_['General']['description']; ?></p>
                <?php if(!(isset($_SESSION['id']))){ ?><a href="?page=register" class="btn btn-lg btn-light">Register!</a><?php } ?>
            </div>
        </header>
        <!-- Services section--><?php if($_maintenance_['status'] == "true"){ ?><div class="alert alert-danger"><strong><i class="fas fa-exclamation-circle"></i></strong> Your website is actually under maintenance. Only ranks with "SUPERADMIN" permission can access to the website.</div><?php } ?>
        <section>
            <div class="container-fluid">
                <div class="row">
                    <?php if($widgetnumber > 0){ ?>
                    <div class="col-md-3">
                        <?php

                        include('controller/widget.php');

                        ?>
                    </div>
                    <?php } ?>


                    <div class="col-md-<?php if($widgetnumber > 0){ echo '9'; }else{ echo '12'; }?>" > 

                            <?php while($cat = $listcategory->fetch()){ ?>

                                <?php 
                                    if($userrank['PERMISSION_LEVEL'] >= $cat['PERMISSION_SEE_LEVEL']){

                                        $lffc =  $bdd->prepare("SELECT * FROM ".$_Config_['Database']['table_prefix']."_forum WHERE PARENT_ID = ? ORDER BY ORDER_LISTING");
                                        $lffc->execute(array($cat['id']));



                                ?>
                                    <div id="forum_<?php echo $cat['NAME']; ?>" class="card mb-3 <?php echo "text-".$_ThemeOption_['Personnalisation']['text_image_color'].""; ?>" style="background-image: url('<?php echo $_ThemeOption_['Personnalisation']['background_img']; ?>'); background-size: cover;">
                                        <div class="card-header pr-0 pl-0" style="background-image: url('<?php echo $_ThemeOption_['Personnalisation']['background_img']; ?>'); background-size: cover;">
                                            <div class="row no-gutters align-items-center w-100">
                                                <div class="col font-weight-bold pl-3"><a href="#forum_<?php echo $cat['NAME']; ?>" class="<?php echo "text-".$_ThemeOption_['Personnalisation']['text_image_color'].""; ?>"><b><?php if(!empty($cat['ICON'])){ echo '<i class="'.$cat['ICON'].'"></i> '; } ?> <?php echo strtoupper($cat['NAME']); ?></b></a></div>
                                            </div>
                                        </div>
                                    </div>
                        <div class="card mb-3">
                                    <?php while($f = $lffc->fetch()){ 

                                            $msgnumber = $bdd->prepare("SELECT * FROM ".$_Config_['Database']['table_prefix']."_messages WHERE FORUM_ID = ?");
                                            $msgnumber->execute(array($f['id']));
                                            $msgnumber = $msgnumber->rowCount();

                                            $msgtopic = $bdd->prepare("SELECT * FROM ".$_Config_['Database']['table_prefix']."_topics WHERE FORUM_ID = ?");
                                            $msgtopic->execute(array($f['id']));
                                            $msgtopic = $msgtopic->rowCount();

                                    if($userrank['PERMISSION_LEVEL'] >= $f['PERMISSION_SEE_LEVEL']){


                                    ?>
                            <div class="card-body py-3">
                                <div class="row no-gutters align-items-center">
                                    <div class="col"><a href="?page=forum_categorie&id=<?php echo $cat['id']; ?>" class="text-big font-weight-semibold" data-abc="true">
                                        <?php if(!empty($f['ICON'])){ echo '<i class="'.$f['ICON'].'"></i> '; }else{ echo '<i class="fas fa-comment-alt"></i> '; } ?><?php echo ucwords($f['NAME']); ?></a>

                                        <?php if(!empty($f['DESCRIPTION'])){ echo '<br><a class="text-muted" data-abc="true">'.$f['DESCRIPTION'].'</a>'; } ?>

                                    </div>
                                    <div class="d-none d-md-block col-6">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-3 text-center">

                                                    <?php echo $msgtopic; ?><br><small>Threads</small>


                                            </div>
                                            <div class="col-3 text-center">

                                                    <?php echo $msgnumber; ?><br><small>Messages</small>


                                            </div>
                                            <div class="media col-3 align-items-center"> 
<div class="text-muted small text-truncate">
                                            <?php 

                                            $lastmessage = $bdd->query("SELECT * FROM ".$_Config_['Database']['table_prefix']."_topics WHERE FORUM_ID = ".$cat['id']." ORDER BY DATE_CREATION DESC LIMIT 1");

                                            if($lastmessage->rowCount() > 0){
                                            while($r = $lastmessage->fetch()){ 


                                                $author = $bdd->prepare("SELECT * FROM ".$_Config_['Database']['table_prefix']."_members WHERE id = ?");
                                                $author->execute(array($r['USER_ID']));
                                                $author = $author->fetch();

                                                
                                                if(isset($r['BADGE_ID']) AND !empty($r['BADGE_ID'])){ 
                                                    $badge = $bdd->prepare("SELECT * FROM ".$_Config_['Database']['table_prefix']."_badges WHERE id = ?");
                                                    $badge->execute(array($r['BADGE_ID']));
                                                    $badgerc = $badge->rowCount();
                                                }

                                            ?>
                                                <a href="?page=topic&id=<?php echo $r['id']; ?>" class="d-block text-truncate" data-abc="true"><?php if($badgerc > 0){ while($bi = $badge->fetch()){

                                        echo '<span class="'.$bi['SPAN'].'">'.$bi['NAME'].'</span> ';
                                    }}
                                        ?><?php echo $r['NAME']; ?></a>
                                                    <?php echo date("d/m/Y", strtotime($r['DATE_CREATION'])); ?> &nbsp;·&nbsp;<a href="?page=profile&id=<?php echo $author['id']; ?>" class="text-muted" data-abc="true"><?php echo $author['NAMETAG']; ?></a><?php }}else{ ?>
                                            <a class="text-muted" data-abc="true">Any topic</a>
                                                    <?php } ?></div>

                                                <div class="media-body flex-truncate ml-2"> 

                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="m-0">
                                    <?php }} ?>
                        </div>
                                <?php } ?>
                                
                            <?php } ?>

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
