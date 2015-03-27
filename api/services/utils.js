var fs = require('fs');

module.exports = {
    getRandomInt: function(min, max) {
        return Math.floor(Math.random() * (max - min + 1)) + min;
    },

    uid: function(len) {
        var buf = [],
            chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',
            charlen = chars.length;

        for (var i = 0; i < len; ++i) {
            buf.push(chars[exports.getRandomInt(0, charlen - 1)]);
        }

        return buf.join('');
    },

    moveFile: function(srcFilePath, desFilePath, callback) {
        var is = fs.createReadStream(srcFilePath);
        var os = fs.createWriteStream(desFilePath);

        is.pipe(os);
        is.on('end',function() {
            fs.unlink(srcFilePath, function(error) {
                if (error) throw error;

                callback();
            });
        });
    }
}