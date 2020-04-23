<html>
<?php
require_once '../functions/datalayer/database.class.php';

$database = new Database();
$db = $database->getConnection();

$statement = $db->prepare('SELECT * FROM QuestionAnswer');
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
$post_data = json_encode(array('item' => $result));

echo $post_data;

?>
</html>