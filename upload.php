<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<?php
// header('content-type:text/plain');

	/* Upload the file*/
	/* Create new directory*/
	if(!file_exists("upload")){
	mkdir("upload");
		}

	if($_FILES["file"]["error"] > 0){
	$er = "ERROR Return Code: ".$_FILES["file"]["error"]."<br/>";
	} else {
	
	//echo "upload: ".$_FILES["file"]["name"]."<br/>";

				$data = $_FILES["file"]["name"];
				move_uploaded_file($_FILES["file"]["tmp_name"],"upload/".$_FILES["file"]["name"]);
				$filedata = fopen("upload/".$_FILES["file"]["name"],"r");
				
			while(($line = fgetcsv($filedata)) !==FALSE){
				$csv[] = $line;
				}
			
			$arrlength = count($csv);
			//echo $arrlength;

		$url= array(); //initial new variable
		?>


		<h3>FIND IP FROM URL</h3>
			<table border="5" cellspacing="3" cellpadding="3"> 
				<th>no.</th>
				<th>url</th>
				<th>ip</th>

		<?php
				for($i=1;$i<$arrlength;$i++){
					// echo $csv[$i][2]."\n"; 
					/*2d array [$i] is each row in the file and [2] mean column no2(c)
					  change this element if your url is not in this column.
					*/

		?>
				<tr>
				<td> <?php echo "$i"; ?> </td>
				
				<td>
		<?php
				$url = $csv[$i][2];
				echo "$url";
		?>
				</td>

				<td>
		<?php
				$ip = gethostbyname($url);
				echo(" $ip " ."\n");
		?>
				</td>
				</tr>
		<?php
				} 
		?>
			</table>

		<?php

			fclose($filedata);
		
		} //close else


?>


</body>
</html>
