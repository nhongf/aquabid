/**
 * UserController
 *
 * @description :: Server-side logic for managing users
 * @help        :: See http://links.sailsjs.org/docs/controllers
 */

module.exports = {
    create: function(req, res){
        var params = req.params.all();

        var srcFilePath = './assets/images/default/' + params.socialScreenshot;
        var desFilePath = './assets/images/socialScreenshot/' + params.socialScreenshot;
        console.log(srcFilePath);

        utils.moveFile(srcFilePath, desFilePath, function() {
            User.create(params, function(err, user){
                if (err) return res.badRequest(err);

                return res.ok({
                    success: 1,
                    data: user
                });
            });
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
    },

    profile: function(req, res) {
        User.findOne({
            id: req.session.passport.user
        }, function(err, user) {
            return res.view('profile', {
                currentUser: req.user ? req.user.toJSON() : null
            });
        });
    },

    updateUser: function(req, res) {
        var params = req.params.all();

        var updateInfo = {};
        if (params.address) {
            updateInfo.address = params.address;
        }
        if (params.phoneNumber) {
            updateInfo.phoneNumber = params.phoneNumber;
        }

        User.update({
            id: params.user_id
        }, updateInfo, function(err, user) {
            if (err) return res.badRequest(err);

            res.ok({
                success: 1
            });
        });
    }
};

