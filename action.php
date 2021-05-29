<?php  
//action.php - 
//https://www.webslesson.info/2017/05/live-table-data-edit-delete-using-tabledit-plugin-in-php.html
//https://www.youtube.com/watch?v=75WnV-Suzkk

//$connect = mysqli_connect('localhost', 'root', 'DataSia2000!', 'ibcotacao');
$connect = mysqli_connect("mysql32-farm2.uni5.net", "ibmax0101_add1", "odin0427", "ibmax01");

if (!$connect) {
  die("Connection failed: " . mysqli_connect_error());
}

$input = filter_input_array(INPUT_POST);

$idsku = mysqli_real_escape_string($connect, $input["idsku"]);
$idreferencia = mysqli_real_escape_string($connect, $input["idreferencia"]);
$descricao_produto = mysqli_real_escape_string($connect, $input["descricao_produto"]);
$quantidadeproduto = mysqli_real_escape_string($connect, $input["quantidadeproduto"]);
$valorofertado = mysqli_real_escape_string($connect, $input["valorofertado"]);
$observacao = mysqli_real_escape_string($connect, $input["observacao"]);

if($input["action"] === 'edit')
{
 $query = "
 UPDATE movcotacao 
 SET valorofertado = '".$valorofertado."', 
 observacao = '".$observacao."' 
 WHERE id = '".$input["id"]."'
 ";
 mysqli_query($connect, $query);

}
if($input["action"] === 'delete')
{
 $query = "
 DELETE FROM tbl_user 
 WHERE id = '".$input["id"]."'
 ";
 mysqli_query($connect, $query);
}

echo json_encode($input);

?>
