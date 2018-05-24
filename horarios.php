<?php
	
	
	session_name('sessionuser');
	session_start();
	include('includes/connect.php');
	
	$quadra = $_POST['quadra'];
	$data = $_POST ['data'];
	
	if($data == null) {
				?>
                	<script>
                    	alert("Você precisa inserir uma data para continuar...")
						document.location.replace('user.php')
                    </script>
				<?php
				}
			
			$Formatdata = explode("/",$data);
			$data = $Formatdata[2].'-'.$Formatdata[1].'-'.$Formatdata[0];

?>

<!DOCTYPE html>
<html>


<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.standalone.min.css">
  <link rel="stylesheet" href="now-ui-kit.css" type="text/css">
  <link rel="stylesheet" href="assets/css/nucleo-icons.css" type="text/css">
  <script src="assets/js/navbar-ontop.js"></script>

  <title>Marquejá</title>

<body class="">
  <nav class="navbar navbar-expand-lg bg-primary navbar-dark fixed-top mb-5">
    <div class="container">
      <a class="navbar-brand" title="Designed by Invision. Coded by Creative Tim and Pingendo" data-placement="bottom" data-toggle="tooltip" href="#firststep">#MarqueJá</a>
      <button class="navbar-toggler navbar-toggler-left" type="button" data-toggle="collapse" data-target="#navbarNowUIKitFree">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse text-center justify-content-end" id="navbarNowUIKitFree">
        <ul class="navbar-nav">
          <li class="nav-item mx-1 align-items-center d-flex justify-content-center">
            <a class="nav-link" href="#download">
              <i class="now-ui-icons arrows-1_cloud-upload-94 x2 mr-2"></i>&nbsp;DOWNLOAD</a>
          </li>
          <li class="nav-item mx-1 align-items-center d-flex justify-content-center">
            <a class="nav-link" href="#">
              <i class="now-ui-icons files_paper x2 mr-2"></i>COMPONENTS</a>
          </li>
        </ul>
        <a class="btn btn-light text-primary" href="#pro">
          <i class="now-ui-icons arrows-1_share-66 mr-1"></i>Upgrade to PRO</a>
        <ul class="navbar-nav flex-row justify-content-center mt-2 mt-md-0">
          <li class="nav-item mx-1">
            <a class="nav-link" href="#" data-placement="bottom" data-toggle="tooltip" title="Follow us on Twitter">
              <i class="fa fa-fw fa-twitter fa-2x"></i>
            </a>
          </li>
          <li class="nav-item mx-3 mx-md-1">
            <a class="nav-link" href="#" data-placement="bottom" data-toggle="tooltip" title="Like us on Facebook">
              <i class="fa fa-fw fa-facebook-official fa-2x"></i>
            </a>
          </li>
          <li class="nav-item ml-1">
            <a class="nav-link" href="#" data-placement="bottom" data-toggle="tooltip" title="Follow us on Instagram">
              <i class="fa fa-fw fa-instagram fa-2x"></i>
            </a>
          </li>
		  <li class="nav-item mx-1 align-items-center d-flex justify-content-center">
            <a class="nav-link" href="logoff.php">
              <i class="now-ui-icons files_paper x2 mr-2"></i>Sair</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="py-5 bg-secondary">
  </div>
  <div class="py-5 bg-secondary">
	<div class="container">
      <div class="row">
        <div class="col-md-12">
			Data selecionada: <?php echo $data ?>
			Quadra selecionada: <?php echo $quadra ?>
		</div>
	  </div>
	</div>
  </div>
  <div class="py-5 bg-secondary">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
			<form action="confirma_pedido.php" method="post">
			<?php	
																		
			$sql3= "SELECT DATE_FORMAT(data, '%H:%i:%s') as hora from tb_agenda WHERE DATE_FORMAT(data,'%Y-%m-%d')='$data' AND id_quadra='$quadra'";
			$query3	= mysqli_query($conn, $sql3);
			
			
			 ?>
				<div> 		
					<div class="row">
						<div class="col"> 
								 
						<?php    
								 while ($dados3 = mysqli_fetch_array($query3)){
									  
									  $var_hora = $dados3['hora'];									  
									  $horaformat2 = explode(".",$var_hora);
									  $hora2 = $horaformat2[0];
									  $horas_cadastradas[]=$hora2; // array recebendo as strings do banco de dados
									}
									
									$var_texto = "A variável está nula";									
									if ($horas_cadastradas == null){
										foreach(array("9:00:00","10:00:00","11:00:00","12:00:00","13:00:00","14:00:00","15:00:00","16:00:00","17:00:00","18:00:00","19:00:00","20:00:00","21:00:00","22:00:00","23:00:00") as $hora_array_disponivel) {
											?> <button class="btn btn-lg btn-success" name="hora" value="<?php echo $hora_array_disponivel ?>" placeholder="<?php echo $hora_array_disponivel?>" > <?php echo  $hora_array_disponivel ?> <br> <?php ?> </button><?php
									} 
									}else {
								 
								 $resultado = "Indisponível";
								 $horas_disp = array("9:00:00","10:00:00","11:00:00","12:00:00","13:00:00","14:00:00","15:00:00","16:00:00","17:00:00","18:00:00","19:00:00","20:00:00","21:00:00","22:00:00","23:00:00");
								
									
								 foreach($horas_disp as $hora_array) {
										if(in_array($hora_array,$horas_cadastradas)){
											?> <input readonly class="btn btn-lg btn-danger " placeholder="<?php echo  $resultado ?>"></button><?php 
											} else {
											?> <button class="btn btn-lg btn-success" name="hora" value="<?php echo $hora_array ?>" placeholder="<?php echo $hora_array?>" > <?php echo  $hora_array ?> <br> <?php ?> </button><?php
								 
								}
							  }
						    }  
				?>		</div>
					</div>
				</div>
				
				<input type="hidden" name="data" value="<?php echo $data?>" placeholder="<?php echo $data?>" ></button>
				<input type="hidden" name="quadra" value="<?php echo $quadra?>" placeholder=" <?php echo $quadra?>"></button>
				
			</form>
        </div>
      </div>
	 </div>
	</div>
      
  
     
      
  
   <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="assets/js/parallax.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.js"></script>
  <script>
    
	var date = new Date();
	date.setDate(date.getDate());
	
	$(document).ready(function(){
            $('[data-toggle="popover"]').popover();   
            $('[data-toggle="tooltip"]').tooltip();
            $('#datepicker').datepicker({
				calendarWeeks: true,
                autoclose: true,
                todayHighlight: true,
				startDate: date,
				format: "dd/mm/yyyy"				
            });
          });
  </script>
  
</body>

</html>