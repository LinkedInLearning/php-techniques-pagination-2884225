<?php

include('../private/initialize.php');
$db = db_connect();

$total_count = count_customers();
$page = $_GET['page'] ?? 1;
$pagination = new Pagination($total_count, $page, 20);
$customers = find_customers($pagination->per_page, $pagination->offset());

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
      Page <?php echo $pagination->current_page; ?> of <?php echo $pagination->total_pages(); ?>
    </p>

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

    <p class="pagination">
      <?php echo $pagination->previous_link('customers_oo.php'); ?>
      |
      <?php echo $pagination->next_link('customers_oo.php'); ?>
    </p>

  </body>
</html>

<?php if(isset($db)) { db_close($db); } ?>
