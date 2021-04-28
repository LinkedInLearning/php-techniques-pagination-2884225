<?php

  function find_customers() {
    global $db;
    $sql = "SELECT * FROM customers ";
    $sql .= "ORDER BY last_name ASC, first_name ASC";
    $result = db_query($db, $sql);
    return $result;
  }

?>
