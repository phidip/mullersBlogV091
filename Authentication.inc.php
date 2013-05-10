<?php
interface Authentication {
  public function authenticate($user, $pwd);
  public function isLoggedIn();
}
?>