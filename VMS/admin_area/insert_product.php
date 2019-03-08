<!DOCTYPE>
<style>

.frmSearch {border: 1px solid #a8d4b1;background-color: #c6f7d0;margin: 2px 0px;padding:40px;border-radius:4px;}
#country-list{float:left;list-style:none;margin-top:-3px;padding:0;width:190px;position: absolute;}
#country-list li{padding: 10px; background: #f0f0f0; border-bottom: #bbb9b9 1px solid;}
#country-list li:hover{background:#ece3d2;cursor: pointer;}
#search-box{padding: 10px;border: #a8d4b1 1px solid;border-radius:4px;}
</style>
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script>
$(document).ready(function(){
	$("#search-box").keyup(function(){
		$.ajax({
		type: "POST",
		url: "autosuggest1.php",
		data:'query='+$(this).val(),
		beforeSend: function(){
			$("#search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			$("#suggesstion-box").show();
			$("#suggesstion-box").html(data);
			$("#search-box").css("background","#FFF");
		}
		});
	});
});

function selectCountry(val) {
$("#search-box").val(val);
$("#suggesstion-box").hide();
}
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

<script>

$(document).ready(function(){
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showLocation);
    } else { 
        $('#location').html('Geolocation is not supported by this browser.');
    }
});

function showLocation(position) {
	
    var latitude = position.coords.latitude;
	var longitude = position.coords.longitude;
    

	$.ajax({
		type:'POST',
		url:'getLocation.php',
		data:'latitude='+latitude+'&longitude='+longitude,
		success:function(msg){
            if(msg){
               $("#location").val(msg);
            }else{
                $("#location").html('Not Available');
            }
		}
	});

}
</script>


<?php 

include("includes/db.php");

?>
<html>
	<head>
		<title>Inserting Product</title> 
		
<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
<script>
        tinymce.init({selector:'textarea'});
</script>
	</head>
	
<body bgcolor="skyblue">


	<form action="insert_product.php" method="post" enctype="multipart/form-data"> 
	<!--	<input type="text" name="location-val" id="location" > -->
		<table align="center" width="795" border="2" bgcolor="#187eae">
			
			<tr align="center">
				<td colspan="7"><h2>Insert New Product Here</h2></td>
			</tr>
			
			<tr>
				<td align="right"><b>Product Category:</b></td>
				<td>
				<select name="product_cat" >
					<option>Select a Category</option>
					<?php 
		$get_cats = "select * from categories";
	
		$run_cats = mysqli_query($con, $get_cats);
	
		while ($row_cats=mysqli_fetch_array($run_cats)){
	
		$cat_id = $row_cats['cat_id']; 
		$cat_title = $row_cats['cat_title'];
	
		echo "<option value='$cat_id'>$cat_title</option>";
	
	
	}
					
					?>
				</select>
				
				
				</td>
			</tr>
			<tr>
				<td align="right"><b>Product Title:</b></td>
				<td><input type="text" name="product_title" size="60" id="search-box" required/><div id="suggesstion-box"></div></td>
			</tr>
			
			
			
		<!--	<tr>
				<td align="right"><b>Product Brand:</b></td>
				<td>
				<select name="product_brand" >
					<option>Select a Brand</option>
					<?php 
		$get_brands = "select * from brands";
	
	$run_brands = mysqli_query($con, $get_brands);
	
	while ($row_brands=mysqli_fetch_array($run_brands)){
	
		$brand_id = $row_brands['brand_id']; 
		$brand_title = $row_brands['brand_title'];
	
	echo "<option value='$brand_id'>$brand_title</option>";
	
	
	}
					
					?>
				</select>
				
				
				</td>
			</tr> -->
			
		<!--	<tr>
				<td align="right"><b>Product Image:</b></td>
				<td><input type="file" name="product_image" /></td>
			</tr> -->
			
			<tr>
				<td align="right"><b>Product Price:</b></td>
				<td><input type="text" name="product_price" required/></td>
			</tr>
		
			<tr>
				<td align="right"><b>Stock:</b></td>
				<td><input type="text" name="product_desc" required/></td>
			</tr>
			
				<tr>
				<td align="right"><b>Current Location:</b></td>
				<td><input type="text" readonly name="location"  id='location' required/></td>
			    </tr>
			    
				<tr>
				<td align="right"><b>Store Location:</b></td>
				<td><input type="text"  name="store_location" required/></td>
			    </tr>
			    
			
		<!--	<tr>
				<td align="right"><b>Product Keywords:</b></td>
				<td><input type="text" name="product_keywords" size="50" required/></td>
			</tr> -->
			
			<tr align="center">
				<td colspan="7"><input type="submit" name="insert_post" value="Insert Product Now"/></td>
			</tr>
		
		</table>
	
	
	</form>


</body> 
</html>
<?php 

	if(isset($_POST['insert_post'])){
	
		//getting the text data from the fields
		$actualLocation = $_POST['location'];
		$product_title = $_POST['product_title'];
		$product_cat= $_POST['product_cat'];
	//	$product_brand = $_POST['product_brand'];
		$product_price = $_POST['product_price'];
		$product_desc = $_POST['product_desc'];
	//	$product_keywords = $_POST['product_keywords'];
	
		//getting the image from the field
	//	$product_image = $_FILES['product_image']['name'];
	//	$product_image_tmp = $_FILES['product_image']['tmp_name'];
		
	//	move_uploaded_file($product_image_tmp,"product_images/$product_image");
	
		 $insert_product = "insert into products (product_cat,product_title,product_price,product_desc,location) values ('$product_cat','$product_title','$product_price','$product_desc','$actualLocation')";
		 
		 $insert_pro = mysqli_query($con, $insert_product);
		 
		 if($insert_pro){
		 
		 echo "<script>alert('Product Has been inserted!')</script>";
		 echo "<script>window.open('index.php?insert_product','_self')</script>";
		 
		 }
	}








?>



