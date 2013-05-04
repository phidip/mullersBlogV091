<?php
    $sql = sprintf("select author, clocked, subject, content 
                   from post 
                   where author='%s'
                   and clocked='%s'", $_GET['au'], $_GET['cl']);
    $dbh->query($sql);
    $post = $dbh->fetch_array();
    printf("<div style='border:1px solid red;'><p><b>User:</b> %s, <b>Date:</b> %s</p>\n", 
           $post['author'], $post['clocked']);
    printf("<p><b>Subject:</b> %s</p>\n", 
           $post['subject']);
    printf("<p><b>Post:</b> %s</p></div>\n", 
           $post['content']);
?>
