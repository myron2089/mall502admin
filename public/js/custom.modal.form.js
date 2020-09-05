var closeButtons = document.querySelectorAll('.btn-close-custom-modal')

var modalLaunchButton = document.querySelectorAll('.btn-show-modal')


modalLaunchButton.forEach(function(btn){
	
	
	
	btn.addEventListener('click', function(){
		//console.log(this);
		let modalId = this.getAttribute('data-target')
		
		var body = document.body;
		
		let actionId = this.getAttribute('data-action')
		//console.log(modalId);
		
		let modal = document.querySelector('#' + modalId)
		//console.log(modal)
		
		document.getElementById('action').value = actionId;
		
		
		//Show image container when modal product
		/*if(modalId=='modal-product-form'){
			document.getElementById('product-image-container').classList.remove('hidden')
		}*/
		
		//Find form and reset it
		var thisform = document.querySelector('.kt-form')
		thisform.reset();
		
		modal.classList.add("show");
		
		body.classList.add("modal-open");
		
		
		
		
		//console.log(modalId)
		
	}, false)
	
});



/*
document.querySelector('.btn-show-modal').addEventListener('click', function () {
	//console.log(this);
	let modalId = this.getAttribute('data-target')
	//console.log(modalId);
	
	let modal = document.querySelector('#' + modalId)
	console.log(modal)
	
	modal.classList.add("show");
	
	
	console.log(modalId)
  
  
}, false);
*/


closeButtons.forEach(function(btn){
	btn.addEventListener('click', function(){
	
	
	let modalId = this.getAttribute('data-target')
	
	
	
	closeCustomModal(modalId)
	
	
	
}, false)
});
/*
closeButtons.forEach(addEventListener('click', function(){
	console.log("sdfds");
	
	let modalId = this.getAttribute('data-target')
	
	
	
	closeCustomModal(modalId)
	
	
	
}, false));
*/


//Show





//Close modal
function closeCustomModal(modalId){
	
	//console.log(modalId)
	
	let modal = document.querySelector('#' + modalId)
	
	modal.classList.remove('show')
	document.body.classList.remove("modal-open");
	
}





