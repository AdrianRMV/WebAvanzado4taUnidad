const express = require('express');
const app = express();
const fileUpload = require('express-fileupload');
const cors = require('cors');

app.use(fileUpload());
app.use(cors());
app.use(express.json());

app.get('/', (req, res) => {
    res.send('Hello World!');
});


app.post('/upload', (req, res) => {
    let image = req.files.file;
    let path = __dirname +'\\images\\';
    console.log(path);
    image.mv(path + image.name, function (err){
        if(err){
            console.log("La imagen no pudo subirse")
            console.log(err)
        }else{
            console.log("La imagen se guardo con exito")
        }
    })
    res.send(`Archivo ${image.name} subido correctamente al servidor`);
});

app.listen(3000, () => {
    console.log("Server working in 3000")
})