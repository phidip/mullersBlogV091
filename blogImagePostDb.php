<?php
  session_start();
  require_once('blogParams.inc.php');
  require_once('DbH.inc.php');
  require_once('Authentication.inc.php');
  require_once('authenticator.inc.php');

  $dbh = new DbH($db);
  $auth = new Authenticator($dbh, $root, $loginToken);
  $auth->isLoggedIn(); //check login - new way

  if (!(
          (isset($_POST['alttext']) && $_POST['alttext'] != '')
            && (isset($_POST['caption']) && $_POST['caption'] != '')
            && (isset($_FILES['image']) && $_FILES['image']['size'] > 0)
        )
      ) {
    header("Location: ../code/".$root."?x=1");
  } 
  $db = "mullersBlog";
  $today = strftime("%F", time());

  require_once('DbH.inc.php');
  $dbh = new DbH($db);

  // Temporary file name stored on the server
  $tmpName = $_FILES['image']['tmp_name'];
  // Read the file
  $fp = fopen($tmpName, 'r');
  $image = fread($fp, filesize($tmpName));
  $image = addslashes($image);
  fclose($fp);

  $avatar = false;
  if ($_POST['avatar'] == 'on')
    $avatar = true;
  $copyr = true;
  if ($_POST['copyright'] == 'off')
    $copyr = false;

  $sql  = "insert into resource";
  $sql .= " (mimetype, alttext, caption, avatar";
  $sql .= ", copyrightrestricted, user, resourceitself)";
  $sql .= " values";
  $sql .= sprintf("('%s','%s','%s','%s','%s','%s','%s')"
                    , $_FILES['image']['type']
                    , $_POST['alttext']
                    , $_POST['caption']
                    , $avatar
                    , $copyr
                    , $_SESSION[$loginToken]
                    , $image
                    );
  $dbh->query($sql);
  $dbh->query('commit;');
  header("Location: ".$root."?x=2");
?>