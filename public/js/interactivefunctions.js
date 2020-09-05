
/* begin::preloader */
$(window).load(function() {
	// Animate loader off screen
	$(".loader-container").fadeOut("slow");
});
/* End::preloader*/


//mostrar loading 
$(".form-loading-animation").submit(function( event ){
	
	var $btnc = $('#btn-post');
	
	$btnc.button('loading');	
	$(".loader-container").fadeIn(500);
});


function loadPicture(event){
var selectedFile = event.target.files[0];
	//var inputLength = $("#companyLogo").size();

    if(selectedFile){
    	//$('#pictureChanged').val(1);
    	
    	$('.custom-file-upload').css('background', 'url('+ window.URL.createObjectURL(selectedFile) +') center center no-repeat');
    	 $('.custom-file-upload').css('background-size', '100% auto');
    }
    else{
    	$('#pictureChanged').val(0);	
    	$('.custom-file-upload').css('background', 'url(../../theme-admin/img/icons/companyAvatar.png) center center no-repeat');
    	$('.custom-file-upload').css('background-size', '100% auto');
    }

    if(!selectedFile){
    	$('.custom-file-upload').css('background', 'url(../../theme-admin/img/icons/companyAvatar.png) center center no-repeat');
    	$('.custom-file-upload').css('background-size', '100% auto');
    }
	
}

//Change state by country_id

let dropdownCountry = document.getElementById('country');

if(dropdownCountry){
	dropdownCountry.addEventListener('change', updateStates);
}

function updateStates(e){

	let id = e.target.value;

	let dropdown = document.getElementById('state');
	dropdown.length = 0;

	let defaultOption = document.createElement('option');
	defaultOption.text = "@lang('base.lbl_state')";

	dropdown.add(defaultOption);
	dropdown.selectedIndex = 0;

	const url = 'states/getStateByCountryId/' + id;

	fetch(url)  
	  .then(  
		function(response) {  
		  if (response.status !== 200) {  
			console.warn('Looks like there was a problem. Status Code:'+
			  response.status);  
			return;  
		  }

		  // Examine the text in the response  
		  response.json().then(function(data) {  
			let option;
		
			for (let i = 0; i < data.length; i++) {
			  option = document.createElement('option');
			  option.text = data[i].statename;
			  option.value = data[i].id;
			  dropdown.add(option);
			}    
		  });  
		}  
	  )  
	  .catch(function(err) {  
		console.error('Fetch Error -', err);  
	  });
}







	//Load page with cookie
	var cookie = new Cookie();
	var load = cookie.get('loadContent')
	
	if (load=="true")
	{
		console.log('loading...')
		cookie.delete("loadContent")
		location.reload();
		
	}

	