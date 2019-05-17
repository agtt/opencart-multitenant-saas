<?php
namespace DB;
final class MySQLi {
	private $link;

	public function __construct($hostname, $username, $password, $database) {
		$this->link = new \mysqli($hostname, $username, $password, $database);

		if ($this->link->connect_error) {
			trigger_error('Error: Could not make a database link (' . $this->link->connect_errno . ') ' . $this->link->connect_error);
		}

		$this->link->set_charset("utf8");
		$this->link->query("SET SQL_MODE = ''");
		
		/* @multitenant */
		/* pass tenant_id value to db context */
		global $tenant_id;
		if ($tenant_id > -1 || $tenant_id == -99) {
			$this->link->query("DECLARE @COMPANY_ID BIGINT");
			$this->link->query("SET @COMPANY_ID = " . $tenant_id);
		
			$this->link->query("DECLARE @TENANT_ID BIGINT");
			$this->link->query("SET @TENANT_ID = " . $tenant_id);
		}
		/* end of multitenant */
	}

	public function query($sql) {
		$query = $this->link->query($sql);

		if (!$this->link->errno) {
			if ($query instanceof \mysqli_result) {
				$data = array();

				while ($row = $query->fetch_assoc()) {
					$data[] = $row;
				}

				$result = new \stdClass();
				$result->num_rows = $query->num_rows;
				$result->row = isset($data[0]) ? $data[0] : array();
				$result->rows = $data;

				$query->close();

				return $result;
			} else {
				return true;
			}
		} else {
			trigger_error('Error: ' . $this->link->error  . '<br />Error No: ' . $this->link->errno . '<br />' . $sql);
		}
	}

	public function escape($value) {
		return $this->link->real_escape_string($value);
	}

	public function countAffected() {
		return $this->link->affected_rows;
	}

	public function getLastId() {
		return $this->link->insert_id;
	}

	public function __destruct() {
		$this->link->close();
	}
}