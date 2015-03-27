/**
 * AdminController
 *
 * @description :: Server-side logic for managing Admins
 * @help        :: See http://links.sailsjs.org/docs/controllers
 */
module.exports = {
    index: function(req, res) {
        return res.view('adminIndex', {
            currentUser: req.user.toJSON()
        });
    },

    users: function(req, res) {
        var params = req.params.all();

        var pageIndex = params.page ? params.page : 1;
        pageIndex = parseInt(pageIndex);

        var criteria = {
            where: {type: 'user'},
            skip: (pageIndex - 1)*sails.config.globals.DEFAULT_PAGE_SIZE,
            limit: sails.config.globals.DEFAULT_PAGE_SIZE,
            sort: 'username DESC'
        }

        async.parallel([
            function(callback) {
                User.count({
                    where: {type: 'user'}
                }).exec(function(err, count) {
                    callback(err, count);
                });
            },
            function(callback) {
                User.find(criteria).exec(function(err, users) {
                    callback(err, users);
                });

            }
        ], function(err, results) {
            var count = results[0];
            var users = results[1];

            return res.view('adminUsers', {
                users: users,
                pageIndex: pageIndex,
                pageTotal: Math.ceil(count/sails.config.globals.DEFAULT_PAGE_SIZE),
                currentUser: req.user.toJSON()
            });
        });
    },

    activate: function(req, res) {
        var params = req.params.all();

        User.update({
            id: params.user_id
        }, {
            status: 'active'
        }, function(err, user) {
            user = user[0];

            res.render('email/activatedAccount.ejs', {
                user: user
            }, function(err, content) {
                nodemailer.send({
                    name: 'AquabidVN Support',
                    from: sails.config.nodemailer.from,
                    to: user.email,
                    subject: 'Account Ready To Use',
                    messageHtml: content
                }, function(err, response){
                    sails.log.debug('nodemailer sent', err, response);
                });

                res.ok({
                    success: 1
                });
            });
        });
    }
};

