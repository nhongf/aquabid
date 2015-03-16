/**
 * AuthController.js
 *
 * @description ::
 * @docs        :: http://sailsjs.org/#!documentation/controllers
 */
module.exports = {
    login: function(req, res){
        console.log('resr');
        return res.send(200);
    },
    logout: function (req,res){
        req.logout();
        res.send('logout successful');
    }
}
