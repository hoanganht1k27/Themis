<?php
session_start();
if(!isset($_SESSION["username"])){
    echo "<h1>Ranking hiện không khả dụng</h1>";
    exit();
}
$a = glob("Nopbai/Logs/*");
$d = 0;
$d2 = 0;
global $T;
$T = array();
foreach ($a as $i => $dir) {
	$file_name = pathinfo(basename($dir),PATHINFO_FILENAME);
	$exten = pathinfo(basename($file_name),PATHINFO_EXTENSION);
	$b = explode(']', $file_name);
	$user = trim($b[0],'[');
	$tenbai = trim($b[1],'[');
    $tenbai = strtoupper($tenbai);
	if(!isset($mark[$tenbai])){
		$list[++$d] = strtoupper($tenbai);
	}
	if(!isset($mark2[$user])){
		$list2[++$d2] = $user;
	}
	$mark[$tenbai] = 1;
	$mark2[$user] = 1;
	$fi = fopen($dir, "r");
	$data = fgets($fi);
	fclose($fi);
	preg_match ('#: (.+?)\n#s',$data,$res);
	if($res[1] == 'Chưa chấm') $res[1] = '0.00';
	$point[$user][strtoupper($tenbai)] = $res[1];
	$ext[$user][strtoupper($tenbai)] = $exten;
    $T[$user][$tenbai] = 0;
    $Tdung[$user][$tenbai] = 0;
    build_test($dir, $user, $tenbai);
}
function build_test($dir, $user, $tenbai)
{
    $fi = fopen($dir, "r");
    for($i = 1; $i <= 4; $i++)
        fgets($fi);
    $test = 0;
    $testdung = 0;
    while(!feof($fi))
    {
        $data = fgets($fi);
        preg_match("#: (.+?)#", $data, $res);
        if(isset($res[1]))
        {
            if(preg_match('/"/', $res[1])) continue;
            $test++;
            if(doubleval($res[1]) > 0) $testdung++;
        }
    }
    $GLOBALS['T'][$user][$tenbai] = $test;
    $GLOBALS['Tdung'][$user][$tenbai] = $testdung;
}
$kichthuoc = sizeof($list)*150 + 400;
echo '<?php if(!isset($_SESSION["username"])) header("Location:login.php");?><table><tr><th style="text-align: center;">ID</th><th style="text-align: center;">CONTESTANT</th><th style="text-align: center;">SUM</ht>';
foreach ($list as $i => $val) {
	echo "
      <th style='text-align: center;'>{$val}</th>
	";
}
echo "</tr>";
foreach ($list2 as $i => $val) {
    $s = glob("Nopbai/".$val.'/$History/*');
    foreach ($s as $j => $dir) {
        $fname = pathinfo($dir,PATHINFO_FILENAME);
        $c = explode(']',$fname);
        $fname = trim($c[1],'[');
        $fname = strtoupper($fname);
        if(!isset($dem[$val][$fname])) $dem[$val][$fname] = 1;
        else $dem[$val][$fname]++;
    }
}
foreach ($list2 as $i => $val) {
    $sum[$val] = 0;
    foreach ($list as $j => $ten) {
    	if(isset($point[$val][$ten]))
    	{
           $test = $T[$val][$ten];
           $testdung = $Tdung[$val][$ten];
           $tru = 0.1;
           if($testdung != 0)
           {
           $toida = doubleval($point[$val][$ten])/$testdung*$test;
           $tru = $toida / 100;
           }
           $solannop = 0;
           if(isset($dem[$val][$ten])) $solannop = $dem[$val][$ten];
           $point[$val][$ten] = doubleval($point[$val][$ten]);
           $point[$val][$ten] -= $solannop * $tru;
           $sum[$val] += $point[$val][$ten];
           $sum[$val] = number_format($sum[$val], 2);
           $point[$val][$ten] = number_format($point[$val][$ten], 2);
        }
    }
}
arsort($sum);
$kk = 0;
foreach ($sum as $key => $value) {
	$kk++;
	$list2[$kk] = $key;
}
$id = 0;
foreach ($list2 as $i => $val) {
	$id++;
	echo "<tr><td style='text-align: center; padding: 10px;'>{$id}</td>";
	// $servername = "localhost";
	// $username = "pma";
	// $password = "hoanganht1k271112002";
	// $dbname = "themis";
	// $conn = mysqli_connect($servername,$username,$password,$dbname);
    require('ketnoi.php');
	if(!$conn){
		die("Connect failed");
	}
	else{
		$sql = "SELECT * FROM `all-user` WHERE `username` = '{$val}'";
		$res = mysqli_query($conn,$sql);
		if(mysqli_affected_rows($conn) >= 1)
		{
			$row = mysqli_fetch_array($res);
		}
		mysqli_close($conn);
	}
    echo "<td style='overflow: hidden; width: 300px;'><div style='width: 40px; height: 40px;float: left;margin-right: 20px;'><img src='{$row['ava-dir']}' style='width: 100%; height: 100%;'></div><p style='width: 200px; float: left; margin: 0; height: 42px; box-sizing: border-box; padding: 10px;'>{$val}</p></td>";    
    echo "<td class='td td-sum'>{$sum[$val]}</td>";
    foreach ($list as $j => $ten) {
    	if(!isset($point[$val][$ten]))
    	{
    		echo "<td class='td'></td>";
    	}
    	else{
            $dir = "Nopbai/Logs/[".$val."][".$ten."].".$ext[$val][$ten].".log";
            $test = $T[$val][$ten];
            $testdung = $Tdung[$val][$ten];
    		$dir = str_replace(' ','%20', $dir);
    		$th1 = "background-color: #cbe000;";
    		$th2 = "background-color: #ad1111;";
    		$th3 = "background-color: #239a23;";
    		$th4 = "background-color: #70af28;";
    		if(strcmp($point[$val][$ten], 'Chưa chấm') == 1) {$point[$val][$ten] = '0.00';}
    		if($testdung == 0) $th = $th2;
    		else{
    			if($testdung < $test/2) $th = $th1;
    			else if($testdung < $test) $th = $th4;
    			else $th = $th3;
    		}
            if(isset($dem[$val][$ten]))
    		{echo "<td class='td'><a href='{$dir}' target='_blank' onclick = wload('{$dir}') style='{$th}'>{$point[$val][$ten]}<span class='so-lan-nop'><b>".$dem[$val][$ten]."</b></span></a></td>";
            }
            else
            echo "<td class='td'><a href='{$dir}' target='_blank' onclick = wload('{$dir}') style='{$th}'>{$point[$val][$ten]}</a></td>";        

    	}
    }
    echo "</tr>";
}
echo "</table>";
?>