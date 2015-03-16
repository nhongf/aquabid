define(['jquery', 'bootstrap-dialog', 'aqua-com-utils'], function($, BootstrapDialog) {
    AQ_COM.controllers.AuthController = function () {

    };

    AQ_COM.controllers.AuthController.prototype.init = function() {
        this.signInBtn = $('#btn-signin');
        this.signOutBtn = $('#btn-logout');
        this.forgotPasswordBtn = $('#btn-forgotPassword');
        this.registerBtn = $('#btn-register');

        this.bindEvent();
    }

    AQ_COM.controllers.AuthController.prototype.bindEvent = function() {
        var self = this;

        this.signInBtn.click(function() {
            self.signIn();
        });

        this.signOutBtn.click(function() {
            window.location.assign("/logout");
        });

        this.forgotPasswordBtn.click(function() {
            self.forgotPassword();
        });

        this.registerBtn.click(function() {
            self.register();
        });
    }

    AQ_COM.controllers.AuthController.prototype.signIn = function() {
        BootstrapDialog.show({
            title: 'Log in',
            message: $('<div class="form-group"><input type="text" class="form-control tv-h-43" id="signin-username" placeholder="Username"></div>' +
                '<div class="form-group"><input type="password" class="form-control tv-h-43" id="signin-password" placeholder="Password"></div></div>'),
            buttons: [{
                label: 'OK',
                action: function(dialog) {
                    var username = dialog.getModalBody().find('#signin-username').val();
                    var password = dialog.getModalBody().find('#signin-password').val();

                    AQ_COM.utils.ajaxWrapper({
                        type: "POST",
                        url: "/login",
                        data: {
                            password: password,
                            username: username
                        },
                        success: function(data) {
                            dialog.close();

                            if (data.value == 'advertiser') {
                                window.location.assign("/advertisers");
                            } else if (data.value == 'developer') {
                                window.location.assign("/games");
                            } else if (data.value == 'administrator') {
                                window.location.assign("/admin");
                            }
                        },
                        error: function(data) {

                        }
                    });
                }
            }, {
                label: 'Cancel',
                action: function(dialog) {
                    dialog.close();
                }
            }]
        });
    }

    AQ_COM.controllers.AuthController.prototype.validate = function(type, data, $target, notValidCallback, validCallback) {
        var validateCallback = function(isValid, errorMessage) {
            if (!isValid) {
                notValidCallback(errorMessage, $target);
            } else {
                validCallback();
            }
        }

        if (type == 'username') {
            AQ_COM.utils.validateUsername(data, validateCallback);
        } else if (type == 'password') {
            AQ_COM.utils.validatePassword(data, validateCallback);
        } else if (type == 'email') {
            AQ_COM.utils.validateEmail(data, validateCallback);
        }
    }

    AQ_COM.controllers.AuthController.prototype.register = function() {
        var self = this;

        BootstrapDialog.show({
            title: 'Register',
            message: $('<div class="alert alert-danger hidden" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span> <span class="errorMessage"></span></div><div class="row">' +
                '<div class="col-xs-6"><div class="form-group"><input type="text" class="form-control" id="username" placeholder="Username"></div></div>' +
                '<div class="col-xs-6"><div class="form-group"><input type="password" class="form-control" id="password" placeholder="Password"></div></div></div>' +
                '<div class="row">' +
                '<div class="col-xs-6"><div class="form-group"><input type="email" class="form-control" id="email" placeholder="Email"></div></div>' +
                '<div class="col-xs-6"><div class="form-group"><input type="text" class="form-control" id="phoneNumber" placeholder="Phone Number"></div></div></div>'),
            buttons: [{
                label: 'OK',
                action: function(dialog) {
                    dialog.getModalBody().find('.form-group').removeClass('has-error');
                    var $username = dialog.getModalBody().find('#username');
                    var $password = dialog.getModalBody().find('#password');
                    var $email = dialog.getModalBody().find('#email');

                    var $errorMessage = dialog.getModalBody().find('.errorMessage');
                    var $alert = dialog.getModalBody().find('.alert');
                    $alert.addClass('hidden');

                    var username = $username.val();
                    var password = $password.val();
                    var email = $email.val();

                    var isNotValidCallback = function(errorMessage, $errorTarget) {
                        $errorMessage.html(errorMessage);
                        $alert.removeClass('hidden');
                        if ($errorTarget) {
                            $errorTarget.parent().addClass("has-error");
                        }
                    }

                    self.validate('username', username, $username, isNotValidCallback, function() {
                        self.validate('password', password, $password, isNotValidCallback, function() {
                            self.validate('email', email, $email, isNotValidCallback, function() {
                                AQ_COM.utils.ajaxWrapper({
                                    type: "POST",
                                    url: "/users",
                                    data: {
                                        "username": username,
                                        "password": password,
                                        "email": email
                                    },
                                    success: function(data) {
                                        alert('Registration successful, please check your email to verify your account.');

                                        dialog.close();
                                    },
                                    error: function(data) {
                                        if (data) {
                                            var errorMessage = '';
                                            for (var i in data.data) {
                                                errorMessage += data.data[i] + '\n';
                                            }
                                            $errorMessage.html(errorMessage);
                                            $alert.removeClass('hidden');
                                        }
                                    }
                                });
                            });
                        });
                    });
                }
            }, {
                label: 'Cancel',
                action: function(dialog) {
                    dialog.close();
                }
            }]
        });
    }

    AQ_COM.controllers.AuthController.prototype.forgotPassword = function() {
        BootstrapDialog.show({
            title: 'Forgot Password',
            message: $('<div class="form-group"><input type="email" class="form-control tv-h-43" id="forgot-email" placeholder="Email"></div>'),
            buttons: [{
                label: 'OK',
                action: function(dialog) {
                    var email = dialog.getModalBody().find('#forgot-email').val();

                    TV_COM.utils.ajaxWrapper({
                        type: "POST",
                        contentType: "application/json",
                        dataType: "json",
                        url: "/users/forgetPassword",
                        data: JSON.stringify({
                            email: email
                        }),
                        success: function(data) {
                            alert(data.value);
                            dialog.close();
                        },
                        error: function(data) {
                            alert(data.message);
                        }
                    });
                }
            }, {
                label: 'Cancel',
                action: function(dialog) {
                    dialog.close();
                }
            }]
        });
    }

    return AQ_COM.controllers.AuthController;
});