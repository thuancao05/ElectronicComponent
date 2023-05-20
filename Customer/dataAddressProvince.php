<?php
include_once('../dbconnection.php');
$key = $_POST['id'];
$sql = "SELECT * FROM devvn_quanhuyen WHERE matp = '$key'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

?>
        <option value="<?php echo $row['maqh'] ?>"><?php echo $row['name'] ?></option>

<?php
    }
}
?>
