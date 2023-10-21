<?php

if (!isset($_SERVER['HTTP_REFERER'])) {
  //redirect them to your desired location
  echo "<script>window.location.href='" . APPURL . "' </script>";
  exit;
}

?>
