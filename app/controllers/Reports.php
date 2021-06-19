<?php
class Reports extends Controller
{
	public function __construct() {
  	$this->buyerModel = $this->model('Buyer');
  }

  public function index() {
    $entry_by = $date_from = $date_to = '';

		if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['filter'])) {
			$entry_by = (isset($_POST['user']) && !empty($_POST['user'])) ? intval($_POST['user']) : '';
			$date_from = (isset($_POST['date_from']) && !empty($_POST['date_from'])) ? clean_input($_POST['date_from']) : '';
			$date_to = (isset($_POST['date_to']) && !empty($_POST['date_to'])) ? clean_input($_POST['date_to']) : '';
		} 

		$entries = $this->buyerModel->getAllEntries($entry_by, $date_from, $date_to);
		$users = $this->buyerModel->getAllUsers();

		$data = [
			'entries'   => $entries,
			'users'     => $users,
			'entry_by'  => $entry_by, 
			'date_from' => $date_from, 
			'date_to'   => $date_to
		];

    $this->view('reports/index', $data);
  }

  public function add() {
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
      $post_data         = $_POST;
      $validation_errors = [];
    
      $amount   = (isset($post_data['amount']) && !empty($post_data['amount'])) ? $post_data['amount'] : '';
      $entry_by = (isset($post_data['entry_by']) && !empty($post_data['entry_by'])) ? $post_data['entry_by'] : '';
      $phone    = (isset($post_data['phone']) && !empty($post_data['phone'])) ? $post_data['phone'] : '';
    
      // amount
      if(!empty($amount)) {
        if(!check_number($amount)) {
          $validation_errors['amount'] = "Only number is allowed";
        }
      } else {
        $validation_errors['amount'] = "Please enter amount";
      }
    
      // entry_by
      if(!empty($entry_by)) {
        if(!check_number($entry_by)) {
          $validation_errors['entry_by'] = "Only numbers are allowed";
        }
      } else {
        $validation_errors['entry_by'] = "Please enter entry by";
      }
    
      // phone
      if(!empty($phone)) {
        if(!check_number($phone)) {
          $validation_errors['phone'] = "Only number is allowed";
        }
      } else {
        $validation_errors['phone'] = "Please enter phone";
      }
    
      // buyer
      $buyer = (isset($post_data['buyer']) && !empty($post_data['buyer'])) ? clean_input($post_data['buyer']) : '';
      if (!empty($buyer)) {
        if(strlen($buyer) > 20) {
          $validation_errors['buyer'] = "Buyer should have not more than 20 characters";
        } elseif (!preg_match('/^[a-zA-Z0-9 ]+$/i', $buyer)) {
          $validation_errors['buyer'] = "Buyer should contain only text, numbers and spaces";
        }
      } else {
        $validation_errors['buyer'] = "Please enter buyer";
      }
    
      // receipt_id
      $receipt_id = (isset( $post_data['receipt_id']) && !empty($post_data['receipt_id'])) ? $post_data['receipt_id'] : '';
      if(!empty($receipt_id)) {
        if(!ctype_alpha( $receipt_id)) {
          $validation_errors['receipt_id'] = "Receipt id should only be text";
        }
      } else {
        $validation_errors['receipt_id'] = "Please enter receipt id";
      }
    

      // items
      $items = (isset($post_data['items']) && is_array($post_data['items']) && !empty($post_data['items'][0])) ? $post_data['items'] : '';
    
      if(!empty($items)) {
        if(count($items) > 1) {
          foreach($items as $item_index => $item_val) {
            if($item_val != '') {
              if(!ctype_alpha($item_val)) {
                $validation_errors['items'] = "Items should only be text";
              }
            } else {
              unset($items[$item_index]);
            }
          }
        } else {
          if(!ctype_alpha($items[0])) {
            $validation_errors['items'] = "Items should only be text";
          }
        }
      } else {
        $validation_errors['items'] = "Please enter items";
      }
    
      // email
      $email = (isset($post_data['email']) && !empty( $post_data['email'])) ? filter_var($post_data['email'], FILTER_SANITIZE_EMAIL) : '';
      if(!empty($email)) {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $validation_errors['email'] = "Please enter a valid email address";
        }
      } else {
        $validation_errors['email'] = "Please enter email address";
      }
    
      // note
      $note = (isset($post_data['note']) && !empty($post_data['note'])) ? clean_input($post_data['note']) : '';
      if(!empty($note)) {
        if(strlen($note) > 30) {
          $validation_errors['note'] = "Note should have no more than 30 characters";
        }
      } else {
        $validation_errors['note'] = "Please enter note";
      }
    
      // city
      $city = (isset($post_data['city']) && !empty($post_data['city'])) ? $post_data['city'] : '';
      if(!empty($city)) {
        if(!preg_match('/^[a-zA-Z ]+$/i', $city)) {
          $validation_errors['city'] = "City should contain only text and spaces";
        }
      } else {
        $validation_errors['city'] = "Please enter city";
      }
    
      $responses                      = [];
      $responses['error_exists']      = 0;
      
      if(count($validation_errors) == 0) {
        $ip = get_client_ip();
        $hash_key = hash("sha512", $receipt_id);
    
        date_default_timezone_set('UTC');
        $entry_at = new DateTime('now', new DateTimeZone("+6"));
        $entry_at = $entry_at->format('Y-m-d');
    
        $safe_data                = [];
        $safe_data['amount']      = intval($amount);
        $safe_data['buyer']       = $buyer;
        $safe_data['receipt_id']  = $receipt_id;
        $safe_data['items']       = serialize($items);
        $safe_data['buyer_email'] = $email;
        $safe_data['buyer_ip']    = $ip;
        $safe_data['note']        = $note;
        $safe_data['city']        = $city;
        $safe_data['phone']       = intval($phone);
        $safe_data['hash_key']    = $hash_key;
        $safe_data['entry_at']    = $entry_at;
        $safe_data['entry_by']    = intval($entry_by);
    
        $this->buyerModel->addEntry($safe_data);

      } else {
        $responses['error_exists']      = 1;
        $responses['validation_errors'] = $validation_errors;
      }
    
      echo json_encode($responses);
      die();
    }
  }

}