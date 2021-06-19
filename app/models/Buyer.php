<?php
class Buyer
{
  private $db, $table;

  public function __construct() {
    $this->db = new Database();
    $this->table = TABLE_NAME;
  }

  public function getAllUsers() {
    $this->db->query("SELECT distinct entry_by FROM ".$this->table." order by entry_by");
    return $this->db->resultSet();
	}

  public function getAllEntries($entry_by='', $date_from='', $date_to='') {
		$sql = "SELECT * FROM ".$this->table;
		$params = [];

		if($entry_by !='' || $date_from !='' || $date_to != '') {
			$sql .= ' WHERE ';

			if($entry_by != '') {
				$sql .= "entry_by = :entry_by";
				// array_push($params, $entry_by);
        $params['entry_by'] = $entry_by;
			}
	
			if($date_from !='' || $date_to != '') {
				if(!($date_from !='' && $date_to != '')) {
					($date_from == '') ?	$date_from = '2000-01-01' :	$date_to = date('Y-m-d');
				}

        // entry_at
				$between_sql = "entry_at BETWEEN :date_from AND :date_to";
				$sql .= ($entry_by != '') ? " && (".$between_sql.")" : $between_sql;
	
        $params['date_from'] = $date_from;
        $params['date_to'] = $date_to;
			}
		}

		$sql .= " order by id desc";

    $this->db->query($sql);
    if(count($params) > 0) {
      foreach($params as $key => $value) {
        $this->db->bind(':'.$key, $value); // Bind values
      }
    }

    return $this->db->resultSet();
	}

  public function addEntry($safe_data) {
    $this->db->query("INSERT INTO ".$this->table."(amount, buyer, receipt_id, items, buyer_email, buyer_ip, note, 
      city, phone, hash_key, entry_at, entry_by) VALUES (:amount, :buyer, :receipt_id, 
        :items, :buyer_email, :buyer_ip, :note, :city, :phone, :hash_key, :entry_at, :entry_by)");
     
    foreach($safe_data as $key => $value) {
      $this->db->bind(':'.$key, $value); // Bind values
    }
    
    return ($this->db->execute()) ? true : false;
  }
}