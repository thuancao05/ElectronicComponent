<?php
include_once('../dbconnection.php');
$key = $_POST['idHuyen'];
$sql = "SELECT * FROM devvn_xaphuongthitran WHERE maqh = '$key'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

?>
        <option value="<?php echo $row['xaid'] ?>"><?php echo $row['name'] ?></option>

<?php
    }
}
?>
