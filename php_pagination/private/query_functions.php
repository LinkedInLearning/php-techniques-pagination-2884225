<?php

  function find_customers($limit=0, $offset=0) {
    global $db;
    $sql = "SELECT * FROM customers ";
    $sql .= "ORDER BY last_name ASC, first_name ASC";
    if($limit > 0) {
      $sql .= " LIMIT " . db_escape($db, $limit);
    }
    if($offset > 0) {
      $sql .= " OFFSET " . db_escape($db, $offset);
    }
    $result = db_query($db, $sql);
    return $result;
  }

  function count_customers() {
    global $db;
    $sql = "SELECT COUNT(*) FROM customers ";
    $result = db_query($db, $sql);
    $array = db_fetch_assoc($result);
    return $array['COUNT(*)'];
  }

?>
