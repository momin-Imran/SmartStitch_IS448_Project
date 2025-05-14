<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  // you can omit http_response_code(401) if you don’t care about error codes;
  // Prototype’s onFailure only fires on HTTP ≠ 2xx, so if you always 200, handle empty data instead.
  http_response_code(401);
  echo json_encode(['error'=>'Not logged in']);
  exit;
}
$user_id = (int)$_SESSION['user_id'];
$db = mysqli_connect('studentdb-maria.gl.umbc.edu','eubini1','eubini1','eubini1');

$sql = "
  SELECT u.email,
        SizePrefs.chest, SizePrefs.waist, SizePrefs.hips, SizePrefs.rise, SizePrefs.shoulder, SizePrefs.neck, SizePrefs.arm, SizePrefs.inseam
    FROM Users u
    LEFT JOIN Customer c   ON c.user_id       = u.user_id
    LEFT JOIN SizePrefs sp ON sp.customer_id  = c.customer_id
   WHERE u.user_id = {$user_id}
   LIMIT 1
   ";

$result  = mysqli_query($db, $sql);

$data = mysqli_fetch_assoc($result) ?: [];

echo json_encode($data);


?>
