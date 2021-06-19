<?php require APP_ROOT . '/views/inc/header.php' ?>

<?php
  $entries    = $data['entries'];
  $users      = $data['users'];
  $entry_by   = $data['entry_by'];
  $date_from  = $data['date_from'];
  $date_to    = $data['date_to'];
?>

<h2>Report</h2>
        
<div class="wrapper">
  <?php
    if(count($entries) > 0) { ?>
      <form action="<?php echo URL_ROOT; ?>/reports" method="post" id="filterForm">
        <p>
          <label for="date_from">Date From</label>
          <input type="text" name="date_from" id="date_from" value="<?php echo $date_from; ?>">
          
          <label for="date_to">To</label>
          <input type="text" name="date_to" id="date_to" value="<?php echo $date_to; ?>">

          <select name="user" id="user">
            <option value="" <?php echo $entry_by == '' ? 'selected' : '' ?>>Filter by User ID</option>
            <?php
              foreach($users as $entry) {
                $user = $entry['entry_by'];
            ?>
            <option value="<?php echo $user; ?>" <?php echo $entry_by == $user ? 'selected' : '' ?>><?php echo $user; ?></option>
            <?php } ?>
          </select>

          <input type="submit" name="filter" value="Filter"/>
          <button type="button">
            <a href="<?php echo URL_ROOT; ?>/reports" style="text-decoration: none;">Clear Filter</a>
          </button>
        </p>
      </form>
  <?php } ?>

	<?php
    if(count($entries) > 0) { ?>
      <table class="">
        <tr>
          <th>Amount</th>
          <th>Buyer</th>
          <th>Receipt ID</th>
          <th>Items</th>
          <th>Email</th>
          <th>Note</th>
          <th>City</th>
          <th>Phone</th>
          <th>Entry At</th>
          <th>Entry By</th>
        </tr>
    
        <?php
          foreach($entries as $entry) {
            $items = unserialize($entry['items']);
        ?>
        <tr>
          <td><?php echo $entry['amount']; ?></td>
          <td><?php echo $entry['buyer']; ?></td>
          <td><?php echo $entry['receipt_id']; ?></td>
          <td><?php echo join(', ', $items); ?></td> 
          <td><?php echo $entry['buyer_email']; ?></td>
          <td><?php echo $entry['note']; ?></td>
          <td><?php echo $entry['city']; ?></td>
          <td>+880<?php echo $entry['phone']; ?></td>
          <td><?php echo date_format(date_create($entry['entry_at']), 'j M, Y'); ?></td>
          <td><?php echo $entry['entry_by']; ?></td>
        </tr>
        <?php } ?>
      </table>

  <?php 
    } else { 
      echo "No entries added yet."; 
    }
  ?>
</div>

<?php require APP_ROOT . '/views/inc/footer.php' ?>