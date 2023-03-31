<?php

function getTotaEncounter()
{
  global $mysqli;

  $query = "SELECT COUNT(*) FROM `persons` WHERE `covid19_encounter` = 1;";

  $result = $mysqli->query($query);
  $row = $result->fetch_row();

  mysqli_free_result($result);

  return $row[0];
}

function getVaccinatedCount()
{
  global $mysqli;

  $query = "SELECT COUNT(*) FROM `persons` WHERE `vaccinated` = 1;";

  $result = $mysqli->query($query);
  $row = $result->fetch_row();

  mysqli_free_result($result);

  return $row[0];
}

function getHasFeverCount()
{
  global $mysqli;

  $query = "SELECT COUNT(*) FROM `persons` WHERE `temperature` >= 37;";

  $result = $mysqli->query($query);
  $row = $result->fetch_row();

  mysqli_free_result($result);

  return $row[0];
}

function getAdultsCount()
{
  global $mysqli;

  $query = "SELECT COUNT(*) FROM `persons` WHERE `age` >= 18;";

  $result = $mysqli->query($query);
  $row = $result->fetch_row();

  mysqli_free_result($result);

  return $row[0];
}

function getMinorsCount()
{
  global $mysqli;

  $query = "SELECT COUNT(*) FROM `persons` WHERE `age` < 18;";

  $result = $mysqli->query($query);
  $row = $result->fetch_row();

  mysqli_free_result($result);

  return $row[0];
}

function getForeignersCount()
{
  global $mysqli;

  $query = "SELECT COUNT(*) FROM `persons` WHERE `nationality` <> 'philippines';";

  $result = $mysqli->query($query);
  $row = $result->fetch_row();

  mysqli_free_result($result);

  return $row[0];
}
