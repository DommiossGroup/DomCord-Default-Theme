<?php



include("controller/topic.php");




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
            <div class="container-fluid px-4 text-center">
                <h1 class="fw-bolder <?php echo "text-".$_ThemeOption_['Personnalisation']['text_image_color'].""; ?>"><?php echo $pagetitle; ?></h1>
            </div>
        </header>
        <!-- Services section--><?php if($_maintenance_['status'] == "true"){ ?><div class="alert alert-danger"><strong><i class="fas fa-exclamation-circle"></i></strong> Your website is actually under maintenance. Only ranks with "SUPERADMIN" permission can access to the website.</div><?php } ?>
        <section>
            <div class="container-fluid">
                <div class="row">


                    		<div class="col-12" >
                                            <div id="my_account" class="card mb-3 <?php echo "text-".$_ThemeOption_['Personnalisation']['text_image_color'].""; ?>" style="background-image: url('<?php echo $_ThemeOption_['Personnalisation']['background_img']; ?>'); background-size: cover;">
                                            <div class="card-header pr-0 pl-0" style="background-image: url('<?php echo $_ThemeOption_['Personnalisation']['background_img']; ?>'); background-size: cover;">
                                                <div class="row no-gutters align-items-center w-100">
                                                    <div class="col-10 font-weight-bold pl-3">
                                                        <nav class="text-center" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                                                          <ol class="breadcrumb">
                                                            <li class="breadcrumb-item"><a href="?page=home" class="<?php echo "text-".$_ThemeOption_['Personnalisation']['text_image_color'].""; ?>">Home</a></li>
                                                            <li class="breadcrumb-item" aria-current="page"><a href="?page=forum_categorie&id=<?php echo $cfp['id']; ?>" class="<?php echo "text-".$_ThemeOption_['Personnalisation']['text_image_color'].""; ?>"><?php echo ucfirst($cfp['NAME']); ?></a></li>
                                                            <li class="breadcrumb-item" aria-current="page" class="<?php echo "text-".$_ThemeOption_['Personnalisation']['text_image_color'].""; ?>"><?php if(isset($topic_badge_span)){ echo $topic_badge_span." "; } ?><b><?php echo $pagetitle; ?></b></li>
                                                          </ol>
                                                        </nav>
                                                    </div>
                                                    <?php if(isset($_SESSION['id'])){ ?>
                                                        <?php if($userrank['ADMIN_TOPIC_EDIT'] == "on"){ ?>
                                                            <div   class="col-2 <?php echo "text-".$_ThemeOption_['Personnalisation']['text_image_color'].""; ?>">
                                                                <button type="button" class="btn btn-<?php echo $_ThemeOption_['Personnalisation']['theme_color']; ?>" data-bs-toggle="modal" data-bs-target="#editmodal" class="btn btn-<?php echo $_ThemeOption_['Personnalisation']['theme_color']; ?>"><i class="fas fa-edit"></i> Moderation tools</button>
                                                            </div>

                                                            <div class="modal fade text-dark" id="editmodal" tabindex="-1" aria-labelledby="editmodal" aria-hidden="true">
															  <div class="modal-dialog modal-lg">
															    <div class="modal-content">
															      <div class="modal-header">
															        <h5 class="modal-title" id="exampleModalLabel">Edit topic</h5>
															        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
															      </div>
															      <div class="modal-body">


															        <?php if(isset($error)){ echo $error; } ?>
															        <form method="POST">
															        	<?php if($userrank['ADMIN_TOPIC_PREFIXCHANGE'] == "on"){ ?>
															            <label>Topic badge</label>
															            <select class="form-control" name="badge">
															            	<option value="0">Any prefix</option>
																            <?php 

																            $lb = $bdd->query("SELECT * FROM ".$_Config_['Database']['table_prefix']."_badges");
																            while($r = $lb->fetch()){


																            ?>

																            <option <?php if($sfc['BADGE_ID'] == $r['id']){ echo "selected"; } ?> value="<?php echo $r['id']; ?>" class="<?php echo $r['SPAN']; ?>"><?php echo $r['NAME']; ?></option>

																            <?php } ?>
															            	
															            </select><br>
															        	<?php } ?>

															            <label>Topic name</label>
															            <input class="form-control" type="text" name="name" value="<?php echo $sfc['NAME']; ?>"><br>
															            <div class="row text-center">
															            	<div class="col-6">
																	            <label>Pin</label><br>
																	            <input <?php if($sfc['PINNED'] == "on"){ echo "checked"; } ?> class="form-check-input" type="checkbox" name="pinned">
															        		</div>
															            	<div class="col-6">
																	            <label>Lock thread</label><br>
																	            <input <?php if($sfc['STATUT'] == "1"){ echo "checked"; } ?> class="form-check-input" type="checkbox" name="lock">
																	        </div>
															            </div>
															      </div>
															      <div class="modal-footer">
															        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
															        <button type="submit" name="edit_topic" class="btn btn-<?php echo $_ThemeOption_['Personnalisation']['theme_color']; ?>">Edit a topic</button>
															      </div>
															        </form>
															    </div>
															  </div>
															</div>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </div>

                                            </div>

                                        </div>
                                        </div>
                    <div class="col-md-12" >


                        <?php while($m = $lom->fetch()){
            $author = $bdd->prepare("SELECT * FROM ".$_Config_['Database']['table_prefix']."_members WHERE id = ?");
            $author->execute(array(htmlspecialchars($m['USER_ID'])));
            $author = $author->fetch();


            $authorrank = $bdd->prepare("SELECT * FROM ".$_Config_['Database']['table_prefix']."_ranks WHERE id = ?");
            $authorrank->execute(array($author['RANK_ID']));
            $authorrank = $authorrank->fetch();

            $isreport = $bdd->prepare("SELECT * FROM ".$_Config_['Database']['table_prefix']."_reports WHERE MESSAGE_ID = ?");
            $isreport->execute(array($m['id']));
            $isreport = $isreport->rowCount();


            ?>
                                       
                    <?php if($m['STATUS'] == 0){ ?>
                                <div class="card mb-3">
                                    <div class="card-body py-3">
                                            <div id="my_account" class="card mb-3 <?php echo "text-".$_ThemeOption_['Personnalisation']['text_image_color'].""; ?>" style="background-image: url('<?php echo $_ThemeOption_['Personnalisation']['background_img']; ?>'); background-size: cover;">
                                            <div class="card-header pr-0 pl-0" style="background-image: url('<?php echo $_ThemeOption_['Personnalisation']['background_img']; ?>'); background-size: cover;">
                                                <div class="row no-gutters align-items-center w-100">
                                                    <div class="col font-weight-bold pl-3"></div>
                                                </div>

                                            </div>

                                        </div>
                                        <div class="row ">
                                        <div class="col-4">
                                        <div class="d-grid gap-2">
                                            <div class="d-flex flex-column align-items-center text-center" style="background-image: url('<?php echo $_ThemeOption_['Personnalisation']['background_img']; ?>'); background-size: cover;">
                                            <img src="themes/uploaded/profiles/<?php echo $author['AVATAR_PATH']; ?>" alt="Profile avatar" class="rounded-circle" width="150">
                                            <div class="mt-3">
                                              <h4><a href="?page=profile&id=<?php echo $author['id']; ?>" class="<?php echo "text-".$_ThemeOption_['Personnalisation']['text_image_color'].""; ?>"><?php echo $author['NAMETAG']; ?></a></h4>
                                              <p class="text-secondary mb-1">

                                                    <?php if($authorrank['DISPLAY'] > 0){ ?><span class="badge <?php echo $authorrank['BADGE_COLOR']; ?>"><?php echo strtoupper($authorrank['NAME']); ?></span><br><?php }else{ echo "New member"; } ?>
                                                    <?php if($authorrank['PERMISSION_LEVEL'] >= $_Config_['General']['staff_permission_level']){ ?><span class="badge bg-secondary">Staff member</span><?php } ?>

                                              </p>
                                            </div>
                                          </div><div class="d-grid gap-2">
                                                <?php if($userrank['MESSAGE_DELETE'] == "on"){ ?>
                                                    <a href="?page=topic&id=<?php echo htmlspecialchars($_GET['id']); ?>&action=delete&messageid=<?php echo $m['id']; ?>" class="btn btn-danger btn-sm" type="button"><i class="fas fa-exclamation-circle"></i> Delete message</a>
                                                <?php } ?>

                                              <?php 
                                              if(isset($_SESSION['id'])){
                                              if($author['id'] != $userinfo['id']){ 

                                                ?>
                                                <?php if($isreport < 1){ ?>
     <div class="modal fade" id="reactmodal" tabindex="-1" aria-labelledby="reactmodal" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="reactmodal">React to a message</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body text-center">
                                        <p>
                                        <?php 

                                        $reactionlist = $bdd->query("SELECT * FROM ".$_Config_['Database']['table_prefix']."_reactions_images");

                                        while($p = $reactionlist->fetch()){


                                        ?>

                                        <a href="?page=topic&id=<?php echo htmlspecialchars($_GET['id']); ?>&action=react&messageid=<?php echo $m['id']; ?>&reactionid=<?php echo $p['id']; ?>" class="btn btn-<?php echo $_ThemeOption_['Personnalisation']['theme_color']; ?> btn-sm" type="button"><img src="themes/uploaded/reactions/<?php echo $p['PATH']; ?>" height="25" width="25"></a>

                                        <?php } ?>

                                    </p>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                            		<button type="button" data-toggle="modal" data-target="#reactmodal" class="btn btn-primary btn-sm" type="button"><i class="fab fa-creative-commons-sampling"></i> React to message</button>
                                                    
                                                    <a href="?page=topic&id=<?php echo htmlspecialchars($_GET['id']); ?>&action=report&messageid=<?php echo $m['id']; ?>" class="btn btn-<?php echo $_ThemeOption_['Personnalisation']['theme_color']; ?> btn-sm" type="button"><i class="fas fa-flag"></i> Report message</a>
                                                <?php }else{ ?>
                                                    <button disabled class="btn btn-<?php echo $_ThemeOption_['Personnalisation']['theme_color']; ?> btn-sm" type="button"><i class="fas fa-flag"></i> Report message</button>
                                                <?php } ?>
                                            <?php }} ?><center>Posted on <?php echo date("d/m/Y - H:m", strtotime($m['DATE_POST'])); ?></center>

                                            <?php

                                            	$cfrdb = $bdd->prepare("SELECT * FROM ".$_Config_['Database']['table_prefix']."_reactions WHERE MESSAGE_ID = ?");
                                            	$cfrdb->execute(array($m['id']));

                                            	echo '<p>';
                                            	while($re = $cfrdb->fetch()){

	                                            	$path_reaction = $bdd->prepare("SELECT * FROM ".$_Config_['Database']['table_prefix']."_reactions_images WHERE id = ?");
	                                            	$path_reaction->execute(array($re['REACTION_ID']));
	                                            	$path_reaction = $path_reaction->fetch();
	                                            	$path_reaction = $path_reaction['PATH'];

                                            		echo '<a href="?page=profile&id='.$re['USER_ID'].'"><img src="themes/uploaded/reactions/'.$path_reaction.'" alt="Reaction not found" height="25" width="25"> '.$re['USER'].'</a> ';

                                            	}
                                            	echo '</p>';

                                            ?>
                                            </div></div>


                                                </div>

                                        <div class="col-8">
                                        <div class="d-grid gap-2">
                                            <div class="d-flex flex-column">
                                                <?php echo $m['CONTENT']; ?>

                                          </div>
                                            </div>
                                                </div>
                                                </div>
                                                </div><?php if(isset($author['SIGNATURE']) AND !empty($author['SIGNATURE'])){ ?><div class="card-footer"><?php echo $author['SIGNATURE']; ?></div>
                                <?php } ?>

                                </div>
                            <?php }else{ 

                                if($userrank['PERMISSION_LEVEL'] >= $_Config_['General']['staff_permission_level']){
                            // Deleted message viewable only by staff?>
                                        <p>
                                          <div class="alert alert-danger"><b><i class="fas fa-exclamation-circle text-danger"></i></b> Message deleted from <?php echo $author['NAMETAG']; ?> posted on <?php echo date("d/m/Y - H:m", strtotime($m['DATE_POST'])); ?> | <a data-bs-toggle="collapse" href="#deleted-<?php echo $m['id']; ?>" role="button" aria-expanded="false" aria-controls="#deleted-<?php echo $m['id']; ?>">
                                            Show...
                                          </a>
                                        </p>
                                        <div class="collapse" id="deleted-<?php echo $m['id']; ?>">
                                <div class="card mb-3 border-danger">
                                    <div class="card-body py-3">
                                            <div id="my_account" class="card mb-3 <?php echo "text-".$_ThemeOption_['Personnalisation']['text_image_color'].""; ?>" style="background-image: url('<?php echo $_ThemeOption_['Personnalisation']['background_img']; ?>'); background-size: cover;">
                                            <div class="card-header pr-0 pl-0" style="background-image: url('<?php echo $_ThemeOption_['Personnalisation']['background_img']; ?>'); background-size: cover;">
                                                <div class="row no-gutters align-items-center w-100">
                                                    <div class="col font-weight-bold pl-3"></div>
                                                </div>

                                            </div>

                                        </div>
                                        <div class="row ">
                                        <div class="col-4">
                                        <div class="d-grid gap-2">
                                            <div class="d-flex flex-column align-items-center text-center" style="background-image: url('<?php echo $_ThemeOption_['Personnalisation']['background_img']; ?>'); background-size: cover;">
                                            <img src="themes/uploaded/profiles/<?php echo $author['AVATAR_PATH']; ?>" alt="Profile avatar" class="rounded-circle" width="150">
                                            <div class="mt-3">
                                              <h4><a href="?page=profile&id=<?php echo $author['id']; ?>" class="<?php echo "text-".$_ThemeOption_['Personnalisation']['text_image_color'].""; ?>"><?php echo $author['NAMETAG']; ?></a></h4>
                                              <p class="text-secondary mb-1">

                                                    <?php if($authorrank['DISPLAY'] > 0){ ?><span class="badge <?php echo $authorrank['BADGE_COLOR']; ?>"><?php echo strtoupper($authorrank['NAME']); ?></span><br><?php }else{ echo "New member"; } ?>
                                                    <?php if($authorrank['PERMISSION_LEVEL'] > $_Config_['General']['staff_permission_level']){ ?><span class="badge bg-secondary">Staff member</span><?php } ?>

                                              </p>
                                            </div>
                                          </div><div class="d-grid gap-2">
                                              <button disabled class="btn btn-danger btn-sm" type="button"><i class="fas fa-exclamation-circle"></i> This message is deleted</button>
                                                <?php if($userrank['MESSAGE_DELETE'] == "on"){ ?>
                                                    <a href="?page=topic&id=<?php echo htmlspecialchars($_GET['id']); ?>&action=repost&messageid=<?php echo $m['id']; ?>" class="btn btn-success btn-sm" type="button"><i class="fas fa-share"></i> Post to public</a>
                                                <?php } ?>

                                              <center>Posted on <?php echo date("d/m/Y - H:m", strtotime($m['DATE_POST'])); ?></center>
                                            </div></div>


                                                </div>

                                        <div class="col-8">
                                        <div class="d-grid gap-2">
                                            <div class="d-flex flex-column">
                                                <?php echo $m['CONTENT']; ?>

                                          </div>
                                            </div>
                                                </div>
                                                </div>
                                                </div><?php if(isset($author['SIGNATURE']) AND !empty($author['SIGNATURE'])){ ?><div class="card-footer"><?php echo $author['SIGNATURE']; ?></div><?php } ?>

                                </div>
                                        </div></div>
                            <?php }} ?>

                            <?php } ?>
                                    <?php if($sfc['STATUT'] == "1"){ ?>
                                        <div style="background-image: url('<?php echo $_ThemeOption_['Personnalisation']['background_img']; ?>'); background-size: cover;" class="<?php echo "text-".$_ThemeOption_['Personnalisation']['text_image_color'].""; ?> text-center">
                                            <i class="fas fa-lock text-warning" aria-hidden="true"></i> This topic is not open to further responses
                                            </div>
                                    <?php }else{ ?>
                                        <?php if(!(isset($_SESSION['id']))){ ?>
                                        <div style="background-image: url('<?php echo $_ThemeOption_['Personnalisation']['background_img']; ?>'); background-size: cover;" class="<?php echo "text-".$_ThemeOption_['Personnalisation']['text_image_color'].""; ?> text-center">
                                            <i class="fas fa-lock text-warning" aria-hidden="true"></i> You must be logged in to reply to a topic
                                            </div><?php } ?>
                                        <?php if(isset($_SESSION['id'])){ 

                                            if($cfp['PERMISSION_WRITE_LEVEL'] > $userrank['PERMISSION_LEVEL']){
                                        ?>
                                        <div style="background-image: url('<?php echo $_ThemeOption_['Personnalisation']['background_img']; ?>'); background-size: cover;" class="<?php echo "text-".$_ThemeOption_['Personnalisation']['text_image_color'].""; ?> text-center">
                                            <i class="fas fa-lock text-warning" aria-hidden="true"></i> You do not have the necessary permissions to reply to this topic
                                            </div>


                                        <?php }else{ ?>
                                            <div class="card mb-3">
                                                <div class="card-body py-3">

                                                        <div class="row"><?php if(isset($error)){ echo $error; } ?><form method="POST">
                                                        <textarea id="editor1" name="content"></textarea>
                                                        <script>
                                                            // Replace the <textarea id="editor1"> with a CKEditor 4
                                                            // instance, using default configuration.
                                                            CKEDITOR.replace( 'editor1' );
                                                        </script><hr>
                                                        <button type="submit" name="reply" class="btn btn-outline-<?php echo $_ThemeOption_['Personnalisation']['theme_color']; ?>">Reply</button></form>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>

                                    <?php } ?>
                                    <?php } ?>
                                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


<!-- React Modal -->




        <!-- Footer-->
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
