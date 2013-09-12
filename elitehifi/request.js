http = require('http'); 
jsdom = require("jsdom");

function ls_categories(categories){
  for(i in categories){
    if(typeof(categories[i]) == 'object'){
      title = categories[i].children[0].text; 
      link  = categories[i].children[0].href;
      entry = {title: title, href: link} 
      console.log(entry)
    }
      
  }
}

parser = function(html){
  jsdom.env( html, ["http://code.jquery.com/jquery.js"], function (errors, window) {
      console.log(window.$('.categories')[0]);
    }
  );
}

var options = {
  hostname: 'www.elitehifi.spb.ru',
  port: 80,
  path: '/katalog',
  method: 'GET'
};

arr = []

var req = http.request(options, function(res) {
  arr = []; 
  //console.log('STATUS: ' + res.statusCode);
  //console.log('HEADERS: ' + JSON.stringify(res.headers));
  res.setEncoding('utf8');
  res.on('data', function (chunk) {
    //console.log('BODY: ' + chunk);
    arr.push(chunk); 
  });


  res.on('end', function (chunk) {
    //console.log(arr.join(''));     
    
    parser(arr.join('')); 

  });




});

req.on('error', function(e) {
  console.log('problem with request: ' + e.message);
});

// write data to request body
req.write('data\n');
//req.write('data\n');
req.end();


