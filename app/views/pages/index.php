<?php require APP_ROOT . '/views/inc/header.php' ?>

<?php
  $cookie_name = $data['cookie_name'];
  if(isset($_COOKIE[$cookie_name])) {
    echo 'You have already submitted within today. You can\'t submit within 24 hours. You can submit after ' . $_COOKIE[$cookie_name];
    die();
  }
?>

<h2>Form Submission</h2>

<div>
  <form action="<?php echo URL_ROOT; ?>/reports/add" method="post" id="buyerEntryForm">
    <table>
      <tr>
        <td><label for="amount">Amount*</label></td>
        <td>
          <input type="number" name="amount" id="amount" min="0" step="1" pattern="\d+" placeholder="Please enter amount"/>   
          <span class="error"></span>
        </td>
      </tr>
      <tr>
        <td><label for="buyer">Buyer*</label></td>
        <td>
          <input type="text" name="buyer" id="buyer" maxlength="20" pattern="/^[a-zA-Z0-9 ]+$/i" placeholder="Please enter buyer"/> 
          <span class="error"></span>
        </td>
      </tr>
      <tr>
        <td><label for="receipt_id">Receipt ID*</label></td>
        <td>
          <input type="text" name="receipt_id" id="receipt_id" pattern="/^[a-zA-Z]+$/i" placeholder="Please enter receipt id"/>
          <span class="error"></span>
        </td>
      </tr>

      <tr>
        <td><label for="items">Items*</label></td>
        <td class="items-wrapper">
          <div class="main-item"> 
            <input type="text" name="items[]" class="" id="items" pattern="/^[a-zA-Z]+$/i" placeholder="Please enter items"/>
            <span class="error"></span>
            <button type="button" class="add-more">Add</button>   
          </div>
        </td>
      </tr>
      
      <tr>
        <td>
          <label for="email">Email*</label>
        </td>
        <td>
          <input type="email" name="email" id="email" placeholder="Please enter email"/>
          <span class="error"></span>
        </td>
      </tr>
      <tr>
        <td><label for="note">Note*</label></td>
        <td>
          <textarea name="note" id="note" cols="40" rows="2" maxlength="30" placeholder="Please enter note"></textarea>
          <span class="error"></span>
        </td>
      </tr>
      <tr>
        <td><label for="city">City*</label></td>
        <td>
          <input type="text" name="city" id="city" pattern="/^[a-zA-Z ]+$/i" placeholder="Please enter city"/>
          <span class="error"></span>
        </td>
      </tr>
      <tr>
        <td><label for="phone">Phone*</label></td>
        <td>
          <input type="number" name="phone" id="phone" min="0" step="1" pattern="\d+" minlength="13" maxlength="13" placeholder="Please enter phone"/>
          <span class="error"></span>
        </td>
      </tr>
      <tr>
        <td><label for="entry_by">Entry By*</label></td>
        <td>
          <input type="number" name="entry_by" id="entry_by" min="0" step="1" pattern="\d+" placeholder="Please enter entry by"/>
          <span class="error"></span>
        </td>
      </tr>

      <tr>
        <td></td>
        <td>
          <input type="submit" name="submit" value="Submit"/>
        </td>
      </tr>
    </table>
  </form>
</div>

<?php require APP_ROOT . '/views/inc/footer.php' ?>