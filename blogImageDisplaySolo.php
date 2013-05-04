<?php
  session_start();
  if (!isset($_SESSION['blogUser'])) {  // am I logged on?
    header("Location: ../code/forumindex.php?errorcode=2");
  }                                 // if not, go and do it!

  $copy = "&copy; NML, 2013";
  $title = "Muller&apos;s Blog";
  $db = "mullersBlog";
  $today = strftime("%F", time());

  require_once('DbH.inc.php');
  $dbh = new DbH($db);
  require_once('HTML5.inc.php');
  $doc = new HTML5($title, "en");

  print($doc->getTop());
  $doc->prtLink("./ass1M1.css");
  print($doc->getNeck());
  $doc->prtHeader("blogIndex.php");
  include "blogNav.inc.php";
?> 
  <section>
    <h2>Display Images</h2>
<?php
    printf("<p>\n<b>User:</b> %s\n<b>Date:</b> %s\n</p>"
        , $_SESSION['blogUser']
        , $today);
    
    $sql  = "select id, mimetype, alttext, caption, avatar
    		       , copyrightrestricted
    			   , user";
    $sql .= " from resource;";
    $dbh->query($sql);
    print("<table>");
    
    while($out = $dbh->fetch_object()) {
		printf("<tr id='sep'><td>%s</td>
  		            <td rows='7'><img src='blogImageView.php?pid=%s'/></td></tr>\n"
  		            , $out->id, $out->id 
		            );
		printf("<tr><td>%s</td></tr>\n", $out->mimetype);
		printf("<tr><td>%s</td></tr>\n", $out->alttext);
		printf("<tr><td>%s</td></tr>\n", $out->caption);
		printf("<tr><td>%s</td></tr>\n", $out->avatar);
		printf("<tr><td>%s</td></tr>\n", $out->copyrightrestricted);
		printf("<tr><td>%s</td></tr>\n", $out->user);
	}
    print ("</table>");
?>

<?php
  print($doc->getFoot());
?>