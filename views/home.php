<?php

use App\Config\Database;

include('/xampp/htdocs/AutoSys/layouts/main.layout.php');
ob_start();
?>
<h1>HOME!</h1>
<a href="/clientes">Lista de clientes</a>
<a href="/produtos">Lista de produtos</a>
<?php
$content = ob_get_clean();
$conn = new Database();
$conn->getConnection();
$query = "SELECT * FROM " . 'clientes';
$result = $this->conn->query($query);
return $result;
?>