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
          (isset($_POST['subject']) && $_POST['subject'] != '')
            && (isset($_POST['content']) && $_POST['content'] != '')
        )
      ) {
    header("Location: " . $root);
  } 

  $sql = "start transaction;";
  $dbh->query($sql);
  $sql  = "insert into post";
  $sql .= " (author, clocked, subject, content)";
  $sql .= " values";
  $sql .= sprintf("('%s', '%s', '%s', '%s');"
                  , $_SESSION[$loginToken]
                  , $today
                  , addslashes($_POST['subject'])
                  , addslashes($_POST['content'])
                  );
  $dbh->query($sql);
  foreach ($_POST['tags'] as $tag) {
    if(!empty($tag)) {
      $sql = "insert into tags";
      $sql .= " (author, clocked, tag)"; 
      $sql .= " values";
      $sql .= sprintf("('%s', '%s', '%s');"
                      , $_SESSION[$loginToken]
                      , $today 
                      , $tag
                      );
      $dbh->query($sql);
    }
  }
  $dbh->query('commit;');
  header("Location: " . $root);
?>