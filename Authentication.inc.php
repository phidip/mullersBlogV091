interface Authentication {
  function authenticate($user, $pwd, $token, $database);
  function isLoggedIn();
}