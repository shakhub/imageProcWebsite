<?php
	$host="localhost";
	$dbuser="root";
	$pass="";
	$dbname="mysite";
	$conn=mysqli_connect($host,$dbuser,$pass,$dbname);
	if(mysqli_connect_errno())
	{
		die("Connection Failed!" . mysqli_connect_error());
	}
?>
<?php
	$target_dir = "uploads/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	//check if image file is actual image or fake
?>
<html>
	<head>
		<title>Singup Page</title>
	</head>
	<body>
		<?php
			if(isset($_POST['submit']))
			{
				$first=$_POST['first_name'];
				$last=$_POST['last_name'];
				$email=$_POST['email'];
				$gender=$_POST['gender'];
				$name=$first.' '.$last;
				$checkImage = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
				if($checkImage != false)
				{
					//echo "File is an image - " . $checkImage["mime"] . ".";
					$uploadOk = 1;
				}
				else
				{
					echo "File is not an image.";
					$uploadOk = 0;
				}
				//check file size
				if($_FILES["fileToUpload"]["size"]>500000)
				{
					echo "Sorry, your file is too large.";
					$uploadOk=0;
				}
				//allow only jpg images
				if($imageFileType != "jpg" && $imageFileType != "jpeg")
				{
					echo "Only jpg image files are allowed.<br /> ";
					echo " File type is" . $imageFileType;
					$uploadOk=0;
				}
				//check status of uploadOk
				if($uploadOk==0)
				{
					echo "Error in uploading file, please try again.";			
				}
				else
				{
					if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$target_file))
					{
						echo "The file ". basename($_FILES["fileToUpload"]["name"]). " has been uploaded";
					}
					else
					{
						echo "Error while uploading the file!";
					}
				}
				if(empty($first)||empty($last)||empty($email)||empty($gender))
				{
					echo "Oops! Can't leave any field empty!";
				}
				else
				{
					$imageFileName = basename($_FILES["fileToUpload"]["name"]);
					$sql = "insert into user(first,last,email,gender,imagePath,fileName) ".
					" values('$first','$last','$email','$gender','$target_file','$imageFileName')";
					$res=mysqli_query($conn,$sql);
					if(!$res || !$uploadOk)
					{
						die("Query Failed!".mysqli_error($conn));
					}
					else
					{
						echo "<br/>Data inserted successfully"; 
					}
				}					
			}
			else
			{
				echo "Form not submitted properly!";
			}
		?>
	</body>
</html>