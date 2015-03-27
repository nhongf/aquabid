/**
* User.js
*
* @description :: TODO: You might write a short summary of how this model works and what it represents here.
* @docs        :: http://sailsjs.org/#!documentation/models
*/

module.exports = {
    attributes: {

        username: {
            type: 'string',
            required: true,
            unique: true
        },
        password: {
            type: 'string',
            required: true
        },
        email: {
            type: 'email',
            required: true
        },
        address: {
            type: 'string',
            required: true
        },
        phoneNumber: {
            type: 'string',
            required: true
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
        status: {
            type: 'string',
            enum: ['pending', 'active', 'disabled'],
            defaultsTo: 'pending'
        },
        type: {
            type: 'string',
            enum: ['user', 'admin'],
            required: true,
            defaultsTo: 'user'
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

            // return the new object without password
            return obj;
        }
    },

    beforeCreate: function(user, callback) {
        crypto.generate({saltComplexity: 10}, user.password, function(err, hash){
            if (err) return callback(err);

            user.password = hash;
            user.type = 'user';
            user.status = 'pending';
            return callback(null, user);
        });
    }
};

