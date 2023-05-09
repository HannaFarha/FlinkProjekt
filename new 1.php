<html>
<!-- Neuestes kompiliertes und minifiziertes CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optionales Thema -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Neuestes kompiliertes und minimiertes JavaScript-->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


<?php
//Datenbank Verbindung
$uh=null;
$db_server = "localhost";
$db_port = "bike";
$db_username = "root";
$db_password = "";
$db_database = "Bike";
$options = array(
	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
	PDO::ATTR_PERSISTENT => false,
	PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
	);	
try{//Instanz von PDO (Datenbankverbindung aufbauen)
	$db = new PDO("mysql:host=".$db_server.";port=".$db_port.";dbname=".$db_database, $db_username, $db_password, $options);
	
}catch(PDOException $err){
	echo "Fehler aufgetreten: ".$err->getMessage();
}
//$db->query("SET NAMES utf8");

//gegebene Information auslesen,um in Datenbank zu speichern 

if(isset($_POST['speichern'])){ 
		 if (empty($_POST['bikenumber'])) {
			 $errors['bikenumber'] = 'Number is required.'; $uh= "Number is required" ;
				}else{
					$time=trim($_POST["time"]);
				$timestamp = time();
				$datum = date("d.m.Y -- H:i", $timestamp );
				$datum2 = date("H", $timestamp );
			
		
				$Ridername= trim($_POST["Ridername"]);
				$bikenumber=trim($_POST["bikenumber"]);
				$Time=trim($_POST["time"]);
				
				$new_time = date("Y.m.d -- H:i", strtotime("+{$time} hours"));
		
				
				
				$comment=trim($_POST["comment"]);
				
					 
					
				//neue Daten einfügen 
				$query = $db->prepare("INSERT INTO `Bike`(`Rider`,`Number`, `Time`,`until`,`Comment`) VALUES ('$Ridername','$bikenumber','$datum','$new_time','$comment')");
					$query->execute();
				}
	}
	
	
	//Änderung Funktion geänderten Informationen Speichern (Update)
	if(isset($_POST['Änderung_speichern'])){
		//beim Leeren Input in product_number kann nicht neue Produkt in Datenbank gespeichert werden  
		 if (empty($_POST['bikenumber2'])) {
			 $errors['bikenumber2'] = 'Number is required.';
				}else{
					$id=($_POST["id"]);
				$Ridername2= trim($_POST["Ridername2"]);
				$bikenumber2=trim($_POST["bikenumber2"]);
				$time2 = trim($_POST["time2"]);
				$comment2 = trim($_POST["comment2"]);
				
					
				
				
				
				//ausgesuchte Daten Ändern 		
					$query = $db->prepare("UPDATE `Bike` SET `Ridername`='$Ridername2',`bikenumber`='$bikenumber2',`time`='$time2',`comment`='$comment'  WHERE id=$id ;");
					$query->execute();
	}
	}
	//Lösche Button 
	if(isset($_POST['Löschen'])){
	 DeleteP($db,$_POST['Löschen']);
	}
	?>
	
 <head>

	<!--<style>
.dropbtn {
  background-color: #3498DB;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

.dropbtn:hover, .dropbtn:focus {
  background-color: #2980B9;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  overflow: auto;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown a:hover {background-color: #ddd;}

.show {display: block;}
</style>-->
</head>
<body>
       <title>Register a bike</title>
			</head>
			<body>

            <table border="2" width="100%" height=100% >
                <tr>
                    <td width="100%" height="0" bgcolor="#AAAAAA">
                        <p align="center"><font size="5"><b><font face="Arial, Helvetica, sans-serif">Register a bike</font></b></font></p>
                    </td>
                </tr>
                <tr></tr>
                    <td width="100%" >
					
					<table >
				 <b  style="color:black;font-size:30px; ">Insert new bike </b><button style="font-size:50px;color:red;"  align=left id="show"  onclick="myFunction()"> &#43;</button>	
					
					<br>
					<div class="col-md-4" align=center >  
  <!--Suche Button-->
  <form method="post" >
    <div  class="form-group">
      <input style="align:center" placeholder="Suche nach Produkt Nummer" name="term" type="text" class="form-control" id="usr">
    </div>
	<input  class="btn btn-success" type="submit" name="such" value="Suche" /> 
  </div><div class="col-md-3"></div></form><br><br><br><br><br>
					</table>
					
					<script>
		//funktion für einfügliste 
            function myFunction() {
              var x = document.getElementById("display");
			  var x2 = document.getElementById("display2");
			  var x3 = document.getElementById("display3");
              if (x.style.display === "none") {
					
                x.style.display = "block";
                x2.style.display = "none";
                x3.style.display = "none";
              } else {
                x.style.display = "none";
              }
            }
       
		
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content 
function myFunction2() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}*/
</script>
									
<?php
     //Button für Bearbeiten 
	

	 		 
	 
	 
	 
		if( isset($_POST['bearbeiten']) )
			{
						SelectforUpdate($db,$_POST['bearbeiten']);
			} 
 
			//lösche funktion 
		function DeleteP($db,$id)
		{
		$delete = $db->prepare("DELETE FROM `Bike` WHERE id=$id");
		$delete->execute();
		}

	  //Daten aus Datenbank holen für ändern 
		function SelectforUpdate($db,$id)
		{
			$stmt4 = $db->prepare("SELECT id,Rider,Number,Time,Comment  FROM Bike WHERE id =$id");
			$stmt4->execute();
			  $result = $stmt4->setFetchMode(PDO::FETCH_ASSOC);
			  //foreach für die geholte Daten 
			foreach($stmt4 as $row2):
		//json Daten zum array 
			 
			
			
			
				
 ?>
	 	
<!--Preisliste zeigen,um Bearbeiten durchzuführen (edit) -->
				<form method="post">
				 <table  align=center  id="display2"  style="display:block" width=28% >
						<!--Select alle Daten-->
                                <tr>
									<h2 id="display3" width="100%" align=center> <font  face="Arial, Helvetica, sans-erif">Data edit<input size="1"  name="id"  value=" <?= htmlspecialchars($row2['id']) ?>"  > </h2>
                                    <td width="100%" align=right>
										<b><font face="Arial, Helvetica, sans-erif">Bike name :</font></b>
									</td>
                                    <td width="100%" align=left>
										<font face="Arial, Helvetica, sans-erif">
											<input name="product_name2" size=40 maxlength=20 value=" <?= htmlspecialchars($row2['Rider']) ?>">
										</font>
									</td>
                                </tr>
								
								<tr>
                                    <td width="30%" align=right><b><font face="Arial, Helvetica, sans-erif">Bike Number<nobr style="color:red";>*</nobr>:</font></b></td>	<p align=right><?php  $errors['	'] = 'Number is required* '; ?></p>
                                    <td width="70%" align=left> <font face="Arial, Helvetica, ans-serif"><input name="product_number2" size=40 maxlength=20  value="<?= htmlspecialchars($row2['Number'])?>"</font></td>
                                </tr>
                                <tr>
                                    <td width="30%" align=right><b><font face="Arial, Helvetica, sans-serif">Time :</font></b></td>
                                    <td width="70%" align=left> 
									<font face="Arial, Helvetica, sans-erif">
									<input name="product_name2" size=40 maxlength=20 value=" <?= htmlspecialchars($row2['Time']) ?>">
                                      <td width="30%" align=right><b><font face="Arial, Helvetica, sans-serif">Comment :</font></b></td>
                                    <td width="70%" align=left> 
									<font face="Arial, Helvetica, sans-erif">
									<input name="product_name2" size=40 maxlength=20 value=" <?= htmlspecialchars($row2['Comment']) ?>"> 
                                    </font>
                                    </td>
                                    
                                </tr>
										
                                
                                     
                                        <tr>
                                            <td colspan=2 align=left> <font face="Arial, Helvetica, sans-serif"><button  class="btn btn-success" name="Änderung_speichern" >Änderung speichern</button>   
                                        </tr>
										

							
                     
<?php  
					//ende Foreach
				endforeach 
?>
</table>
<?php  
}
?>

						</form>





<!-- Preisliste für neue Produkt einzufügen -->
                <form method="post">
                            <table  align=center id="display"  style="display:none" width=28% >
						
      
								
                                    <td width="100%" align=right><b><font face="Arial, Helvetica, sans-erif">Rider Name:</font></b></td>
                                    <td width="100%" align=left> <font face="Arial, Helvetica, sans-erif"><input name="Ridername" size=40 maxleght=20   value="   "></font></td>
                                </tr>                              <tr>
                                    <td width="30%" align=right><b><font face="Arial, Helvetica, sans-erif">Bike Number <nobr style="color:red";>*</nobr>:</font></b></td>	<p align=right><center style="color:red" ><?php  echo "$uh"; ?></center></p>
                                    <td width="70%" align=left> <font face="Arial, Helvetica, ans-serif"><input name="bikenumber" size=40 maxleght=20  value=""</font></td>
                                </tr>
                                <tr>
								<br>
                                   
									
                                       <br>
                                        </font>
                                    </td>
                                    
                                        </tr>
										
                                        <tr>
                                            <td width="80%" align=right><b><font face="Arial, Helvetica, sans-serif"> How long is your shift</font></b></td>
                                            <td width="50%" align=left> <font face="Arial, Helvetica, sans-serif">
												<input name="time" size="5" value=" "

 />
												</font></br>
												</td>
                                        </tr>
										   <tr>
                                    <td width="30%" align=right><b><font face="Arial, Helvetica, sans-erif">Comment<nobr style="color:red";></nobr>:</font></b></td>	<p align=right></p>
                                    <td width="70%" align=left> <font face="Arial, Helvetica, ans-serif"><input name="comment" size=40 maxleght=20  value=""</font></td>
                                </tr>
										  
                                      
                                        <tr>
                                            <td  width="30%"  colspan=2 align=center> <font face="Arial, Helvetica, sans-serif"><button  class="btn btn-success" name="speichern" > <?php echo ('Speichern'); ?>   </button></td>     
                                        </tr>
										
										</form>
							
																		
				<?php 
			
				//Select die gesuchte Daten 
			if(isset($_POST['such'])){
				function getbike_listsearch($db,$term){
					$query = $db->prepare("SELECT id,Rider,Number,Time,until,Comment   FROM Bike WHERE  Number LIKE '%".$term."%'
					");
					$query->execute();
					$result6 = $query->fetchAll();
					$term=$_POST["term"];
					
					foreach($result6 as $row):
				?>
				
		 <form method="post">
		<!--gesuchte Produkt Information in Tabelle zeigen  -->								 
		<table   maxlength="20" class="table table-bordered " style = " background-color:red: 3px solid black;font-family:arial, lucida console;">
			<thead>
			<tr>
			<th class="bg-info" >Rider Name</th>
			<th class="bg-warning">Bike Number</th>
			<th class="bg-success">Time</th>
			<th class="bg-info">Comment</th>
			<th class="bg-danger">Edit</th>
		
			</tr>
			</thead>
		<tbody>
			<tr  style = "border: 3px solid black;">
		<!--<td><?= htmlspecialchars($row['id']) ?> </td>-->
			<td class="bg-info"><?= htmlspecialchars($row['Rider']) ?> </td>
			<td class="bg-warning"><?= htmlspecialchars($row['Number']) ?> </td>
			<td  class="bg-success"><?= htmlspecialchars($row['Time']) ?> </td>
			<td  class="bg-success"><?= htmlspecialchars($row['until']) ?> </td>
			<td  class="bg-info"><?= htmlspecialchars($row['Comment']) ?> </td>
			<td class="bg-danger"><button   class="btn btn-primary"  id="<?php echo htmlspecialchars($row['id']);?>" <?php $idd=htmlspecialchars($row['id']);?>  name="bearbeiten" value="<?php echo htmlspecialchars($row['id']);?>">edit</button><br><br><button   class="btn btn-danger" value="<?php echo htmlspecialchars($row['id']);?>" name="Löschen" >Delete</button> </td>									
			</tr>							
				
<?php  
		//hier ist die ende von foreach 
		endforeach
		;}//ende getprice_listsearch funktion
		$term=$_POST["term"];
		getbike_listsearch($db,$term);} //ende If Schleife 
?>
		</tbody>
	    </table>
		</form>		
		
		
		
		
		
		
		<table   maxlength="20" class="table table-bordered " style = " background-color:red: 3px solid black;font-family:arial, lucida console;">
			<thead>
			<tr>
	<!--  <th> ID </th>-->
			
			<th class="bg-success">until</th>
			
			</tr>
			</thead>		
<?php
		
						 //alle Daten aus Datenbank holen 
						$stmt5 =$db->prepare("SELECT id,until,FROM Bike ORDER BY id DESC"); 
					
					$result5 = $stmt5->fetchAll();
						foreach($result5 as $row2):
?>					
										
		<form method="post">
		<!--tabelle Daten zeigen -->								 
 
		<tbody>
		  <tr  style = "border: 3px solid black;">
		<!--<td><?= htmlspecialchars($row2['id']) ?> </td>-->
			
			
			
			
			
			
			<td class="bg-warning"> <center><h3><?= htmlspecialchars($row2['until']) ?> </h3> <input  type="checkbox"></center> </td>
			
		
			<td class="bg-danger"><button class="btn btn-primary"  id="<?php echo htmlspecialchars($row['id']);?>" <?php $idd=htmlspecialchars($row2['id']);?>  name="bearbeiten" value="<?php echo htmlspecialchars($row2['id']);?>">edit</button><br><br><button   class="btn btn-danger" value="<?php echo htmlspecialchars($row2['id']);?>" name="Löschen" >Delete</button> </td>									
			</tr>							
		
<?php  
		//hier ist die ende von foreach 
	endforeach 
?>
		
		
		
		
		
		
		

		

		<table   maxlength="20" class="table table-bordered " style = " background-color:red: 3px solid black;font-family:arial, lucida console;">
			<thead>
			<tr>
	<!--  <th> ID </th>-->
			<th class="bg-info" >Rider Name</th>
			<th class="bg-warning">Bike Nummer</th>
			<th class="bg-success">Time</th>
			<th class="bg-success">until</th>
			<th class="bg-info">Comment</th>
			<th class="bg-danger">to edit</th>
			</tr>
			</thead>		
<?php
		
						 //alle Daten aus Datenbank holen 
						$stmt =$db->prepare("SELECT id,Rider,Number,Time,until,Comment FROM Bike ORDER BY id DESC"); 
						$stmt->execute();
					$result = $stmt->fetchAll();
						foreach($result as $row):
?>					
										
		<form method="post">
		<!--tabelle Daten zeigen -->								 
 
		<tbody>
		  <tr  style = "border: 3px solid black;">
		<!--<td><?= htmlspecialchars($row['id']) ?> </td>-->
			<td class="bg-info"><?= htmlspecialchars($row['Rider']) ?> </td>
			<td class="bg-warning"><?= htmlspecialchars($row['Number']) ?> </td>
			
			
			
			
			
			
			
			<td class="bg-success"> <center><h3><p id="j">
	
	 <?= htmlspecialchars($row['Time'])  ?>
	 

			</h3> <button class="btn btn-primary" onclick="chang()"  id="<?php echo htmlspecialchars($row['Time']);?>" <?php $idd=htmlspecialchars($row['id']);?>  name="done" value="<?php echo htmlspecialchars($row['Time']); ?>">Done</button></center></td>
			
			
			
			
			
			<?  if($datum2 == $datum3 ){= htmlspecialchars($row['Time']) } ?>
			<td class="bg-warning"> <center><h3><?= htmlspecialchars($row['until']) ?> </h3> <input  type="checkbox"></center> </td>
			
			<td class="bg-info"><?= htmlspecialchars($row['Comment']) ?> </td>
			<td class="bg-danger"><button class="btn btn-primary"  id="<?php echo htmlspecialchars($row['id']);?>" <?php $idd=htmlspecialchars($row['id']);?>  name="bearbeiten" value="<?php echo htmlspecialchars($row['id']);?>">edit</button><br><br><button   class="btn btn-danger" value="<?php echo htmlspecialchars($row['id']);?>" name="Löschen" >Delete</button> </td>									
			</tr>							
		
<?php  
		//hier ist die ende von foreach 
	endforeach 
?>
		</tbody>
	    </table>
		</form>					
								
										

  </table>
                        
 </td></tr></table>   
 </table>
    

    </body>
</html>