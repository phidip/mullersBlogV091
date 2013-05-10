<?php
  session_start();
  require_once('blogParams.inc.php');
  if (!isset($_SESSION[$loginToken])) {  // am I logged on?
    header("Location: ".$root."?errorcode=2");
  }                                 // if not, go and do it!

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
  print($doc->toScript("./blogJsLib.js"));
  print($doc->getNeck());
  print($doc->toHeader());
?> 
  <section>
    <h2>Display Images</h2>
<?php
    printf("<p>\n<b>User:</b> %s\n<b>Date:</b> %s\n</p>"
        , $_SESSION[$loginToken]
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
  print($doc->toFooter().$doc->getFoot());
?>