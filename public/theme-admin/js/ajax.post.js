//Store Item
function itemStore(data, url){
  var result =
  $.ajax({
      type: "POST",
      url: url,
      data: data,
      
      cache: false,
      contentType: false,
      processData: false,
      beforeSend: blockUiContainer("#m-portlet-blockui","Registrando..."),
     
      error: function(xhr) {
                              
              }

    });

    return result;
}