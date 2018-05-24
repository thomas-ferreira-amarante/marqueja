<?php
	include('includes/connect.php');
		
	$sql	= "DELETE FROM tb_agenda WHERE id ='{$_GET['key']}'";
	$query	= mysqli_query($conn, $sql);
	
	if(!$query)
		{
			?>
            	<script>
					alert('Erro ao cancelar. Contate diretamente a quadra para finalizar o cancelamento.');
					document.location.replace('user.php');
                </script>
			<?php
		}
			else
				{
						
			?>
            	<script>
					alert('Agendamento cancelado.');
					document.location.replace('user.php');
                </script>
			<?php
		
				}
?>