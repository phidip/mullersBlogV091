<?php
  require_once('blogParams.inc.php');
  require_once('DbH.inc.php');
  $dbh = new DbH($db);
  require_once('Table.inc.php');
  require_once('Tablee.inc.php');
  require_once('HTML5.inc.php');
  require_once('HTML5e.inc.php');
  $doc = new HTML5e("Umlaute");

  print($doc->getTop());
  print($doc->toLink("./blog1.css"));
  print($doc->toLink("./blog2.css"));
  print($doc->getNeck());
  print($doc->toHeader());
  include "blogNav.inc.php";   // navigation menu

  print("<section>\n");
  if (isset($_GET['p'])) {
    $sql = sprintf("select author, clocked, subject 
                  from post 
                   order by clocked desc;");
    $tab = new TableE(array("Author", "Clocked", "Subject"));
    $caption = "Most Recent Posts";

  } elseif (isset($_GET['t'])) {
    $sql = sprintf("select post.author, post.clocked, post.subject
                      from post left join thread 
                      on thread.author = post.author 
                      and thread.clocked = post.clocked 
                      order by post.subject, post.clocked;");
  $tab = new TableE(array("Author", "Clocked", "Subject"));
    $caption = "Recent Threads";
  } else {
    die("Illegal parameter, dont play with URL!");
  }

  $dbh->query($sql);
  while ($post = $dbh->fetch_array()) {
    $tab->addRow($post);
  }
  $tab->displayTable($caption);          
  print("</section>\n");
  print($doc->toFooter().$doc->getFoot());
?>