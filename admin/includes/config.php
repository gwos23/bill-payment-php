<?php 
// DB credentials.
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','bill');
// Establish database connection.
try
{
$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
}
catch (PDOException $e)
{
exit("Error: " . $e->getMessage());
}
class Database{
    private $hostname = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "armentum";

    function connect(){
        $dbh = mysqli_connect($this->hostname, $this->username, $this->password, $this->dbname);
        return $dbh;
    }

    function read($query){
        $dbh = $this->connect();
        $result = mysqli_query($dbh,$query);

        if (!$result) {
            return false;
        }else{
            $data = false;
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
            return $data;
        }
    }
    function save($query){
        $dbh = $this->connect();
        $result = mysqli_query($dbh,$query);

        if (!$result) {
            return false;
        }else{
            return true;
        }
    }
}
$DB = new Database();
?>
