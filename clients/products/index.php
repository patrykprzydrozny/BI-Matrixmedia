<html>
	<head>
		<style>
		.tabledit-deleted-row {
			display: none;
		}
		.panel-default {
			display:none;
		}
		#ExitProducts {
			display:none;
		}		
		 
		</style>
		<link rel="stylesheet" href="assets/css/style.css">
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
		<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css" />	
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://markcell.github.io/jquery-tabledit/assets/js/tabledit.min.js"></script> 
		<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script> 
		<script src="https://markcell.github.io/jquery-tabledit/assets/js/tabledit.min.js"></script>
		
	</head>
	<body>
		<div class="container">
		<input data-function="swipe" id="swipe" type="checkbox">
			<label data-function="swipe" for="swipe">&#xf057;</label>
			<label data-function="swipe" for="swipe">&#xf0c9;</label>
			<div class="headings">
			<input type="button" class="button" id="ShowProducts" name="ShowProducts "onclick="addTable()" value="Aplikacja Cenowa"/>	
				<div id="panel-default" class="panel panel-default">
					<div class="panel-body">
						<div class="table-responsive">
							<table id="sample_data" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>Id</th>
										<th>Name</th>
										<th>Ean</th>
										<th>Weight</th>
										<th>Rule</th>
										<th>Supplier</th>
										<th>Buy_Price</th>
										<th>Date</th>
										<th>Id_Products_Price</th>
									</tr>
							</thead>
						<tbody></tbody>
						</table>
						<input type="button" class="button" id="ExitProducts" name="ExitProducts "onclick="removeTable()" value="Zamknij aplikacje"/>
					</div>
				</div>
			</div>
				<input type="button" class="button" id="importsheets" name="importsheets "onclick="AddFile()" value="Zaczytaj cennik"/>
				<div id="importfile">
					<form action="import.php" method="post" enctype="multipart/form-data">
						<p>
							Wybierz plik Excela:
						</p>
						<input class="button" type="file" name="upexcel" accept=".csv,.xls,.xlsx" required/>
						<input class="button" type="submit" value="Upload"/>
						<input type="button" class="button" id="ExitFile" name="ExitFile "onclick="RemoveFile()" value="Zamknij zaczytywanie"/>
					</form>

				</div>
		</div>
			<div class="sidebar">
				<nav class="menu">
					<li><a href="http://bi.matrixmedia.pl/clients">Wróć	</a></li>
					<li><a href="">Allegro</a></li>
					<li><a href="">Sklep</a></li>
					<li><a href="">Zmień Hasło</a></li> 
					<li><a href="">Wyloguj</a></li>
				</nav>
			</div>
		</div>
	<br />
	<br />
 </body>
</html>
<script type="text/javascript" language="javascript" >
function addTable(){
   document.getElementById('panel-default').style.cssText = 'display:block;';
   document.getElementById('ShowProducts').style.cssText = 'display:none;';
   document.getElementById('ExitProducts').style.cssText = 'display:block !Important;';
  }
function AddFile(){
   document.getElementById('importfile').style.cssText = 'display:block !Important;';
   document.getElementById('ExitFile').style.cssText = 'display:block !Important;';
  }  
function RemoveFile(){
   document.getElementById('importfile').style.cssText = 'display:none !Important;';
  }  
function removeTable(){
   document.getElementById('panel-default').style.cssText = 'display:none;';
   document.getElementById('ShowProducts').style.cssText = 'display:block;';
  }
  
 </script>
<script type="text/javascript" language="javascript" >
$(document).ready(function(){

 var dataTable = $('#sample_data').DataTable({
  "processing" : true,
  "serverSide" : true,
  "order" : [],
  "ajax" : {
   url:"fetch_query.php",
   type:"POST"
  }
 });

 $('#sample_data').on('draw.dt', function(){
  $('#sample_data').Tabledit({
   url:'action.php',
   dataType:'json',
   columns:{
    identifier : [0, 'Id'],
    editable:[[1, 'Name'], [3,'Weight'], [4,'Rule'], [5,'Supplier']] 
	
   },
   restoreButton:true,
   onSuccess:function(data, textStatus, jqXHR)
   {
    if(data.action == 'delete')
    {
     $('#' + data.id).remove();
     $('#sample_data').DataTable().ajax.reload();
    }
   }
  });
 });
  
}); 
</script>

