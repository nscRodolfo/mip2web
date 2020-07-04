<?php
  session_start();
      unset($_SESSION['logado']); 
      unset($_SESSION['email']);
      unset($_SESSION['nome']);
      unset($_SESSION['id']);
      header('location: index.html');
?>