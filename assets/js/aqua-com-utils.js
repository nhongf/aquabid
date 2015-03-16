AQ_COM.utils = {
    validateUsername: function(username, callback) {
        var errorMessage = "";
        var isValid = true;

        if (/\s/g.test(username)) {
            errorMessage = 'Username must not contain white space!';
            isValid = false;
        } else if (username.length < 6) {
            errorMessage = 'Username must be at least 6 characters in length.';
            isValid = false;
        }
        callback(isValid, errorMessage);
    },

    validatePassword: function(password, callback) {
        var errorMessage = "";
        var isValid = true;

        if (password.length < 6) {
            errorMessage = 'Password must contain at least six characters!';
            isValid = false;
        }
        var re = /[0-9]/;
        if (isValid && !re.test(password)) {
            errorMessage = 'Password must contain at least one number (0-9)!';
            isValid = false;
        }
        callback(isValid, errorMessage);
    },

    validateEmail: function(email, callback) {
        var errorMessage = "";
        var isValid = true;
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

        if (!re.test(email)) {
            isValid = false;
            errorMessage = 'Invalid email';
        }

        callback(isValid, errorMessage);
    },

    ajaxWrapper: function(options) {
        var self = this;

        var settings = {
            url: AQ_COM.global.API_PATH + options.url,
            type: options.type,
            dataType: "json",
            data: options.data,
            success: function(response, textStatus, data) {
                if (options.success) {
                    options.success(response);
                }
            },
            error: function(xhr, data, err) {
                console.log(data);
                console.log(err);

                if (options.error) {
                    options.error();
                }
            }
        }

        if (options.contentType) {
            settings.contentType = options.contentType;
        }

        if (options.isUploadFile) {
            settings.cache = false;
            settings.contentType = false;
            settings.processData = false;
        }

        jQuery.ajax(settings);
    },

    escapeHtml: function(srcString) {
        var entityMap = {
            "&": "&amp;",
            "<": "&lt;",
            ">": "&gt;",
            '"': '&quot;',
            "'": '&#39;',
            "/": '&#x2F;'
        };
        return String(srcString).replace(/[&<>"'\/]/g, function(s) {
            return entityMap[s];
        });
    },

    unescapeHtml: function(srcString) {
        return jQuery('<div/>').html(srcString).text();
    },

    toTitleCase: function(str) {
        return str.toLowerCase().replace(/(?:^|\s)\w/g, function(match) {
            return match.toUpperCase();
        });
    }
}