
function gera () {
  var t = 0.0;
  
  var data = new google.visualization.DataTable();
  data.addColumn('string', 'Vendedor');
  data.addColumn('number', 'Valor');
 var wid = document.getElementById('funcgrafico').offsetWidth;
  var d = $("#inputMes").val();
  $.post( "http://pbs.piubol.com.br/index.php/venda/dadosdograficovendas", { inputmes : d })
    .done(function(dat){
      var  obj = jQuery.parseJSON(dat);
      for(x in obj){
        t = t+ parseFloat(obj[x].ts);
        //addiciona dados ao grafico 
        data.addRow([ obj[x].firstname, parseFloat(obj[x].ts) ]);
      }
      var s = "Total das Vendas : R$ "+ t.toFixed(2).toString();
      var options = {'title':s,is3D: true,'width':wid,'height':wid};
     var  chart = new google.visualization.PieChart(document.getElementById('funcgrafico')).draw(data, options);
    });
}








function gera2 () {
  var t = 0.0;
  var widc = document.getElementById('funcgraficoc').offsetWidth;
  var datames = new google.visualization.DataTable();
  datames.addColumn('string', 'Vendedor');
  datames.addColumn('number', 'Valor');

  var d = $("#inputMes").val();
  $.post( "http://pbs.piubol.com.br/index.php/venda/dadosdograficovendasmm", { inputmes : d })
    .done(function(dat){
      var  obj = jQuery.parseJSON(dat);
      for(x in obj){
        t = t+ parseFloat(obj[x].ts);
        //addiciona dados ao grafico 
        datames.addRow([ obj[x].firstname, parseFloat(obj[x].ts) ]);
      }
      var s = "Total das Vendas no Mes : R$ "+ t.toFixed(2).toString();
      var options = {'title':s,is3D: true,'width': widc,'height':widc};
     var  chartmes = new google.visualization.PieChart(document.getElementById('funcgraficoc')).draw(datames, options);
    });
}









function barra () {
  var t = 0.0;

  var da = new google.visualization.DataTable();
  da.addColumn('string', 'Dias');
  da.addColumn('number', 'Sales');
  da.addColumn('number','Medio' );
  var d = $("#inputMes").val();
  var widd = document.getElementById('daychart').offsetWidth;
  $.post( "http://pbs.piubol.com.br/index.php/venda/dadosdograficovendasd", { inputmes : d })
    .done(function(dat){
       var  obj = jQuery.parseJSON(dat);   // keys(obj).lengthvar data = /* your parsed JSON here */
//wvar numberOfElements = data.food.length;
      for(x in obj){
        t = t+ parseFloat(obj[x].ts);
        //addiciona dados ao grafico 
        da.addRow([ obj[x].day, parseFloat(obj[x].ts), parseFloat(obj[x].avg) ]);   
        }
// var da = google.visualization.arrayToDataTable(dat);
          var s = "Vendas do Mes : R$ "+ t.toFixed(2).toString();
        var options = {
          title: s,'width':widd,'height':widd*0.4,
          vAxis : {minValue: 0 },
           seriesType: "bars",
    series: {1: {type: "line"}},
          hAxis: {title: 'Dias', titleTextStyle: {color: 'red'}}
        };
      var chartt = new google.visualization.ComboChart(document.getElementById('daychart')).draw(da, options);
      // var avg = t/i;
      //$("#averageday").html("<h3>Valor medio das vendas por dia: "+avg.toFixed(2)+"</h3>");

    });

}












function barra2 () {
  var t = 0.0;
  var daa = new google.visualization.DataTable();
  daa.addColumn('string', 'Mes');
  daa.addColumn('number', 'Sales');
    daa.addColumn('number','Medio' );
var d = $("#inputMes").val();
 var widm = document.getElementById('mchart').offsetWidth;
  $.post( "http://pbs.piubol.com.br/index.php/venda/dadosdograficovendasm", { inputmes : d })
    .done(function(dados){
       var  obj = jQuery.parseJSON(dados);
      for(x in obj){
        t = t+ parseFloat(obj[x].ts);
        //addiciona dados ao grafico 
        daa.addRow([ obj[x].m, parseFloat(obj[x].ts) , parseFloat(obj[x].avg) ]);
        }
              // $("#averageday").html("<h3>Valor medio das vendas por dia: "+dados+"</h3>");

// var da = google.visualization.arrayToDataTable(dat);
          var s = "Vendas do Ano : R$ "+ t.toFixed(2).toString();
        var options = {
          title: s,'width':widm,'height':widm*0.4,
          vAxis : {minValue: 0 },
          seriesType: "bars",
    series: {1: {type: "line"}},
          hAxis: {title: 'Mes', titleTextStyle: {color: 'red'}}
        };
      var chars = new google.visualization.ComboChart(document.getElementById('mchart')).draw(daa, options);
    });

}

