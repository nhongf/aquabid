/**
 * BidController
 *
 * @description :: Server-side logic for managing bids
 * @help        :: See http://links.sailsjs.org/docs/controllers
 */

module.exports = {
    newBid: function(req, res) {
        return res.view('newBid', {
            currentUser: req.user.toJSON()
        });
    }
};

