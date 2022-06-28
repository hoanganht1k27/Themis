<?php
session_start();
if($_SERVER['REQUEST_METHOD']=='POST')
{
	$target_file = basename($_FILES['file']['name']);
	$name = pathinfo($target_file,PATHINFO_FILENAME);
	$target_file = str_replace('.', '].', $target_file);
	$file_name = "[{$_SESSION['username']}][".$target_file;
	$target_dir = "Nopbai/";
	$dele_dir = "Logs/";
	$target_file = $target_dir.$file_name;
	$dele_file = $target_dir.$dele_dir.$file_name.'.log';
	$ngonngubailam = strtoupper(pathinfo($file_name,PATHINFO_EXTENSION));
	if($ngonngubailam != "PAS" && $ngonngubailam != "PP" && $ngonngubailam != "CPP"
&& $ngonngubailam != "JAVA" && $ngonngubailam != "C") {
    echo '<script type="text/javascript">
    	alert("Hệ thống chỉ cho phép nộp các file *.pas, *.pp, *.cpp, *.java, *.c");
    	window.location = "index.php?submit=failed";
    </script>';
    exit();
}   
    $fname = strtoupper(pathinfo(basename($_FILES['file']['name']),PATHINFO_FILENAME));
    if(file_exists($dele_file))
	{
		$dem[$fname] = 1;
	}
    $s = glob("Nopbai/".$_SESSION['username'].'/$History/*');
    foreach ($s as $i => $dir) {
       $fname = pathinfo($dir,PATHINFO_FILENAME);
       $c = explode(']', $fname);
       $fname = trim($c[1],'[');
       $fname = strtoupper($fname);
       if(!isset($dem[$fname])) $dem[$fname] = 2;
       else $dem[$fname]++;
    }
    $fname = strtoupper(pathinfo(basename($_FILES['file']['name']),PATHINFO_FILENAME));
    //echo $fname;
    //die();
    if(isset($dem[$fname])&&$dem[$fname] >= $_SESSION['limit']){
    	header("Location:index.php?limit=true");
    	exit();
    }
    if(file_exists($dele_file))
    {
    	unlink($dele_file);
    }
    //die();
	move_uploaded_file($_FILES['file']['tmp_name'], $target_file);
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Upload</title>
</head>
<body>
	<?php
    echo '<script type="text/javascript">
    	alert("Nop bai thanh cong");
    	window.location = "index.php";
    </script>';
    ?>
</body>
</html>