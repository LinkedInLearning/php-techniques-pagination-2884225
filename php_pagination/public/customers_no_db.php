<?php

include('../private/initialize.php');
include('../private/customers_array.php');

$customers = $all_customers;

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

      foreach($customers as $customer) {
        $first_name = $customer[0];
        $last_name = $customer[1];
        echo "<tr>";
        echo "<td>" . h($first_name) . "</td>";
        echo "<td>" . h($last_name) . "</td>";
        echo "</tr>";
      }

      ?>
  
    </table>

  </body>
</html>
