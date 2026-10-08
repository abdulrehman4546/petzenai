<?php
$host = 'sdb-65.hosting.stackcp.net';
$user = 'petzenai-353033308850';
$pass = '*h0s=U8<a1vD';
$name = 'petzenai-353033308850';

$conn = @mysqli_connect($host, $user, $pass, $name);

if ($conn) {
    echo "<h2 style='color:green'>✅ DB Connected!</h2>";
    echo "<p>Host: $host</p>";
    echo "<p>DB: $name</p>";
    mysqli_close($conn);
} else {
    echo "<h2 style='color:red'>❌ DB Error: " . mysqli_connect_error() . "</h2>";
    echo "<p>Error Code: " . mysqli_connect_errno() . "</p>";
    echo "<p>Host: $host</p>";
    echo "<p>User: $user</p>";
    echo "<p>DB: $name</p>";
}
