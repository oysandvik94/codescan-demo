const express = require('express'); 
const xssFilters = require('xss-filters'); 
const util = require('util');  
const app = express();  
app.get('/', (req, res) => {   const unsafeFirstname = req.query.firstname;   
const safeFirstname = xssFilters.inHTMLData(unsafeFirstname);    
res.send(util.format('<h1>Tom%s</h1>', safeFirstname)); });  

let html = document.getElementById("myP").innerHTML; 
document.write(html);

var obj =  new Function("return " + data)();  // Noncompliant

var userCookie = document.cookie["access_token"];
console.log(userCookie);

// vuln-code-snippet start localXssChallenge xssBonusChallenge
filterTable () {
    let queryParam: string = this.route.snapshot.queryParams.q
    if (queryParam) {
      queryParam = queryParam.trim()
      this.ngZone.runOutsideAngular(() => { // vuln-code-snippet hide-start
        this.io.socket().emit('verifyLocalXssChallenge', queryParam)
      }) // vuln-code-snippet hide-end
      this.dataSource.filter = queryParam.toLowerCase()
      this.searchValue = this.sanitizer.bypassSecurityTrustHtml(queryParam) // vuln-code-snippet vuln-line localXssChallenge xssBonusChallenge
      this.gridDataSource.subscribe((result: any) => {
        if (result.length === 0) {
          this.emptyState = true
        } else {
          this.emptyState = false
        }
      })
    } else {
      this.dataSource.filter = ''
      this.searchValue = undefined
      this.emptyState = false
    }
    }
    // vuln-code-snippet end localXssChallenge xssBonusChallenge
// vuln-code-snippet start fileWriteChallenge
function handleZipFileUpload ({ file }, res, next) {
    if (utils.endsWith(file.originalname.toLowerCase(), '.zip')) {
      if (file.buffer && !utils.disableOnContainerEnv()) { // vuln-code-snippet hide-line
        const buffer = file.buffer
        const filename = file.originalname.toLowerCase()
        const tempFile = path.join(os.tmpdir(), filename)
        fs.open(tempFile, 'w', function (err, fd) {
          if (err != null) { next(err) }
          fs.write(fd, buffer, 0, buffer.length, null, function (err) {
            if (err != null) { next(err) }
            fs.close(fd, function () {
              fs.createReadStream(tempFile)
                .pipe(unzipper.Parse()) // vuln-code-snippet vuln-line fileWriteChallenge
                .on('entry', function (entry) {
                  const fileName = entry.path
                  const absolutePath = path.resolve('uploads/complaints/' + fileName)
                  utils.solveIf(challenges.fileWriteChallenge, () => { return absolutePath === path.resolve('ftp/legal.md') }) // vuln-code-snippet hide-line
                  if (absolutePath.includes(path.resolve('.'))) {
                    entry.pipe(fs.createWriteStream('uploads/complaints/' + fileName).on('error', function (err) { next(err) })) // vuln-code-snippet vuln-line fileWriteChallenge
                  } else {
                    entry.autodrain()
                  }
                }).on('error', function (err) { next(err) })
            })
          })
        })
      } // vuln-code-snippet hide-line
      res.status(204).end()
    } else {
      next()
    }
  }
  // vuln-code-snippet end fileWriteChallenge


app.listen(3000);

