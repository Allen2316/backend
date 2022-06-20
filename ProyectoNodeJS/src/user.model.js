const mongoose = require("mongoose")

const Users = mongoose.model("User", {
    name: {type: String, require: true},
    lastname: {type: String, require: true}
})

//exportar el modulo
module.exports = Users