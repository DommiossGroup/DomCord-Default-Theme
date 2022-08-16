<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/x-icon" href="themes/uploaded/favicon.ico" />

    <!-- SEO -->

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content='maximum-scale=1.0, initial-scale=1.0, width=device-width' name='viewport'>


    <meta name="keywords" content="<?php echo $_Config_['Metadata']['keywords']; ?>" />
    <meta name="robots" content="<?php echo $_Config_['Metadata']['robots']; ?>" />

    <meta property="og:title" content="<?php echo $_Config_['General']['name']; ?>">
    <meta property="og:image" content="themes/uploaded/favicon.ico">
    <meta property="og:description" content="<?php echo $_Config_['General']['description']; ?>">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="<?php echo "themes/" . $_Config_['General']['theme'] . "/assets/css/styles.php?theme_name_domcord_root=" . $_Config_['General']['theme']; ?>" rel="stylesheet" type="text/css" media="all" />

    <title><?php if (isset($pagetitle) and !empty($pagetitle)) {
                echo $pagetitle;
            } else {
                echo pageTitle;
            } ?> - <?php echo $_Config_['General']['name']; ?></title>
</head>


<body>

    <header>
        <section class="header-content gradient-banner">
            <nav class="navbar navbar-expand-lg navbar-light bg-header-buttons">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        </ul>
                        <div class="d-flex">
                            <?php if (!isset($_SESSION['id'])) { ?>
                                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                    <li class="nav-item ps-2">
                                        <a class="btn btn-primary btn-sm" href="?page=login"><i class="fas fa-key"></i> <?php echo Lang::navbar_signin; ?></a>
                                    </li>
                                    <li class="nav-item ps-2">
                                        <a class="btn btn-light btn-sm" href="?page=register"><i class="fas fa-key"></i> <?php echo Lang::navbar_signup; ?></a>
                                    </li>
                                </ul>
                            <?php } else { ?>
                                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                    <li class="nav-item ps-2">
                                        <a class="btn btn-warning btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#notifmodal"><i class="far fa-bell"></i> Notifications</a>
                                    </li>
                                    <li class="nav-item ps-2">
                                        <a class="btn btn-primary btn-sm" href="?page=account"><i class="fas fa-users"></i> <?php echo Lang::title_account; ?></a>
                                    </li>
                                    <?php if (isset($userrank) and $userrank['ADMIN_PANELACCESS'] == "on") { ?>
                                        <li class="nav-item ps-2">
                                            <a class="btn btn-danger btn-sm" href="./Administration"><i class="fas fa-cog"></i> <?php echo Lang::navbar_admin; ?></a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </nav>
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        </ul>
                        <div class="d-flex">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <?php while ($p = $headerlinks->fetch()) { ?>
                                    <li class="nav-item"><a class="nav-link text-light" href="<?php echo $p['LINK']; ?>"><i class="<?php echo $p['ICON']; ?>"></i> <?php echo $p['NAME']; ?></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            <div class="center-absolute">
                <h1 class="header-title animate-pop-in"><?php if (isset($page) AND $page == "home") {
                                                            echo $_Config_['General']['name'];
                                                        } else {
                                                            if (isset($pagetitle) and !empty($pagetitle)) {
                                                                echo $pagetitle;
                                                            } else {
                                                                echo pageTitle;
                                                            }
                                                        } ?></h1>
                <h1 class="sub-title animate-pop-in"><?php if (isset($page) AND $page == "home") {
                                                            echo $_Config_['General']['description'];
                                                        } ?></h1>
                <?php if (!isset($_SESSION['id']) AND isset($page) AND $page == "home") { ?><a class="btn btn-light btn-sm animate-pop-in" href="?page=register"><i class="fas fa-key"></i> <?php echo Lang::footer_joinus; ?></a><?php } ?>
            </div>
        </section>
    </header>

    <div class="container">
        <div class="small-separator"></div>
        <nav style="--bs-breadcrumb-divider: '»';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="link" href="<?php if (isset($page) AND $page !== "home") {
                                                                        echo "?page=home";
                                                                    } ?>"><i class="fas fa-home"></i> Home</a></li>
                <?php if (isset($page) AND $page !== "home" and !isset($pagetitle) or empty($pagetitle)) { ?>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo pageTitle; ?></li>
                <?php } ?>
                <?php if (isset($pagetitle) and !empty($pagetitle)) { ?>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo $pagetitle; ?></li>
                <?php } ?>
            </ol>
        </nav>
        <hr>
    </div>
    <div class="separator"></div>
    <div class="modal fade" id="notifmodal" tabindex="-1" aria-labelledby="notifmodal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Unread notifications</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php if (isset($_SESSION['id'])) { ?>
                        <?php if (isset($notificationlist_unread) and $notificationlist_unread->rowCount() < 1) { ?><div class="alert alert-danger"><b><i class='fas fa-bell'></i></b> You have any unread notification</div><?php } ?>
                        <?php while ($p = $notificationlist_unread->fetch()) {

                            if (!empty($p['NOTIF_USERAVATAR'])) {
                                if (file_exists("themes/uploaded/profiles/" . $p['NOTIF_USERAVATAR'])) {
                                    $p_avatar = "profiles/" . $p['NOTIF_USERAVATAR'];
                                } else {
                                    $p_avatar = "unknown.jpg";
                                }
                            } else {
                                $p_avatar = "unknown.jpg";
                            }

                        ?>
                            <li class="dropdown-item">
                                <p style="width: 100%"><img class="rounded-circle z-depth-2" width="30" height="30" src="themes/uploaded/<?php echo $p_avatar; ?>" data-holder-rendered="true"> <?php echo $p['HTML_CONTENT']; ?></p>
                            </li>
                        <?php } ?>
                    <?php } ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                    <a href="?page=<?php if(isset($page)) echo $page; ?>&action=markallread" class="btn btn-danger btn-sm">Mark all has read</a>
                </div>
            </div>
        </div>
    </div>
