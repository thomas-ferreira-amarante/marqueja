<?php
	
	
	session_name('sessionuser');
	session_start();
	include('includes/connect.php');
	
	$user = $_SESSION['COD'];

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
      <a class="navbar-brand" title="marquejá" data-placement="bottom" data-toggle="tooltip" href="#firststep">#MarqueJá</a>
      <button class="navbar-toggler navbar-toggler-left" type="button" data-toggle="collapse" data-target="#navbarNowUIKitFree">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse text-center justify-content-end" id="navbarNowUIKitFree">
        <ul class="navbar-nav">
          <li class="nav-item mx-1 align-items-center d-flex justify-content-center">
            <a class="nav-link" href="#proxjogos">
              <i class="now-ui-icons arrows-1_cloud-upload-94 x2 mr-2"></i>&nbsp;Próximos jogos</a>
          </li>
          <li class="nav-item mx-2 align-items-center d-flex justify-content-center">
            <a class="nav-link" href="#ultimosjogos">
              <i class="now-ui-icons files_paper x2 mr-2">Últimos jogos</i></a>
          </li>
		   <li class="nav-item mx-3 align-items-center d-flex justify-content-center">
            <a class="nav-link" href="#mapa">
              <i class="now-ui-icons files_paper x2 mr-2">Mapa de quadras</i></a>
          </li>
        </ul>
        <a class="btn btn-light text-primary" href="#agendamento">
          <i class="now-ui-icons arrows-1_share-66 mr-1"></i>Agendar</a>
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
				<h3 class="">
					<b>Seja bem-vindo <?=$_SESSION['NOME'] ?> </b>
				</h3>
			</div>
		</div>	  
		<div class="row" id="proxjogos">
			<div class="col-md-12">
				<h3 class="">
					<b>Seus próximos jogos:
				</h3>
			</div>
		</div>
		<?php
			$nenhum_jogo = "Você não possui jogos agendados";
			
			$sql = "SELECT * FROM `tb_agenda` WHERE id_user = 14 ORDER BY `tb_agenda`.`data` DESC";
			$sql1="SELECT * FROM tb_agenda a INNER JOIN tb_quadras b ON a.id_quadra = b.id WHERE id_user = '$user'" ;			
			$sql2= "SELECT * FROM `tb_agenda` WHERE `data`> NOW() AND id_user = '$user' ORDER BY `tb_agenda`.`data` DESC";
			// $sql3 = "SELECT * FROM tb_agenda a INNER JOIN tb_usuario b ON a.id_user = b.id WHERE id_user = '$user'"; -- > exibir nome do cliente que marcou
			
			$query = mysqli_query($conn,$sql);
			$query1 = mysqli_query($conn,$sql1);
			$query2 = mysqli_query($conn,$sql2);
			
			
			
			
			
				
				
			?>
				<div class="table-responsive">
				<table class="table table-striped">
				  <thead>
					<tr>
					  <th scope="col">#</th>
					  <th scope="col">Data</th>
					  <th scope="col">Hora</th>
					  <th scope="col">Local</th>					  
					  <th scope="col">Ações</th>
					  <th scope="col">Whats</th>
					</tr>
				  </thead>
					<?php if(mysqli_num_rows($query2)<1){ 
						?>						
							<tbody>
								<tr>
									<th> <b> <?php echo $nenhum_jogo ?></th>
								</tr>
							</tbody>						
						<?php } else {
									while($dados2 = mysqli_fetch_array($query2)){
										$dados1 = mysqli_fetch_array($query1)?>
				  <tbody>
					<tr>
					  <th scope="row"></th>
					 <?php 	$formatar_data_e_hora = $dados2['data'];
							$dataformat = explode(" ",$formatar_data_e_hora);
							$formatar_data = $dataformat[0];
							$var_aux_formatar = $formatar_data;
							$dataformat = explode("-",$var_aux_formatar);
							$var_aux_formatar = $dataformat[2]."/".$dataformat[1]."/".$dataformat[0];

							?>
					  <td><?php echo $var_aux_formatar; ?></td>
					  <?php $formatar_hora = $dados2['data'];
							$dataformat = explode(" ",$formatar_hora);
							$formatar_hora = $dataformat[1]; ?>					  
					  <td><?php echo $formatar_hora ?></td>
					  <td><?php echo $dados1['nome'] ?></td> 					  
					  <td> <button class="btn btn-danger" href="excluir_agendamento.php?key=<?=$dados2['id']?>" onClick="if(confirm('Deseja mesmo cancelar?')){document.location.href='excluir_agendamento.php?key=<?=$dados2['id']?>'}">Cancelar </button></td>
					  
					  <td> <button class="btn btn-success" onClick=window.location="whatsapp.php";> Whatsapp </button></td>
					</tr>    
				  </tbody>
				  <?php } }?>
				</table> 
				</div>
			 
			
		
		
	  
      <div class="row my-4" id="agendamento">
	  <div class="col">
		<form action="horarios.php" method="post">
			<div class="col">				
				<h4 class="mb-3">Data de agendamento</h4>
				<input type="text" class="form-control" name="data" id="datepicker" placeholder="Selecione a data desejada...">
			</div>
			<div class="col">				
				<h4 class="mb-3">Local do agendamento</h4>
				
				<select id="quadra" name="quadra" class="form-control">
                                <?php 
									$sql = "SELECT id,nome FROM tb_quadras";
									$query = mysqli_query($conn, $sql);
									while($dados = mysqli_fetch_array($query)) { ?>                                
                                     
                                     <option value="<?php echo $dados['id'] ?>" ><?php echo $dados['nome'] ?></option>     
                                      
                                <?php } ?>                       
                             </select>
				
				<button type="submit" value="pesquisar" class="btn btn-primary">
				  Veja os horários disponíveis para essa data
				</button>
			</div>
		 </form>
		</div>
	  </div>
	<div class="row" id="ultimosjogos">
		<div class="col-md-12">          
            <h4 class="mb-2">Ultimos agendamentos</h4>				
		</div>
	</div>
		<?php
			$sql = "SELECT * FROM tb_agenda WHERE `data` < now() AND id_user ='$user' ORDER by `data` DESC";
			$sql1="SELECT * FROM tb_agenda a INNER JOIN tb_quadras b ON a.id_quadra = b.id WHERE id_user = '$user'" ;

			$query = mysqli_query($conn,$sql);
			$query1 = mysqli_query($conn,$sql1);			
			
			 ?>
				<table class="table table-striped">
				  <thead>
					<tr>
					  <th scope="col">#</th>
					  <th scope="col">Data</th>
					  <th scope="col">Hora</th>
					  <th scope="col">Local</th>
					</tr>
				  </thead>
				  <?php if(mysqli_num_rows($query)<1){ ?>
				  <tbody>
						<tr>
							<th> <b> <?php echo $nenhum_jogo ?></th>
						</tr>
					</tbody>	
			<?php } else {
							
						while($dados = mysqli_fetch_array($query)){
								$dados1 = mysqli_fetch_array($query1)
			?>				
				  <tbody>
					<tr>
					  <th scope="row"></th>
					 <?php 	$formatar_data1 = $dados['data'];
							$dataformat = explode(" ",$formatar_data1);
							$formatar_data1 = $dataformat[0];
							$var_aux_formatar = $formatar_data1;
							$dataformat = explode("-",$var_aux_formatar);
							$var_aux_formatar = $dataformat[2]."/".$dataformat[1]."/".$dataformat[0];
							?>
					  <td><?php echo $var_aux_formatar ?></td>
					   <?php $formatar_hora1 = $dados['data'];
							$dataformat = explode(" ",$formatar_hora1);
							$formatar_hora1 = $dataformat[1]; ?>	
					  <td><?php echo $formatar_hora1 ?></td>
					  <td><?php echo $dados1['nome'] ?></td>
					</tr>    
				  </tbody>
				  <?php } }?>
				</table> 
				</div>
			
			
			
		
  
	<div class="py-5" id="mapa">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h4 class="mb-4">Veja as quadras mais próximas de você:</h4>
        </div>
      </div>
      <div class="row my-5">
        <div class="mx-auto col-8">          
            <iframe src="gps.html" width="800" height="600" frameborder="0" style="border:0" ></iframe>
        </div>
      </div>
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