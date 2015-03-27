/**
 * HomeController
 *
 * @description :: Server-side logic for managing Homes
 * @help        :: See http://links.sailsjs.org/docs/controllers
 */

module.exports = {
    index: function(req, res) {
        return res.view('index', {
            currentUser: req.user ? req.user.toJSON() : null,
            bidCategory: sails.config.globals.BID_CATEGORY,
            bidCategoryDisplay: sails.config.globals.BID_CATEGORY_DISPLAY
        });
    }
};

