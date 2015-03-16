/**
 * UserController
 *
 * @description :: Server-side logic for managing users
 * @help        :: See http://links.sailsjs.org/docs/controllers
 */
var passport = require('passport');

module.exports = {
    create: function(req, res){
        var params = req.params.all();
        console.log(params)
        return res.send(200);


//        User.create(params, function(err, user){
//            if (err) return res.send(500, err);
//
//            return res.send(200, user);
//
////            if (sails.config.user.requireUserActivation) {
////                var emailTemplate = res.render('email/email.ejs', {user: user}, function(err, list) {
////                    nodemailer.send({
////                        name:       user.firstName + ' ' + user.lastName,
////                        from:       sails.config.nodemailer.from,
////                        to:         user.email,
////                        subject:       'New Account Acivation Required',
////                        messageHtml: list
////                    }, function(err, response){
////                        sails.log.debug('nodemailer sent', err, response);
////                    });
////                    res.send(200, user);
////                });
////            } else {
////                res.send(200, user);
////            }
//        });
    },

    login: function(req, res){
//        passport.authenticate('local', function(err, user, info){
//            if ((err) || (!user)) return res.send(err);
//
//            req.logIn(user, function(err){
//                if (err) return res.send(err);
//
//                return res.send({ message: 'login successful' });
//            });
//        })(req, res);
        console.log('resr');
        return res.send(200);
    }
};

