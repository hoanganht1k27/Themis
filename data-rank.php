<?php
session_start();
$a = glob("Nopbai/Logs/*");
foreach ($a as $i => $dir) {
    $filename = pathinfo(basename($dir),PATHINFO_FILENAME);
    $filename = pathinfo($filename,PATHINFO_FILENAME);
	$b = explode(']', $filename);
	$user = trim($b[0], '[');
	$tenbai = trim($b[1],'[');
	if($user == $_SESSION['username'])
	{
		$fi = fopen($dir, "r");
		$test = 0;
		$testdung = 0;
		$data = fgets($fi);
		preg_match ('#:\s(.+?)\n#s',$data,$res);
		//preg_match('/(.+?)\s(.+?)\n/', $data, $res);
		$point = $res[1];
		for($i = 1; $i <= 3;$i++)
    			fgets($fi);
    	while(!feof($fi))
		{
			$data = fgets($fi);
			preg_match ('#: (.+?)\n#s',$data,$res);
			$test++;
            //die(doubleval($res[1]));
            if(isset($res[1]))
            {
            if(doubleval($res[1]) == 0) $notac = 1;
            else $testdung++;
            } 
            fgets($fi);
            fgets($fi);
		}
		fclose($fi);
		$test--;
		$th1 = "background-color: #cbe000;";
		$th2 = "background-color: #ad1111;";
		$th3 = "background-color: #239a23;";
		$th4 = "background-color: #70af28;";
		$dir = str_replace(' ', '%20', $dir);
		//$test = $testdung+1;
		if($testdung == 0) $th = $th2;
		else{
			if($testdung < $test/2) $th = $th1;
			else if($testdung < $test) $th = $th4;
			else $th = $th3;
		}
		$s = glob('Nopbai/'.$_SESSION['username'].'/$History/*');
		if(!isset($dem[$tenbai])) $dem[$tenbai] = 0;
		foreach ($s as $i => $dir2) {
			$fname = pathinfo(basename($dir2),PATHINFO_FILENAME);
			$nop = explode(']', $fname);
			$stenbai = trim($nop[1],'[');
			if($stenbai == $tenbai)
		    $dem[$stenbai] ++; 
		}
		if($dem[$tenbai] > 0)
		echo "
		<li>
			<a href='{$dir}' target='_blank' onclick = wload('{$dir}')>{$tenbai}</a>
			<div class='diem-container'>
			    <span class='so-lan-nop'>".$dem[$tenbai]."</span>
                <span style='{$th}' class='diem'>{$point}
                </span>
              </div>
		</li>";
		else
		echo "
		<li>
			<a href='{$dir}' target='_blank' onclick = wload('{$dir}')>{$tenbai}</a>
			<div class='diem-container'>
                <span style='{$th}' class='diem'>{$point}
                </span>
              </div>
		</li>";
	}
}
?>