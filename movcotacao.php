<?php
// phpinfo();
//$connect = mysqli_connect("localhost", "root", "DataSia2000!", "ibcotacao");
$connect = mysqli_connect("mysql32-farm2.uni5.net", "ibmax0101_add1", "odin0427", "ibmax01");
$query = "SELECT * FROM movcotacao ORDER BY id DESC";
$result = mysqli_query($connect, $query);
$grid = mysqli_fetch_array($result);

$numeroCotacao = $grid['numerocotacao'];
$dataAbertura = $grid['dataabertura'];
$dataFechamento = $grid['datafechamento'];
?>
<html>  
 <head>  
          <title>Live Table Data Edit Delete using Tabledit Plugin in PHP</title>  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
          <link href="style.css" rel="stylesheet">
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>            
   <!-- <script src="https://unpkg.com/jquery-tabledit@1.0.0/jquery.tabledit.js"></script> -->


   <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cotação Web</title>
  <meta name="description" content="COTAÇÃO ONLINE - cotação online, produtos, Preço, valor, cotar">
  <!--Ideal até 140 caractéres-->
  <!--As meta tag's OG são utilizadas quando há compartilhamento do site, facilitam que as informações sejam encontradas pelo "faceboock" por exemplo-->
  <meta name="keywords" content="Cotação, Comparar preços, valor, cotar, produto, compra, comprar">
  <!--palavras chave-->
  <meta name="robots" content="index, foloow">
  <!--motores de busca indexar a página index e todos os links dentro dela-->
  <meta name="author" content="Nowork - Ronie Robson da Silva">
  <meta property="og:type" content="website">
  <meta property="og:title" content="Cotação">
  <meta property="og:description" content="COTAÇÃO ONLINE - cotação online, produtos, Preço, valor, cotar">
  <!--Deve ser sempre igual a description acima-->

  <link rel="sortcut icon" content="favicon.ico">
  <!--coloca o ícone no titulo da página, a imagem deve estar na mesma pasta do index para facilitar-->

  <link rel="stylesheet" href="css/styleCotacao.css">
     
    </head>  
<body> 
   <div id="interface">
      <div class="containner_table">
            <div class="title">
                <h1>
                    COTAÇÃO ONLINE
                </h1>
                <div id='buscaTop'>
                    <form action="/search" class="search" method="post">
                      <div class="containerFlex">
                        <input id="txtbusca" name="cxbusca" type="text" value="" placeholder="Buscar no Site" />
                        <input id="btnBusca" type="submit" value="Ok" />
                      </div>
                    </form>
                    <a class="menu" href=" # " target="_blank">CONTATO</a>
                    <a class="menu" href=" # " target="_blank">AJUDA</a>
                  </div>
            </div>
            <div class="local">
                <div id="logo">
                    <img id="logo_image" src="img/logo_iB_h1.svg" alt="Logo">
                    <div class="text_logo">
                        <div class="end">
                            <p class="endereco"> AV. José Sérvulo Soalheiro - 325 </p>
                            <p class="endereco"> Sete Lagoas - Minas Gerais </p>
                        </div>
    
                        <div class="containner_text">
                            <img src="img/empresa.svg" alt="empresa">
                            <p class="endereco"> (31) 3232-3232 </p>
                        </div>
                        <div class="containner_text">
                            <img src="img/watssapp.svg" alt="watssapp">
                            <p class="endereco">  (31) 99999-9999  </p>
                        </div>
                        <div class="containner_text">
                            <img src="img/instagram.svg" alt="watssapp">
                            <a href="https://instagram.com/ibsoftbrasil/" target="_blank">instagram.com/ibsoftbrasil/ </a>
                        </div>
                    </div>
                </div>
                <div class="contain_contador">
                    <h3 class="tile_input"> COTAÇÃO - Nº  </h3>
                    <div id="contador"> 
                          <?php
                           echo '<h2 id="cont"> '. $numeroCotacao .' </h2>';
                          ?>
                    </div>
                </div>
                <div class="calendario">    
                    <div class="imgCal">
                        <h4> Data de Abertura </h4>
                        <div class="contain_cal">
                            <img src="img/Cal_entrada.svg" alt="entrada">
                            <?php echo '<p class="dataOpen"> '. $dataAbertura .' </p>' ?>
                        </div>
                    </div>
    
                    <div class="imgCal">
                        <h4> Data de Fechamento </h4>
                        <div class="contain_cal">
                            <img src="img/Cal_saída.svg" alt="saida">
                            <?php echo '<p class="dataClose"> '. $dataFechamento .' </p>' ?>
                        </div>
                    </div>
                    
    
                </div>
            </div>
            
            <section> 
            <section>
                <div class="contain_data">
                    <table class="tableData">
                        <tr class="titleTable">
                            <td class="titleCell"> Cód. Produto </td>
                            <td class="titleCell"> Cód. SKU </td>
                            <td class="titleCell"> Cód. Referência </td>
                            <td class="titleCell"> Desc.Produto </td>
                            <td class="titleCell"> Qtd. a Comparar </td>
                            <td class="titleCell"> $ Oferta </td>
                            <td class="titleCell"> Observação </td>
                        </tr>
                        
                        <?php
                        while($row = mysqli_fetch_array($result))
                        {
                           echo '
                           <tr class="titleTable">
       
                              <td class="prodfix">'.$row["id"].'</td>
                              <td class="prodfix">'.$row["idsku"].'</td>
                              <td class="prodfix">'.$row["idreferencia"].'</td>
                              <td class="prodfix">'.$row["descricao_produto"].'</td>
                              <td class="prodfix">'.$row["quantidadeproduto"].'</td>
                              
                              <td class="prod">
                                    <form>
                                          <input class="cell" type="number" name="oferProd" min="1" max="1000000" step="0.01" placeholder="0,00">
                                    </form>
                              </td>
                              <td class="prod">
                                    <form>
                                          <input class="cell" type="text" name="obs" placeholder="Observação">
                                    </form>
                              </td>
                              </tr>
                              ';
                        }
                        ?>
                        
                        
                        <tr class="titleTable">
                            <td class="foot" colspan="7">
                                <div class="containButton">
                                    <div class="paginacao">
    
                                        <button class="return">
                                            <p class="volta">Anterior</p>
                                        </button>
                                        <div class="pg">
                                            <p class="pag">Página</p>
                                            <p class="pagN">00</p>
                                        </div>
                                        <button class="avanca">
                                            <p class="segue">Próxima</p>
                                        </button>
    
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="titleTable">
                            <td class="obs" colspan="7">
                                <div class="containObs">
                                    <p class="observacao">Observação:</p>
                                    <p class="textObs">
                                        Texto de Observação
                                    </p>
                                </div>
                            </td>
                        </tr>
                        <tr class="titleTable">
                            <td class="enviaForm" colspan="7">
                                <div class="btnEnvia">
                                    <button>
                                         Enviar Cotação
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr class="titleTable">
                            <td class="obs" colspan="7">
                                <p class="rodape">iB Max - Cotação Online Versão 0.0.1</p>
                            </td>
                        </tr>
                    </table>
                </div>
            </section>  
      </div>  
   </div>       
    
 </body>  

 <script src="https://kit.fontawesome.com/cc94e4aeb1.js" crossorigin="anonymous"></script>
</html>  
<script>  
$(document).ready(function(){  
     $('#editable_table').Tabledit({
      url:'action.php',
      columns:{
       identifier:[0, "id"],
       editable:[[5, 'valorofertado'], [6, 'observacao']]
      },
      restoreButton:false,
      onSuccess:function(data, textStatus, jqXHR)
      {
       if(data.action == 'delete')
       {
        $('#'+data.id).remove();
       }
      }
     });
 
});  
 </script>