function isNumberKey(txt, evt) {
	  var charCode = (evt.which) ? evt.which : evt.keyCode;
	  if (charCode == 46) {
		//Check if the text already contains the . character
		if (txt.value.indexOf('.') === -1) {
		  return true;
		} else {
		  return false;
		}
	  } else {
		if (charCode > 31 &&
		  (charCode < 48 || charCode > 57))
		  return false;
	  }
	  return true;
 }
 
 function isIntKey(txt, evt){
	 var charCode = (evt.which) ? evt.which : evt.keyCode;
	
	 if(charCode >= 48 && charCode <= 57){
		return true
	 }
	 return false
 }  
 
 



