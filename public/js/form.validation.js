


let inputControls = document.querySelectorAll(".required");

for(let i=0; i<inputControls.length; i++){
	
	inputControls[i].addEventListener("blur", controlFocus);
	inputControls[i].addEventListener("focus", controlLeave);
}

function controlFocus(){

	console.log(this.value);

}	

function controlLeave(){
	console.log(this.value);
}




/*
*
*
* VALIDAR LOS CAMPOS QUE ESTAN DENTRO DE UN ELEMENTO
*
*/

function fieldsValidation(parentElement){

	 //current_fs.find('input').each(function(){
	$(parentElement.find('input, select')).each(function(){

		//Check if required
		if(!$(this).prop('required')){
			
		} else {

			//console.log($(this).attr('minlength'));

			if( !$(this).val().trim() /*&& com$(this).length > 100*/ ){

				
				$(this).addClass('required')
				$(this).focus()

				required = 1;
				return false;
			}
			else{
				$(this).removeClass('required')
			}

			if($(this).attr('type') == 'email'){
				
				if(!emailValidation($(this).val())){
					$(this).addClass('required')
					$(this).focus()
					required = 1;
					return false; 
				}
				

			}

			if($(this).attr('type') == 'phone'){
				if(!$.isNumeric($(this).val())) { 
					$(this).addClass('required')
					$(this).focus()
					required = 1;
					return false; 
				}
			}

			if($(this).attr('id') == 'passwordConfirm'){

				if($(this).val() != $("#password").val()){
					$(this).addClass('required')
					$("#password").addClass('required')
					$(this).focus()

					required = 1;
					return false; 
				}
				else{
					$(this).removeClass('required')
					$("#password").removeClass('required')
				}
			}
			
			

		}
	});
	
	
	return required;
	
}









/* Validar tipo campo*/

function emailValidation(email){
	var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	
	return regex.test(email);
	
}


/* Validar numeros */

