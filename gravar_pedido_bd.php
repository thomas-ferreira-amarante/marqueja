<?php
	session_name('sessionuser');
	session_start();
	include('/includes/connect.php');
 

 
 $hora = $_POST['hora'];
  
 $data = $_POST['data'];
 
$data_completa = $data." ".$hora;
 
 $id_user = $_SESSION['COD'];
 $nome_cliente = $_SESSION['NOME'];
 $pedido_quadra = $_POST['quadra'];
 
 
$sql1	="SELECT * FROM tb_agenda WHERE data = '$data_completa' AND id_quadra = '$pedido_quadra'";
$query1	= mysqli_query($conn, $sql1);


							  
if(mysqli_num_rows($query1)>0) 
							{
								?>
									<script>
										alert('Horário não disponível para essa data, por favor escolha outro...');
										document.location.replace('user.php');				
									</script>s
								<?php
								
								
							} else {
									$sql = "INSERT INTO tb_agenda (id_quadra,data,id_user,nome_cliente) VALUES ('$pedido_quadra','$data_completa','$id_user','$nome_cliente')";
									$query = mysqli_query ($conn, $sql);
									
									if(!query){
										?>
											<script>
												alert('Erro ao realizar o agendamento :(');
												document.location.replace('user.php');				
											</script>
								<?php
									} else {
										?>
											<script>
												alert('Agendamento realizado com sucesso!');
												document.location.replace('user.php');				
											</script>
								<?php
									}
									}

