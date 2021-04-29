<?php

include('../private/initialize.php');
$db = db_connect();

$per_page = 20;

$total_count = count_customers();
$total_pages = ceil($total_count / $per_page);

$current_page = (int) ($_GET['page'] ?? 1);
if($current_page < 1 || $current_page > $total_pages) {
  $current_page = 1;
}

$offset = $per_page * ($current_page - 1);

$customers = find_customers($per_page, $offset);

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
      <?php
      if($current_page > 1) {
        echo "<a href=\"customers.php?page=" . ($current_page - 1) . "\">&larr; Previous</a>";
      }
      ?>

      <?php
      $win = 2; // window size
      $gap = false;
      for($i=1; $i <= $total_pages; $i++) {
        if($i > 1 + $win && $i < $total_pages - $win && abs($i - $current_page) > $win) {
          if(!$gap) {
            echo "... ";
            $gap = true;
          }
          continue;
        }
        $gap = false;
        if($current_page == $i) {
          echo "<strong>{$i}</strong> ";
        } else {
          echo "<a href=\"customers.php?page={$i}\">{$i}</a> ";
        }
      }
      ?>

      <?php
      if($current_page < $total_pages) {
        echo "<a href=\"customers.php?page=" . ($current_page + 1) . "\">Next &rarr;</a>";
      }
      ?>
    </p>

  </body>
</html>

<?php if(isset($db)) { db_close($db); } ?>
