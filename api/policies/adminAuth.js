/**
 * sessionAuth
 *
 * @module      :: Policy
 * @description :: Simple policy to allow any authenticated user
 *                 Assumes that your login action in one of your controllers sets `req.session.authenticated = true;`
 * @docs        :: http://sailsjs.org/#!documentation/policies
 *
 */
module.exports = function(req, res, next) {
    // User is allowed, proceed to the next policy,
    // or if this is the last policy, the controller
    if (req.session.passport.user) {
        User.findOne({
            id: req.session.passport.user
        }, function(err, user) {
            console.log(err);
            console.log(user);
            req.params.currentUser = user;
            if (user.type == 'admin') return next();

            return res.forbidden('You are not permitted to perform this action.');
        });
    } else {
        return res.forbidden('You are not permitted to perform this action.');
    }
};
