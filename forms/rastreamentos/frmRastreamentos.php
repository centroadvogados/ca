<?php
 session_start();
 $param=$_POST['param'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt">
<meta name="viewport" content="initial-scale=1.0">
<meta charset="utf-8">
<head>
		<script src="forms/rastreamentos/js/jquery.min.js"></script>
		                                    
                        <!-- Maps API Javascript -->
                        <script src="http://maps.googleapis.com/maps/api/js?key= AIzaSyBp7dDnzKcd3d3X8GCL1FdTDxHBhvVwZpI&amp;sensor=false"></script>
        
                        <!-- Caixa de informação -->
                        <script src="forms/rastreamentos/js/infobox.js"></script>
		
                        <!-- Agrupamento dos marcadores -->
                        <script src="forms/rastreamentos/js/markerclusterer.js"></script>
 
                        <!-- Arquivo de inicialização do mapa -->
    <script src="forms/rastreamentos/js/mapa.js"></script>
    <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=API_KEY" type="text/javascript">
   		$(document).ready(function() {
			$('#tabbela').DataTable({ responsive: true });
		});
            //< ![CDATA[
    var zeroLat = new GLatLng(-23.588334358688655,-46.61230802536011); //Ponto central (local do evento)
    function load() {
      if (GBrowserIsCompatible()) {
        var map = new GMap2(document.getElementById("map"));
        map.addControl(new GLargeMapControl()); //Controles de Zoom, movimento
        map.addControl(new GMapTypeControl()); // Controle de tipo de mapa
        map.addControl(new GOverviewMapControl()); //Mapinha pequeno no canto
        map.setCenter(zeroLat, 5); //Setar centro do mapa, com nivel 5 de zoom
 
    //... MORE CODE ...
          
//Handle XML
GDownloadUrl("phpconfbrasil2006.xml", function(data, responseCode) {
  var xml = GXml.parse(data);
  var markers = xml.documentElement.getElementsByTagName("marker"); //Ler lista de pontos
 
  document.getElementById('count').innerHTML = "<b>Congressistas registrados: "+markers.length+"</b>"; //Publicar contagem
 
  for (var i = 0; i < markers.length; i++) {
    var point = new GLatLng(parseFloat(markers[i].getAttribute("lat")),
                            parseFloat(markers[i].getAttribute("lng")));
 
        if (markers[i].getAttribute("tit") == "PHP Conference Brasil 2006"){ //Exceção para ponto central
        var myIcon = new GIcon(G_DEFAULT_ICON,'ev-icon.png');
        myIcon.iconSize = new GSize(55, 54);
        myIcon.iconAnchor = new GPoint(16, 52);
    }else{
        var myIcon = G_DEFAULT_ICON;
    }
 
    var dados = { title: markers[i].getAttribute("tit"), icon: myIcon}; //Dados
    map.addOverlay(new GMarker(point,dados)); //Criar marker
 
    //Adicionar Linha que liga ponto ao evento
    var polyline = new GPolyline([
        zeroLat,
        point
    ], "#ff0000", 1);
    map.addOverlay(polyline);
 
    //Adicionar na Lista (HTML)
    var ul = document.getElementById('ullista');
    var li = document.createElement('li');
    li.innerHTML = "<b>"+markers[i].getAttribute("tit")+" - \t\tDistância: "+ Math.round(point.distanceFrom(zeroLat)/1000)+ "km";
    ul.appendChild(li);
  }
});          
//************************************************************
  GEvent.addListener(map, "click", function(marker, point) {
  if (marker) { //Se estiver clicando sobre marker
    var tpoint = marker.getPoint(); //pegar ponto lat por long
    var distance = tpoint.distanceFrom(zeroLat)/1000;
 
    var cnt = "<div id='popup'>";
    cnt    += "<br />Distância: "+Math.round(distance)+" km"; //Calcular distancia
    cnt    += "</div>";
    marker.openInfoWindowHtml(cnt);
  } else { //Se estiver clicando em ponto em branco
    var nome = window.prompt("Digite: NOME - Cidade,Estado"); //Pegar texto para nome do marker
    if (!nome){
        return false
    }
    var dados = { title: nome }
    map.addOverlay(new GMarker(point,dados));
 
    //Adicionar no XML via AJAX
    var req = GXmlHttp.create();
    req.open("POST", "addmarker.php", true);
    req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
 
        //Montar parâmetros
    var param = 'tit=' + nome;
    param    += '&lat=' + point.lat();
    param    += '&lng=' + point.lng();
    req.send(param);
  }
});
          
          
    </script>
    
</head>
<body onLoad="if(ieBlink){setInterval('doBlink()',450)}" scrollbars="yes">

        <div class="row modal-header" style="background: #d9edf7; border-radius: 10px 10px 0px 0px; max-height:50px;">
					<a href="javascript:fecha_tabela()"><img src='imgs/btn_x.png' alt='Fecha Janela' class='direita' /></a>
					<h3 class="modal-title" style="font-weight:bold; font-size:20pt; color:#4F94CD">Rastreamentos</h3> 
                    
 
				
			
        </div>
</body>

</html>