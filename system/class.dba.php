<?php
/***************************************************************************
 *						   system/class.dba.php
 *							-------------------
 *	 begin				: 03-29-2008
 *	 copyright			: (c) 2008 The phpBG Team
 *	 email				: phpbg@gmail.com
 *
 ****************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 3 of the License, or
 *   (at your option) any later version.
 *   This program is distributed in the hope that it will be useful,
 *   but WITHOUT ANY WARRANTY; without even the implied warranty of
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 *   GNU General Public License for more details.
 *
 ***************************************************************************/

class database
{
	protected $db;
	protected $data;
	protected $state;
	protected $supported = array("PDOMySQL", "MySQL");
	
	public $sql;
	public $result;
	public $affected_rows;
	
	/**
	*   Loads the properties and assigns them to a protected variable
	*   @access public
	*/
	public function __construct()
	{
		include("config/properties.php");
		if(in_array($database['type'], $this->supported))
		{
			$this->data = $database;
		}
		else log::_append("Database type is not supported", log::ERROR);
	}
	/**
	*   Connects to the database via the defined database layer
	*   @access protected
	*/
	protected function _connect()
	{
		switch($this->data['type'])
		{
			default:
			case "PDOMySQL":
				$this->db = new PDO("mysql:host=".$this->data['host'].";
								port=".$this->data['port'].";
								dbname=".$this->data['data'],
								$this->data['user'],
								$this->data['pass']);
				break;
			case "MySQL":
				$this->db = mysql_connect($this->data['host'].$this->data['host'],$this->data['user'],$this->data['pass']);
					mysql_select_db($this->data['data'], $this->db);
				break;
		}
	}
	/**
	*   Closes the database connection of the database layer
	*   @access protected
	*/
	protected function _close()
	{
		switch($this->data['type'])
		{
			default:
			case "PDOMySQL":
				$this->db = null;
				break;
			case "MySQL":
				mysql_close($this->db);
				break;
		}
	}
	/**
	*   Executes the query given in $this->sql. Each "?" must have a replacement in $arrvalues
	*   @param array $arrvalues The values ordered for the replacements
	*   @access public
	*/
	public function _query($arrvalues = null)
	{
		$this->sql = str_replace("§PREFIX§", $this->data['sufx'], $this->sql);
		switch($this->data['type'])
		{
			default:
			case "PDOMySQL":
				try
				{
					$this->_connect();
					$this->state = $this->db->prepare($this->sql);
					($arrvalues != null) ? $this->state->execute($arrvalues) : $this->state->execute();
					$this->affected_rows = $this->state->rowCount();
					$this->result = $this->state->fetchAll();
					$this->_close();
				}
				catch(PDOException $e)
				{
					log::_append($e, log::ERROR);
				}
				break;
			case "MySQL":
				$this->_connect();
				$this->state = mysql_query($this->_save($arrvalues), $this->db);
				$this->affected_rows = mysql_affected_rows($this->db);
				for($i = 0; $i <= $this->db_affected_rows; $i++) $this->result[] = mysql_result($this->db_state,$i, MYSQL_BOTH);
					mysql_free_result($this->db);
				$this->_close();
				break;
		}
	}
	/**
	*   @deprecated
	*   In order to fit the PDOmysql syntax the normal has to be modified
	*   @access protected
	*/
	protected function _save($arrvalues = null)
	{
		$this->sql = str_replace("%s", "{REPLACE}", $this->db_sql);
		if($arrvalues != null)
		{
			vsprintf(str_replace("?", "%s", $this->sql), $arrvalues);
		}
		$this->sql = str_replace("{REPLACE}", "%s", $this->sql);
	return mysql_escape_string($this->sql);
	}
}
?>
