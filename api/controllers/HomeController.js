/**
 * HomeController
 *
 * @description :: Server-side logic for managing Homes
 * @help        :: See http://links.sailsjs.org/docs/controllers
 */

module.exports = {
    index: function(req, res) {
        return res.view('index', {
            isSignedIn: req.isAuthenticated()
        });
    },

    uploadPhoto: function(req, res) {
        
    }
};

