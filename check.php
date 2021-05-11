<?php
	require_once("includes/classes/DBConn.php");

	$q = $_REQUEST["q"];

	$hint = "";

	if($q !== "")
	{
		$conn = new DBConn();

		$conn = $conn->connect();
		
		$stmt = $conn->prepare("SELECT Email FROM Users;");
		$stmt->execute();
		
		while($rows = $stmt->fetch())
		{
			if($q == $rows['Email'])
			{
				$hint = "Email In Use";
			}
		}
	}
	
	echo $hint;
?>

<script>
document.onkeydown = function(e) {
        if (e.ctrlKey &&
            (e.keyCode === 67 ||
             e.keyCode === 86 ||
             e.keyCode === 85 ||
             e.keyCode === 117)) {
            alert('not allowed');
            return false;
        } else {
            return true;
        }
};
</script>