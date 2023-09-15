<?php
include('includes/config.php');
class Bill{
    function get_bill($id)
    {
        $DB = new Database();
        $query = "SELECT * FROM tenants WHERE tenant_id = 'tenant_id' limit 1";
        return $DB->read($query);
    }
}
?>