const express = require('express'); 
const xssFilters = require('xss-filters'); 
const util = require('util');  
const app = express();  
app.get('/', (req, res) => {   const unsafeFirstname = req.query.firstname;   
const safeFirstname = xssFilters.inHTMLData(unsafeFirstname);    
res.send(util.format('<h1>Tom%s</h1>', safeFirstname)); });  

var obj =  new Function("return " + data)();  // Noncompliant

var userCookie = document.cookie["access_token"];
console.log(userCookie);

app.listen(3000);

