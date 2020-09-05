var form = document.getElementById('register-form');



form.addEventListener('submit', function(e){

	e.preventDefault();
	
	
	var formData = new FormData(form)
	console.log(formData)
	
	
	
	var btnSubmit = document.getElementById('btn-submit')
	btnSubmit.classList.add('disabled')
	btnSubmit.classList.add('kt-spinner')
	btnSubmit.classList.add('kt-spinner--right')
	btnSubmit.classList.add('kt-spinner--sm')
	btnSubmit.classList.add('kt-spinner--light')
	
	
	
	/*
	var elements = Array.from(form.elements)
	
	console.log(elements)
	
	
	data.forEach(function(element){
	  console.log(element)
	});
	
	let url= form.action
	
	
	/*var data = e.formData;
	console.log(data)
	
	
	 for (var value of data.values()) {
		console.log(value);
	  }
		*/
    var url= form.getAttribute("action")
	
	var method = 'POST';
	var data = {};
	var count = 0;
	/*formData.forEach(function(value, key){
		//data[key] = value
		count++
		
		//Validar que venga productDetails que es un summernote con html
		if(key == 'productDetails'){
			formData.append('productDetails', $('#productDetails').summernote('code'));
			console.log(value)
		}
	});*/
	
	if (formData.has('productDetails')){
		 formData.delete("productDetails")
		 formData.append('productDetails', $('#productDetails').summernote('code'));
	}
	
	
	
	
	
	//console.log(formData)

	
	fetch(url, {
	  
	  method: method, // or 'PUT'
	  body: formData, // JSON.stringify(data can be `string` or {object}!
	  headers: {
		//"Content-Type": "application/json",
        "Accept": "application/json",
        "X-Requested-With": "XMLHttpRequest",
        "X-CSRF-Token": $('meta[name="csrf-token"]').attr('content')
       
	  },
	})
	.then(function(response){
			return response.json()
	})
	.catch(error => console.log('Error:', error))
	.then(function(response){
		console.log(formData.get('registerFrom'))
		if(response.success == true ){
				
			setTimeout(
				
				
				showToastr(response.message, "Mensaje", "success")
			,2000);

			//form.reset();
			
			//console.log(data)
			
			
			if(formData.get('reloadTable') && formData.get('reloadTable') == 1){
				
				var table = $('#' + formData.get('tableId')).KTDatatable();
				console.log(table)
				table.reload( null, false );
				
			}
			
			if(formData.get('registerFrom')=='modal-form'){
			
				closeCustomModal(formData.get('modalName'))
			}
		}
		else{
			showToastr(data.message, "Error", "error")
		}
		btnSubmit.classList.remove('disabled')
		btnSubmit.classList.remove('kt-spinner')
		btnSubmit.classList.remove('kt-spinner--right')
		btnSubmit.classList.remove('kt-spinner--sm')
		btnSubmit.classList.remove('kt-spinner--light')

	});


	

});
