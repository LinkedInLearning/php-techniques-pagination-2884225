<?php

include('../private/initialize.php');
$db = db_connect();  

$customers = find_customers();

?>

<!doctype html>

<html lang="en">
  <head>
    <title>Customer List</title>
    <link rel="stylesheet" href="stylesheets/public.css">
  </head>
  <body>
    
    <h1>Customer List</h1>

    <table id="customer-list">
      <tr>
        <th>First name</th>
        <th>Last name</th>
      </tr>

      <?php
        while($customer = db_fetch_assoc($customers)) {
          echo "<tr>";
          echo "<td>" . h($customer['first_name']) . "</td>";
          echo "<td>" . h($customer['last_name']) . "</td>";
          echo "</tr>";
        } // end while
        db_free_result($customers);
      ?>
    </table>

  </body>
</html>

<?php if(isset($db)) { db_close($db); } ?>
