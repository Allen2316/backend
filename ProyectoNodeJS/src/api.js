/* importamos express */

const express = require("express")
const mongoose = require("mongoose")
const user = require("./user.handler")

const app = express()
const port = 3000

app.use(express.json())

//cambiar para tener seguridad
mongoose.connect("mongodb://localhost/api-db")


//implementar el handler user
app.get("/api/", user.list)
//rutas 
app.post("/api/", user.create)
app.get("/api/:id", user.get)



app.listen(port, () => {
    console.log(`El ejemplo se esta ejecutando en el puerto ${port}`)
    console.log("Run in: http://localhost:3000/api")
})