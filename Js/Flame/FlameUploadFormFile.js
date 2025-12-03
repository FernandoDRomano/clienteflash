function UploadFormFile(e){
	var form = e;
	//console.log(form);
	//var $form = $('.SubaDeImagenes');
	
	var droppedFiles = false;
	if(isAdvancedUpload){
		Loading();
		var ajaxData = new FormData(form);
		ajaxData.append('TestPost', "true");
		
		console.log({ajaxData})
		console.log(form.getAttribute('action'))
		
		$.ajax({
			url: form.getAttribute('action'),
			type: "POST",
			data: ajaxData,
			//dataType: 'json',//CORS
			cache: false,
			contentType: false,
			processData: false,
			//crossDomain: true,
			
			//headers: {
			//	'Access-Control-Allow-Origin': '*'
			//},
			
			complete: function() {
			},
			success: function(Resultado) {
				console.log(Resultado);
			    if (typeof Resultado === 'string' || Resultado instanceof String){
    				var Resultado = Resultado.trim();
    				if(Resultado=="NULL" || Resultado=="" || ( Resultado.indexOf("Error:") == 0 ) ){
    					if((Resultado.indexOf("Error:") == 0) ){
    						Resultado = Resultado.replace("Error:", "");
    						if(typeof $.bootstrapGrowl === "function") {
    							$.bootstrapGrowl(Resultado,{
    								type: 'danger',
    								align: 'center',
    								width: 'auto'
    							});
    						}
    					}
    				}else{
    					if(typeof $.bootstrapGrowl === "function" && Resultado!= "") {
    						$.bootstrapGrowl(Resultado,{
    							type: 'success',
    							align: 'center',
    							width: 'auto'
    						});
    					}
    				}
                }else{
                    var RespuestaAElemento = Resultado['Respuesta']['Datos'];
                    if(RespuestaAElemento != undefined){
                		if(RespuestaAElemento[0] != null){
                			if(RespuestaAElemento.length>1){
                				for( var i = 0 ; i < RespuestaAElemento.length ; i++){
                					var keys = Object.keys(RespuestaAElemento[i]);
                    				if(typeof $.bootstrapGrowl === "function") {
                                		$.bootstrapGrowl(RespuestaAElemento[i][keys[0]],{
                                			type: 'success',
                                			align: 'center',
                                			width: 'auto'
                                		});
                                	}
                				}
                				
                			}else{
                				var keys = Object.keys(RespuestaAElemento[0]);
                				if(typeof $.bootstrapGrowl === "function") {
                            		$.bootstrapGrowl(RespuestaAElemento[0][keys[0]],{
                            			type: 'success',
                            			align: 'center',
                            			width: 'auto'
                            		});
                            	}
                			}
                		}else{
                			console.log(RespuestaAElemento);
                		}
            	    }
                }
				EndLoading();
			},
			error:function(Resultado){
				//console.log(Resultado);
				if(typeof $.bootstrapGrowl === "function") {
					$.bootstrapGrowl("Ocurrio Un Error Al Intentar Mandar Los Datos",{
						type: 'danger',
						align: 'center',
						width: 'auto'
					});
				}
				EndLoading();
			}
		});
	}
}