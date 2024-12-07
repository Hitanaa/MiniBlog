<?php

class Database
{

    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $database = "miniblog";
    private $conn = false;
    private $mysqli = "";
    private $result = array();

    // Cconnexion à la base de données
    public function __construct()
    {
        if (!$this->conn) {
            $this->mysqli = new mysqli($this->host, $this->user, $this->password, $this->database);
            $this->conn = true;

            if ($this->mysqli->connect_error) {
                array_push($this->result, $this->mysqli->connect_error);
            }
        } else {
        }
    }

    // Fonction pour l'insertion
    public function insert($table, $param = array())
    {
        if ($this->tableExists($table)) {
            $table_columns = implode('`,`', array_keys($param));
            $table_values = implode("', '", $param);

            $sql = "INSERT INTO `$table` (`$table_columns`) VALUES ('$table_values')";

            if ($this->mysqli->query($sql)) {

                return true;
            } else {

                return false;
            }
        }
        return false;
    }

    // Function pour la mise à jour
    public function update($table, $param = array(), $where = null)
    {
        if ($this->tableExists($table)) {
            $arg = array();
            foreach ($param as $key => $value) {
                $arg[] = "$key = '$value'";
            }

            $sql = "UPDATE $table SET " . implode(', ', $arg);
            if ($where != null) {
                $sql .= " WHERE $where";
            }
            if ($this->mysqli->query($sql)) {

                return true;
            } else {

                return false;
            }
        }
        return false;
    }

    // Fonction pour la supprimer
    public function delete($table, $where = null)
    {
        if ($this->tableExists($table)) {
            $sql = "DELETE FROM $table";
            if ($where != null) {
                $sql .= " WHERE $where";
            }
            if ($this->mysqli->query($sql)) {
                array_push($this->result, $this->mysqli->affected_rows);
                return true;
            } else {
                array_push($this->result, $this->mysqli->error);
                return false;
            }
        }
        return false;
    }

    public function select($table, $rows = "*", $condition = null, $join = null, $where = null, $order = null, $limit = null)
    {
        if ($this->tableExists($table)) {
            $sql = "SELECT $rows FROM $table";
            if ($join != null) {
                $sql .= " $join";
            }
            if ($condition != null) {
                $sql .= " WHERE $condition";
            }
            if ($where != null) {
                $sql .= " WHERE $where";
            }
            if ($order != null) {
                $sql .= " ORDER BY $order";
            }
            if ($limit != null) {
                $sql .= " LIMIT 0, $limit";
            }
            if ($this->sql($sql)) {
                return $this->result;
            } else {
                array_push($this->result, $this->mysqli->error);
                return false;
            }
        }
        return false;
    }

    public function sql($sql)
    {
        $query = $this->mysqli->query($sql);
        if ($query) {
            $this->result = $query->fetch_all(MYSQLI_ASSOC);
            return true;
        } else {
            array_push($this->result, $this->mysqli->error);
            return false;
        }
    }

    private function tableExists($table)
    {
        $sql = "SHOW TABLES LIKE '$table'";
        $run = $this->mysqli->query($sql);
        if ($run->num_rows > 0) {
            return true;
        } else {
            array_push($this->result, $table . ' table not found');
            return false;
        }
    }

    public function getError()
    {
        $val = $this->result;
        $this->result = array();
        return $val;
    }

    public function getstr($str)
    {
        if ($str != "") {
            return mysqli_real_escape_string($this->mysqli, $str);
        }
    }

    public function __destruct()
    {
        if ($this->conn) {
            $this->mysqli->close();
            $this->conn = false;
        } else {
        }
    }
}

?>