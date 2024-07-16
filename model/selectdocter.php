<?php
  $stmt = $pdo->prepare("SELECT name, email, password FROM doctorinfo WHERE email = ?");

?>