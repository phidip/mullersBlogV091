<?php
  session_start();
  if (!isset($_SESSION['blogUser'])) {  // am I logged on?
    header("Location: ./blogIndex.php?errorcode=2");
  }                                 // if not, go and do it!

  if (!(
          (isset($_POST['subject']) && $_POST['subject'] != '')
            && (isset($_POST['content']) && $_POST['content'] != '')
        )
      ) {
    header("Location: ./blogIndex.php");
  } 
  require_once('DbH.inc.php');
  $dbh = new DbH("mullersBlog");
  $today = strftime("%F %T", time());
  $sql = "start transaction;";
  $dbh->query($sql);
  $sql  = "insert into post";
  $sql .= " (author, clocked, subject, content)";
  $sql .= " values";
  $sql .= sprintf("('%s', '%s', '%s', '%s');"
                  , $_SESSION['blogUser']
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
                      , $_SESSION['blogUser']
                      , $today 
                      , $tag
                      );
      $dbh->query($sql);
    }
  }
  $dbh->query('commit;');
  header("Location: ./blogIndex.php");
?>