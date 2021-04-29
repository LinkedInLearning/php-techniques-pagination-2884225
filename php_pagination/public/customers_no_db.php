<?php

include('../private/initialize.php');
include('../private/customers_array.php');

$per_page = 20;

$total_count = count($all_customers);
$total_pages = ceil($total_count / $per_page);

$current_page = (int) ($_GET['page'] ?? 1);
if($current_page < 1 || $current_page > $total_pages) {
  $current_page = 1;
}

$offset = $per_page * ($current_page - 1);

$customers = array_slice($all_customers, $offset, $per_page);

?>

<!doctype html>

<html lang="en">
  <head>
    <title>Customer List</title>
    <link rel="stylesheet" href="stylesheets/public.css">
  </head>
  <body>

    <h1>Customer List</h1>

    <p class="page-status">
      <?php echo "Page {$current_page} of {$total_pages}"; ?>
    </p>

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
