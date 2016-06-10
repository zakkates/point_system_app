<?php   
session_start();
if ($_COOKIE['id']) { $_SESSION['id'] = $_COOKIE['id']; }
if (!$_SESSION['id'] && $_SERVER['REQUEST_URI'] != '/point-system/index.php') { header("Location:index.php"); exit; }
require_once("connection.php");
include('inc/user-data.php');

?>

<html>
<head>
    <title>Earn Points!</title>
    <link rel='stylesheet' id='theme-style-css'  href='style.css?ver=1.0' type='text/css' media='all' /> 
    <link rel="apple-touch-icon" href="images/home-icon.jpg" />
    <link rel="apple-touch-startup-image" href="images/startup-icon.png">
	<meta name="viewport" content="width=device-width; initial-scale=1.0; user-scalable=no;" > 
    <script type='text/javascript' src='https://code.jquery.com/jquery-1.12.3.min.js?ver=1.12'></script>
    <script type='text/javascript' src='https://code.jquery.com/jquery-migrate-1.2.1.min.js?ver=1.2.1'></script>
    <script type='text/javascript' src='https://code.jquery.com/ui/1.11.4/jquery-ui.js?ver=1.11.4'></script>
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js?ver=2.8.3'></script>
</head>
    
<?php if ($_SESSION['id']): ?>
<header>
    <div class="container">
        <span class="login-id">Welcome <?php echo $user_data['parent_first_name'] ?>, ID: <?php if ($_SESSION) {echo $_SESSION['id'] . "-" . $_COOKIE['id'];}  ?></span>
    <nav>
        <ul>
            <?php if ($_SESSION): ?>
            <li><a href="points.php">Points</a>
            </li>
            <li><a href="profile.php">Profile</a>
            </li>
            <?php endif; ?>
            <?php if ($_SESSION[ 'id']==1 ): ?>
                <li><a href="#">Debug</a>
                    <ul>
                        <li><a href="index.php">Home</a>
                        </li>
                        <li><a href="create-new-child.php">Create New Child</a>
                        </li>
                        <li><a href="add-existing-child.php">Add Existing Child</a>
                        </li>
                        <li><a href="list-all-parents.php">List All Parents</a>
                        </li>
                        <li><a href="list-all-children.php">List All Children</a>
                        </li>
                        <li><a href="list-all-points.php">List All Points</a>
                        </li>
                        <li><a href="list-all-child-parent-relationships.php">List All Parent / Child Relationships</a>
                        </li>
                    </ul>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
    </div><!-- end container -->
</header>
<?php endif; #endif loggedin ?>
<div class="container">
