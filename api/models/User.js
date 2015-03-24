/**
* User.js
*
* @description :: TODO: You might write a short summary of how this model works and what it represents here.
* @docs        :: http://sailsjs.org/#!documentation/models
*/

module.exports = {
    attributes: {
        email: {
            type: 'email',
            required: true
        },
        username: {
            type: 'string',
            required: true,
            unique: true
        },
        password: {
            type: 'string',
            required: true
        },
        status: {
            type: 'string',
            enum: ['pending', 'active', 'disabled'],
            defaultsTo: 'pending'
        },
        activationToken: {
            type: 'string'
        },
        type: {
            type: 'string',
            enum: ['user', 'admin'],
            required: true,
            defaultsTo: 'user'
        },
        socialId: {
            type: 'string',
            required: true,
            unique: true
        },
        socialScreenshot: {
            type: 'string',
            required: true
        },

        /**
         * Strips the password out of the json
         * object before its returned from waterline.
         * @return {object} the model results in object form
         */
        toJSON: function() {
            // this gives you an object with the current values
            var obj = this.toObject();
            delete obj.password;
            delete obj.activationToken;

            // return the new object without password
            return obj;
        }
    },

    beforeCreate: function(user, callback) {
        crypto.generate({saltComplexity: 10}, user.password, function(err, hash){
            if (err) return callback(err);

            user.password = hash;
            user.activated = false; //make sure nobody is creating a user with activate set to true, this is probably just for paranoia sake
            user.activationToken = crypto.token(new Date().getTime() + user.email);
            return callback(null, user);
        });
    }
};

