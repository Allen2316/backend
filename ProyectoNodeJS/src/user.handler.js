const Users = require("./user.model")

const User = {
    //listara los users
    list: async (req, res) => {
        //recuperar todos los usuarios de la BD
        const users = await Users.find()
        res.status(200).send(users)
    },
    //crear en BD
    create: async (req, res) => {
        const user = new Users(req.body)
        const saveUser = await user.save()        
        res.status(201).send(saveUser)
    },
    //obtener user por id
    get: async (req, res) => {
        const { id } = req.params
        //const user = await Users.findOne({_id:id})
        const user2 = await Users.findById(id)        
        res.status(200).send(user2)
    }
}

module.exports = User
