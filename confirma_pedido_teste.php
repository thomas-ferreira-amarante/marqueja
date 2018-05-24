<?php
	
	session_name('sessionuser');
	session_start();
	include('includes/connect.php');
	
	$quadra = $_POST['quadra'];
	$data = $_POST ['data'];
	echo $hora = $_POST ['hora'];
	
	
	$sql = "SELECT valor_manha, valor_tarde, valor_noite FROM tb_quadras WHERE id = '$quadra'";
	$query = mysqli_query($conn, $sql);
	$dados = mysqli_fetch_array($query);
	
	if($hora == '9:00:00' || '10:00:00' || '11:00:00' || '12:00:00'){
			
			 $valor = $dados['valor_manha'];
		
	} else if($hora == '13:00:00' || '14:00:00' || '15:00:00' || '16:00:00' || '17:00:00' || '18:00:00') {
		 $valor = $dados['valor_tarde'];
	} else {
		 $valor = $dados['valor_noite'];
	}
	  
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
  <script type="text/javascript"src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js"></script>
  <link rel="icon" href=""> <!-- adicionar ícone aqui -->
  
  <title>Marquejá</title>
  
  
  
  <script>
	// funcão para automatizar e atribuir um valor a variável 'code', pegando esse valor via post do arquivo pagseguro.php
	function enviaPagseguro(){
		$.post('pagseguro.php','',function(data){
			$('#code').val(data);
			$('#comprar').submit();
		})
	}	
	
	var date = new Date();
	date.setDate(date.getDate());
	
    $(document).ready(function(){
            $('[data-toggle="popover"]').popover();   
            $('[data-toggle="tooltip"]').tooltip();
            $('#datepicker-example').datepicker({
                calendarWeeks: true,
                autoclose: true,
                todayHighlight: true,
				startDate: date
				
            });
          });
		  
		
  </script>
  

<body class="">
  <nav class="navbar navbar-expand-lg bg-primary navbar-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" title="#marquejá" data-placement="bottom" data-toggle="tooltip" href="#firststep">#MarqueJá</a>
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
  <div>
  <div class="container py-5 bg-success">
	
  </div>
  <div class="py-5 bg-secondary">
	<div class="container">
      <div class="row">
        <div class="col-md-12">
			  <p class="text-center">Data selecionada: <?php echo $data ?></p>
		</div>
	  </div>
	  <div class="row">
        <div class="col-md-12">
		<p class="text-center">Quadra selecionada: <?php echo $quadra ?></p>
		</div>
	  </div>
	  <div class="row">
        <div class="col-md-12">
		 <p class="text-center">Horário do jogo: <?php echo $hora ?></p>
		</div>
	  </div>
	  <div class="row">
        <div class="col-md-12">
		 <p class="text-center">Usuário: <?php echo $_SESSION['NOME'] ?></p>
		</div>
	  </div>
	  <div class="row">
        <div class="col-md-12">
		 <p class="text-center">Valor: R$<?php echo $valor ?></p>
		</div>
	  </div>
	</div>
  </div>
    <div class="container py-5 bg-primary">
      <div class="row">
        <div class="col-md-6">
          <h4 class="mb-3">Confirmar pedido?</h4>
        </div>
	
		<button class="btn btn-success" onclick="enviaPagseguro()">Comprar</button>
	
	
		<form id="comprar" action="https://sandbox.pagseguro.uol.com.br/v2/checkout/payment.html" method= "post" onsubmit="PagSeguroLightbox(this); return false;">
			<input type="hidden" name="code" id="code" value="" />
		</form>
		
      </div>
    </div>
  </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="assets/js/parallax.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.js"></script>
  <script type="text/javascript" src="https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js"></script>
  
  
  </body>

</html>