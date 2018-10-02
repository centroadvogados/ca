			$(document).ready(function () 
			{
				setInterval
				(function ()
					{
						updateClock();
						updateDate();
					}, 1000
				);

				var vermelhoSvcDsk = $("#divSvcDsk").find(".alertaVermelho").length;
				var vermelhoInc = $("#divInc").find(".alertaVermelho").length;
				var vermelhoAtv = $("#divAtv").find(".alertaVermelho").length;
				
				var pretoSvcDsk = $("#divSvcDsk").find(".alertaPreto").length;
				var pretoInc = $("#divInc").find(".alertaPreto").length;
				var pretoAtv = $("#divAtv").find(".alertaPreto").length;

				//alert("Inc: " + vermelhoInc + ". Ativ: " + vermelhoAtv + ". Svc Dsk: " + vermelhoSvcDsk);
				var MsgVermelho = "<span>Alerta para Service Desks: " + (vermelhoSvcDsk + pretoSvcDsk) + "</span><br/><span>Alerta para Incidentes: " + (vermelhoInc + pretoInc) + "</span><br/><span>Alerta para Atividades: " + (vermelhoAtv + pretoAtv) + "</span>";

				var amareloInc = $("#divInc").find(".alertaAmarelo").length;
				var amareloAtv = $("#divAtv").find(".alertaAmarelo").length;
				var amareloSvcDsk = $("#divSvcDsk").find(".alertaAmarelo").length;
				//alert("Inc: " + vermelhoInc + ". Ativ: " + vermelhoAtv + ". Svc Dsk: " + vermelhoSvcDsk);
				var MsgAmarelo = "<span>Alerta para Service Desks: " + amareloSvcDsk + "</span><br/><span>Alerta para Incidentes: " + amareloInc + "</span><br/><span>Alerta para Atividades: " + amareloAtv + "</span>";

				if (vermelhoInc != 0 || vermelhoAtv != 0 || vermelhoSvcDsk || 0)
				{
					notif({
					  type: "error",
					  msg: MsgVermelho,
					  position: "right",
					  width: 300,
					  autohide: false,
					  opacity: 0.9,
					  multiline: true
					});
				}
				
				if (amareloInc != 0 && amareloAtv != 0 && amareloSvcDsk != 0)
				{
					
				}
				
			});

			function updateClock()
			{
				var currentTime = new Date();
				var hours = currentTime.getHours();
				var minutos = currentTime.getMinutes();
				var seconds = currentTime.getSeconds();

				if (seconds < 10)
					seconds = '0' + seconds;

				if (minutos < 10)
					minutos = '0' + minutos;

				if (hours < 10)
					hours = '0' + hours;

				$("#clock").html(hours + ':' + minutos + ':' + seconds);
			}

			function updateDate()
			{
				var currentTime = new Date();

				var dia = currentTime.getUTCDate();
				var mes = currentTime.getUTCMonth() + 1;
				var ano = currentTime.getFullYear();

				if (dia < 10)
					dia = '0' + dia;

				if (mes < 10)
					mes = '0' + mes;

				if (ano < 10)
					ano = '0' + ano;

				$("#date").html(dia + '/' + mes + '/' + ano);
			}