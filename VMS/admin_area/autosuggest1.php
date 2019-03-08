<?php
$connect = mysqli_connect("localhost", "id6577969_vms", "123456789", "id6577969_vms");
$output = '';
$query = '';
//$query3 = '';
//$result = '';


if(isset($_POST["query"]))
{
	$search = mysqli_real_escape_string($connect, $_POST["query"]);
    /* $query3 = "
	SELECT * FROM products
    WHERE product_cat= 3 ;
    ";*/
    
	$query = "
	SELECT product_cat,product_title
	FROM products
    WHERE product_cat = 3 AND product_title LIKE '%".$search."%' 
	";
//echo $query;

$result = mysqli_query($connect, $query);


$num = mysqli_num_rows($result);

}



if(isset($result) && mysqli_num_rows($result) > 0)
{
 
 ?>
 
    <ul id="country-list">
<?php
while($row = mysqli_fetch_array($result))
	{
?>
<li onClick="selectCountry('<?php echo $row["product_title"]; ?>');"><?php echo $row["product_title"]; ?></li>
<?php } ?>
</ul>
<?php
}

?>