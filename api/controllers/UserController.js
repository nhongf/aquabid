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

        User.create(params, function(err, user){
            if (err) return res.badRequest(err);

            return res.ok({
                success: 1,
                data: user
            });

//            if (sails.config.user.requireUserActivation) {
//                var emailTemplate = res.render('email/email.ejs', {user: user}, function(err, list) {
//                    nodemailer.send({
//                        name:       user.firstName + ' ' + user.lastName,
//                        from:       sails.config.nodemailer.from,
//                        to:         user.email,
//                        subject:       'New Account Acivation Required',
//                        messageHtml: list
//                    }, function(err, response){
//                        sails.log.debug('nodemailer sent', err, response);
//                    });
//                    res.send(200, user);
//                });
//            } else {
//                res.send(200, user);
//            }
        });
    },

    sendActivateEmail: function(req, res) {
        var params = req.params.all();

        User.get({
            id: params.user_id
        }, function(err, user) {
            console.log(err);
            console.log(user);
//            res.render('email/email.ejs', {user: user}, function(err, list) {
//                nodemailer.send({
//                    name:       user.firstName + ' ' + user.lastName,
//                    from:       sails.config.nodemailer.from,
//                    to:         user.email,
//                    subject:       'New Account Acivation Required',
//                    messageHtml: list
//                }, function(err, response){
//                    sails.log.debug('nodemailer sent', err, response);
//                });
//
//                res.send(200, user);
//            });
        });
    },

    uploadPhoto: function(req, res) {
        var uploadFile = req.file('photo');

        if (!uploadFile){
            return res.badRequest();
        }

        uploadFile.upload({
            dirname: '../../assets/images/default'
        }, function onUploadComplete(err, files) {
            if (err) return res.serverError(err);

            var url = files[0].fd.replace(/^.*[\\\/]/, '');

            res.ok({
                success: 1,
                data: {
                    url: url
                }
            });
        });
    }
};

