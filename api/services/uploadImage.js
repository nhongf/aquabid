var cloudinary = require('cloudinary');

cloudinary.config({
    cloud_name: 'dx9ohb1lc',
    api_key: '598641661619659',
    api_secret: 'oMFC-C0eVNGOOkjO8Coy2YyUAKw'
});

module.exports = {
    upload: function(req, callback) {
        cloudinary.uploader.upload(req.files.uploadImage.path, function(result) {
            console.log(result);
        });
    }
};