<?php
require_once('./includes/db.php');

if(!$_GET && !$_GET['id']) {
  header('Location: index.php');
  die();
}

$id = $_GET['id'];

$delete_query = "DELETE FROM `persons` WHERE `id` = {$id}";

if ($mysqli->query($delete_query)) {
  header('Location: records.php');
  die();
}

if ($mysqli->errno) {
  die("Could not delete record from table: %s<br /> {$mysqli→error}");
}
