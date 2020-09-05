class Cookie  {
  tld= true; // if true, set cookie domain at top level domain
   set = function(name, value, exMins) {
    var d = new Date();
    d.setTime(d.getTime() + (exMins*60*1000));
    var expires = "expires="+d.toUTCString();  
    document.cookie = name + "=" + value + ";" + expires + ";path=/";
	console.log(name + " " + value)
    return this.get(name);
  }

   getAll = function() {
    let cookie = {};
    document.cookie.split(';').forEach( el => {
      let [k,v] = el.split('=');
      cookie[k.trim()] = v;
    })
    return cookie;
  }

   get = function(name) {
    return this.getAll()[name];
  }

    delete = function(name) {
	document.cookie =  name + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
    //this.set(name, 'false', 0);
	//console.log(this.get(name))
	
	//console.log(this.getAll())
  }

};