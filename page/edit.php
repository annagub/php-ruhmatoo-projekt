<?php
	//edit.php
	require("../functions.php");
	
	require("../class/Finish.class.php");
	$Finish = new Finish($mysqli);
	
	require("../class/Helper.class.php");
	$Helper = new Helper();
	
	//var_dump($_POST);
	
	//kas kasutaja uuendab andmeid
	if(isset($_POST["update"])){
		
		$Finish->update($Helper->cleanInput($_POST["id"]), $Helper->cleanInput($_POST["level"]), $Helper->cleanInput($_POST["description"]));
		
		header("Location: edit.php?id=".$_POST["id"]."&success=true");
        exit();	
		
	}
	
	//kustutan
	if(isset($_GET["delete"])){
		
		$Finish->delete($_GET["id"]);
		
		header("Location: data.php");
		exit();
	}
	
	
	
	// kui ei ole id'd aadressireal siis suunan
	if(!isset($_GET["id"])){
		header("Location: data.php");
		exit();
	}
	
	//saadan kaasa id
	$f = $Finish->getSingle($_GET["id"]);
	//var_dump($c);
	
	if(isset($_GET["success"])){
		echo "Success!";
	}

	
?>
<?php require("../header.php"); ?>
<div class="navbar navbar-inverse navbar-static-top">
	<div class="container">
		<div class="navbar-header">
			 <a class="navbar-brand" href="data.php"><i class="fa fa-home" aria-hidden="true"></i> Avaleht</a> 
		</div>
			<ul class="nav navbar-nav">
				<li><a href="addidea.php"><span class="glyphicon glyphicon-plus"></span> Lisa Idee</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="user.php"><i class="fa fa-user-circle" aria-hidden="true"></i>Minu Konto</a></li>
				<li><a href="?logout=1"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
			</ul>
		</div>
	</div>
</div>
<div class="container">
<h2>Edit</h2>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
	<input type="hidden" name="id" value="<?=$_GET["id"];?>" > 
  	<label for="number_idea" >Idea</label><br>
	<input id="number_idea" name="idea" type="text" value="<?php echo $f->idea;?>" ><br><br>
  	<label for="description" >Description</label><br>
	<input id="description" name="description" type="text" value="<?=$f->description;?>"><br><br>
  	
	<input type="submit" name="update" value="Save">
  </form>
  
  
 <br>
 <br>
 <br>
 <a href="?id=<?=$_GET["id"];?>&delete=true">Delete</a>
</div>
<?php require("../footer.php"); ?>