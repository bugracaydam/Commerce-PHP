<?php
ob_start();
session_start();

include 'baglan.php';
include '../production/fonksiyon.php'; 


$say="0";
$argosors=$db->prepare(select * from argo ORDER BY argo_id Desc);
$argosors->execute();
  // verileri listeleyebiliriz
  while($cek=argosors->fetch(PDO::FETCH_ASSOC)) 
   {
   	 $ad=$cek["argo_yasak"];
   	if (stristr("lan it naber lan", $ad)) {
			
			$say=$say+1;
			echo"merhaba";
		}
	}
}