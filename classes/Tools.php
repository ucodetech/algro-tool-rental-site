<?php  
/**
 * Log book
 */
class Tools
{
	private  $_user,
			 $_db;
	
	function __construct()
	{
		$this->_user = new User();
		$this->_db = Database::getInstance();

	}


	// check placement
	public function getItems($item_id)
	{
		$check = $this->_db->get('farmTools', array('id', '=', $item_id));
		if ($check->count()) {
			return $check->first();
		}else{
			return false;
		}
	}

	public function getRented($uniqueid)
	{
		$check = $this->_db->get('transactions', array('user_uniqueid', '=', $uniqueid));
		$check = $this->_db->query("SELECT * FROM transactions WHERE user_uniqueid = '$uniqueid'  AND delivered = 1 AND returned = 0 ");
		if ($check->count()) {
			return $check->results();
		}else{
			return false;
		}
	}

	// insert to different tables
	public function create($table, $fields=array())
	{
		if (!$this->_db->insert($table, $fields)) {
			throw new Exception("Error Inserting data!", 1);
		}
	}


	public function fetchInventory($table, $field, $value)
	{
		$get = $this->_db->get($table, array($field, '=', $value));
		if ($get->count()) {
			return $get->results();
		}else{
			return false;
		}
	}

	

}//end of class