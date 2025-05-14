<?php
// Author: Momin Imran
// Description: AJAX for live product search suggestions.

$mysqli = mysqli_connect("studentdb-maria.gl.umbc.edu", "eubini1", "eubini1", "eubini1");
$q = $_GET['query'] ?? '';
if ($q) {
    $safeString = mysqli_real_escape_string($mysqli, $q);
    $result = mysqli_query($mysqli, "SELECT name FROM Products WHERE name LIKE '%$safeString%' LIMIT 5");
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div>" . htmlspecialchars($row['name']) . "</div>";
    }
}
?>
