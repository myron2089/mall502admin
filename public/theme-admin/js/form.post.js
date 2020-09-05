// Preparar los datos del formulario para enviar via ajax

$("#register-form").submit(function( event ) {
	event.preventDefault();
	

		var btnSubmit = document.getElementById('btn-submit')
	
		btnSubmit.classList.add('kt-spinner')
		btnSubmit.classList.add('kt-spinner--right')
		btnSubmit.classList.add('kt-spinner--sm')
		btnSubmit.classList.add('kt-spinner--light')
		var data = new FormData($(this)[0]);
		//console.log(data)
		
		var form = $(this);
		var url = form.attr("action");
		var regFrom = $("#registerFrom").val();
		var regType = $("#type").val();
		var result = itemStore(data, url).done(function(response) {
           
            var data = jQuery.parseJSON(response);
            //var data = response;
			//console.log(data);
			//console.log(regFrom);
			
            
            if(data.success == true ){
                setTimeout(
                showToastr(data.message, "Mensaje", "success")
                ,1000);

                form[0].reset();
				
				btnSubmit.classList.remove('kt-spinner')
				btnSubmit.classList.remove('kt-spinner--right')
				btnSubmit.classList.remove('kt-spinner--sm')
				btnSubmit.classList.remove('kt-spinner--light')
				
                //console.log(data.data);
				if(regFrom == "pjax"){
					var listName = $("#list-name").val();
					var formName = $("#register-name").val();
					
					$("#"+listName).fadeIn();
					$("#"+formName).fadeOut();
					
					$('#suc-admin-ref')[0].click();
					//$('#usr-admin-ref')[0].click();
					//$('#usr-admin-ref')[0].click();
				
				}
				if(regFrom == "modal-form"){
					
					if(regType=="company"){
						var category = document.getElementById("companyCategory");
						var categoryName= category.options[category.selectedIndex].text;
						
						addCompanyListItem(data.data.id,data.data.companyName, data.data.companyDescription, data.data.companyAddress, 
						                   data.data.companyPhoneNumber, data.data.companyEmail, data.data.companyWebSite, categoryName );
						hideModal("kt_modal_6");
						
						var modalId = document.getElementById('modalId').value
						document.cookie = "loadContent=true";
						
						closeCustomModal(modalId)
						
						
					}
					
					
				}
				
            }
            else{
                showToastr(data.message, "Error", "error")
            }
			
			/*if(regFrom=='modal-form'){
				console.log('modalhidding')
				closeCustomModal(data.modalId)
			}*/
            
          
            setTimeout(   
				unblockUiContainer("#m-portlet-blockui", 1000),
				1000);
        });  
		
});


//Bloquear contenido de un div utilziando plugin blockui
function blockUiContainer(divId, message){

    $(divId).block({ 
        message: '<div class="page-loader-inner"></div><!--<span style="float:left; margin-top:20px; width: 100%; text-align:center;">'+ message+'</span>--><div class="lds-dual-ring"></div>', 
        type:"loader",
        css: { border: '1px solid #c5c5c5',
               height: '150px',
			   'border-radius': '3px',
			   'line-height': '',
			   'font-size': '15px',
			   'padding': '20px',
			   'z-index': '1500',
			   backgroundColor:'#ffffff',
			   cursor: 'wait'
			 } 
    }); 

   
}


//Mostrar modal al presionar boton
function companyCreate(){
	
	$('#kt_modal_6').modal('show');
}

//Ocultar Modal
function hideModal(modalId){
	$('#'+modalId).modal('hide');
}

//Mostrar nuevo item de empresa al crear
function addCompanyListItem(id,name, description, address, phoneNumber, email, website, categoryName){
	
	//Crear el div
	var firstChar = name.charAt(0);
	var url = window.location.origin + '/empresa/administrar/'+id+'/inicio';
	var $container = $('<div class="col-md-4 col-sm-6 col-xs-12 mb-4">'+
                                
                            '<div class="kt-widget kt-widget--user-profile-2 md-card md-card-minimal">'+
								'<div class="kt-widget__head md-card__head">' +
                                    '<div class="kt-widget__media md-card__media">' +
                                        '<img class="kt-widget__img kt-hidden " src="./assets/media/users/300_21.jpg" alt="image">' +
                                        '<div class="kt-widget__pic kt-widget__pic--info  kt-font-info kt-font-boldest  kt-hidden-  custom-widget-pic md-card__pic">' +
                                               name[0] + 
                                        '</div>' +
									'</div>'+
									'<div class="kt-widget__info pl-2 ml-2 mt-1 md-card__info">'+
										'<a href="'+url+'" class="kt-widget__username upper">'+
											name +

										'</a>'+
										'<span class="kt-widget__desc md-card__desc">'+
										   categoryName +
										'</span>'+
									'</div>'+
								'</div>'+
                                '<div class="kt-widget__body md-card__body">' +
                                        
                                    '<div class="kt-widget__item mt-2">' +
										'<a href="#" class="kt-font-brand kt-link kt-font-transform-u kt-font-bold">0 {{$suc}}</a>' +
										'<div class="kt-widget__contact custom_widget__contact">' +
											
											'<span href="javascript;;" class="lbl-field-value">'+address+'</span>' +
										'</div>' +
										'<div class="kt-widget__contact custom_widget__contact">' +
											
											'<span href="#" class="lbl-field-value">'+phoneNumber+'</span>' +
										'</div>' +
										'<div class="kt-widget__contact custom_widget__contact">' +
											
											'<span class="lbl-field-value">'+email+'</span>' +
										'</div>' +
										'<div class="kt-widget__contact custom_widget__contact">' +
											
											'<span class="lbl-field-value">'+website+'</span>' +
										'</div>' +
									'</div>' +
								'</div>' +
								'<div class="kt-widget__footer">' +
									'<a href="'+url+'" class="btn btn-bold btn-label-brand btn-sm ">Administrar</a>' +
								'</div>' +
							'</div>' +

						'<!--end::Widget -->' +
					'</div>');
					
	$( "#companies-container" ).prepend( $container );
	
}

//Desbloquear div plugin blockui
function unblockUiContainer(divId, time){
    $(divId).unblock();
    
}

//Mostrar notificaciones utilizando Toastr
function showToastr(message, title, type){

    toastr.options = {
        "title": "Alerta",
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-bottom-full-width",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
        };
        if(type=="success")
            toastr.success(message, title);
        if(type=="error")
            toastr.error(message, title);

}

/*EV*/
function emailValidate(email){

    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

