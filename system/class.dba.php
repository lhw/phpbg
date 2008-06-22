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
	private $db;
	private $data;
	private $state;
	private $sql;
	private $affected_rows;
	public $result;

	/**
	*   Loads the properties and assigns them to a private variable
	*   @access public
	*/
	public function __construct()
	{
		include("config/properties.php");
		$this->data = $database;
	}
	/**
	*   Connects to the database via the defined database layer
	*   @access private
	*/
	private function connect()
	{
		$this->db = new PDO("mysql:host=".$this->data['host'].";
							port=".$this->data['port'].";
							dbname=".$this->data['data'],
							$this->data['user'],
							$this->data['pass']);
	}
	/**
	*   Closes the database connection of the database layer
	*   @access private
	*/
	private function close()
	{
		$this->db = null;
	}
	/**
	*   Executes the query given in $this->sql. Each "?" must have a replacement in $arrvalues
	*   @param array $arrvalues The values ordered for the replacements
	*   @access public
	*/
	public function query($arrvalues = null)
	{
		$this->sql = str_replace("§PREFIX§", $this->data['sufx'], $this->sql);
		try
		{
			$this->connect();
			$this->state = $this->db->prepare($this->sql);
			($arrvalues != null) ? $this->state->execute($arrvalues) : $this->state->execute();
			$this->affected_rows = $this->state->rowCount();
			$this->result = $this->state->fetchAll();
			$this->close();
		}
		catch(PDOException $e)
		{
			die("The database connection was not successful");
		}
	}
	/**
	*	Counts the rows affected by the query
	*	@return	int	The affected rows
	*	@access	public
	*/
	public function getrowcount() {
		if($this->affected_rows > 0) {
			return (int)$this->affected_rows;
		}
	}
	/**
	*	Sets the SQL-Querystring
	*	@access	public
	*/
	public function setsql($sql) {
		if(is_string($sql) && $sql != null) {
			$this->sql = $sql;
		}
	}
}
?>
