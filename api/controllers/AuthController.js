/**
 * AuthController.js
 *
 * @description ::
 * @docs        :: http://sailsjs.org/#!documentation/controllers
 */
var passport = require('passport');

module.exports = {
    login: function(req, res){
        passport.authenticate('local', function(err, user, info){
            if (err) return res.badRequest(err);
            if (!user) return res.badRequest({error: 'Wrong username or password'});
            if (user.status != 'active') return res.badRequest({error: 'User is not activated!'});

            req.logIn(user, function(err){
                if (err) return res.badRequest(err);
                return res.ok({
                    success: 1,
                    data: user
                });
            });
        })(req, res);
    },

    logout: function (req,res){
        req.logout();
        res.ok({
            success: 1
        });
    }
}
