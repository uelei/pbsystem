var timer;


// function dsql (t) {

//          var yyyy = t.getFullYear().toString();                                    
//         var mm = (t.getMonth()+1).toString(); // getMonth() is zero-based         
//         var dd  = t.getDate().toString();   
//         var hh = t.getHours().toString();
//         var n = t.getMinutes().toString();
//         var ss= t.getSeconds().toString();
                            
//         return  yyyy + '-' + mm + '-' + dd+ " "+ hh +":"+ n+":"+ss;  
// }


function buscago(){
    var str = $("#busca_string").val();

  if(str.replace(/\s/g,"") != ""){


    $.post( "http://pbs.piubol.com.br/index.php/venda/findproduto", { busca: str })
      .done(function( data ) {
        var obj = jQuery.parseJSON( data );
        $('#descp').val(obj.name);

        var pri = parseFloat(obj.price).toFixed(2);

        $('#preco').val(pri.replace(".",","));

        $('#cod').val(obj.product_id);
        $('#mais').val(obj.name+"////"+obj.model+"////"+obj.price_cost);



      });
    }else{

        $('#descp').val(" ");
        $('#preco').val("0,00");
        $('#cod').val(" ");
        $('#mais').val("////////");


    }



}

function starttimer()
{
timer = setTimeout(function(){buscago()},50);
}

function stoptimer()
{
clearTimeout(timer);
}


function refreshprodutos () {
  var rv = $("#rv").val();
  $.post( "http://pbs.piubol.com.br/index.php/venda/listadeprodutos", { rv : rv })
    .done(function( data ) {
      $("#produtos").empty();
      $( "#produtos" ).append( data );
    });

$.post( "http://pbs.piubol.com.br/index.php/venda/gettotal", { rv : rv })
    .done(function( data ) {
      $("#total").empty();

var tot = parseFloat(data).toFixed(2);

        $('#total').val(tot.replace(".",","));


$("#busca_string").focus();

    });

}

function refreshpg () {
  var rv = $("#n_rv").val();
  var totals = parseFloat($('#total').val().replace(",","."));
  $.post( "http://pbs.piubol.com.br/index.php/venda/listapagamentosrv", { rv : rv })
    .done(function( data ) {
      $("#divpg").empty();
      $( "#divpg" ).append( data );

var soma = parseFloat($('#somapg').val());
// $("#somapg").val

if(totals.toFixed(2) == soma.toFixed(2) ){
$("#btfechar").prop('disabled', false); 
$("#btfechar").focus();
}else{
$("#btfechar").prop('disabled', true);
$("#valor").focus();

}
var resto =( totals - soma ).toFixed(2);

$('#valor').val(resto.toString().replace(".",","));
$("#n_par").val("1");
$("tipo_pag").val("11");

    });

// $.post( "http://pbs.piubol.com.br/index.php/venda/gettotal", { rv : rv })
//     .done(function( data ) {
//       $("#total").empty();

// var tot = parseFloat(data).toFixed(2);

//         $('#total').val(tot.replace(".",","));


//     });

}



function checkdados() {
  var datarv = $("#datarv").val();
  var vend = $("#codvend").val();
  $.post( "http://pbs.piubol.com.br/index.php/venda/rv1", { datarv: datarv, codvend: vend })
    .done(function( data ) {
      $( "#aqui" ).append( data );
    });
}




function inserindonovoprodutonavenda () {
  
  $( "#myModal" ).modal();
  var cod = $("#cod").val();
  var mais = $("#mais").val();
  var rv = $("#rv").val();
  var qtd = $("#qtd").val();
  var preco = $("#preco").val();
  $.post( "http://pbs.piubol.com.br/index.php/venda/insertnew", { cod: cod, mais: mais ,rv : rv, qtd : qtd , preco : preco })
    .done(function( data ) {
      $("#cod").val('');
      $("#mais").val('');
      $("#qtd").val('1');
      $("#preco").val('');
      $('#busca_string').val('');
      $('#descp').val('');
      //$('#busca_string').focus();

    })
    .fail(function() {
      alert( "error ao inserir produto " );
    })
    .always(function() {
      $('#pleaseWaitDialog').addClass('hide');
      $('#myModal').modal('hide');

      refreshprodutos();
        
        setTimeout(function () {
           $('#busca_string').focus();
        },1);

           
    });
       // $('#busca_string').focus();
}












function deleteproduto (iddoproduto) {
  $( "#myModal" ).modal();
//alert(iddoproduto);
$.post("http://pbs.piubol.com.br/index.php/venda/delete",{iddoproduto : iddoproduto})
      .done(function( argument ) {

$('#myModal').modal('hide');

refreshprodutos();
$('#busca_string').focus();
  // body...
});



}




function deletepg (iddoproduto) {
  $( "#myModal" ).modal();
//alert(iddoproduto);
$.post("http://pbs.piubol.com.br/index.php/bills/deletepg",{im : iddoproduto})
      .done(function( argument ) {

$('#myModal').modal('hide');

refreshpg();
$('#valor').focus();
  // body...
});



}




function addpagamento () {
  $( "#myModal" ).modal();
  var i=0;
  var tipo_pag = $("#tipo_pag").val();
  var parcela = parseInt($("#n_par").val()); 
  var valors = $("#valor").val();
  var valor = parseFloat(valors.replace(",",".")).toFixed(2);
   var juros = 10;
   var id_status_padrao =0 ;
var prazo_medio =0;
var id_conta_padrao = 0;
  var rv = $("#n_rv").val();
//var datah="";
  var datarv = $("#datarv").val(); 

  var datar = datarv.split(" ");
  var dat= datar[0].split("-"); //ano data[0] mes data[1] dia data[2] 
 // var datah = datar[2]+"-"+datar[1]+"-"+datar[0];
  //2013-09-26 19:23:47
  //alert(datarv);
  // var rvnow = new Date(dat[0], dat[1], dat[2]);
 //var today = new Date();

//alert(dat);
  var m = moment(new Date(dat[0], (dat[1]-1), dat[2])); // the day before DST in the US
//alert(m);

// m.hours(); // 5
// m.add('days', 24).hours(); // 6
//alert(rvnow);

// var yyyy = this.getFullYear().toString();                                    
//         var mm = (this.getMonth()+1).toString(); // getMonth() is zero-based         
//         var dd  = this.getDate().toString();          

// var datasql = 




  $.post( "http://pbs.piubol.com.br/index.php/venda/getdadostpag", { tpg : tipo_pag })
        .done(function( data ) {
          //  id_t_pag  descricao_t_pag prazo_medio id_status_padrao  juros
          var oj = jQuery.parseJSON( data );
       
           prazo_medio = oj.prazo_medio;
          id_status_padrao = oj.id_status_padrao;
          juros = parseFloat(oj.juros);
          id_conta_padrao = oj.id_conta_padrao;






var vori = valor / parcela ; 

var vefe =  vori - ((vori * juros)/100);

        while(i<parcela){

        $('#ipro').empty();
        var ip = i+1;
        $('#ipro').append(ip+"/"+parcela);




          var pp =ip+"/"+parcela; 
// alert(prazo_medio);
          m.add('days',prazo_medio);

          var today = m.format("YYYY-MM-DD hh:mm:ss");
          // today.setDate(prazo_medio);//data_venc
          // alert(dsql(today));
// alert(today);
// var m = moment(new Date(2011, 2, 12, 5, 0, 0)); // the day before DST in the US
// m.hours(); // 5
// m.add('hours', 24).hours(); // 6

//         var yyyy = today.getFullYear().toString();                                    
//         var mm = (today.getMonth()+1).toString(); // getMonth() is zero-based         
//         var dd  = today.getDate().toString();   
//         var hh = today.getHours().toString();
//         var n = today.getMinutes().toString();
//         var ss= today.getSeconds().toString();
                            
//         var t =  yyyy + '-' + mm + '-' + dd+ " "+ hh +":"+ n+":"+ss;  
// alert(today);
          $.post( "http://pbs.piubol.com.br/index.php/venda/addpag", {data_venc : today  ,  tipo_pag : tipo_pag ,
            n_doc : rv,data_efe : today, parcela : pp, situacao : id_status_padrao , valor_ori : vori, valor_efe : vefe ,n_conta : id_conta_padrao })
             .done(function( data ) {


          refreshpg();

        $('#myModal').modal('hide');
//         refreshpg();
// $('#busca_string').focus();
        $('#ipro').empty();
        $('#ipro').append(" 1/1 ");

          });



    

        i++;
        }


        });













      // });








}



