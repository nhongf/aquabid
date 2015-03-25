define(['jquery', 'bootstrap-dialog', 'aqua-com-utils'], function($, BootstrapDialog) {
    AQ_COM.controllers.AuthController = function () {

    };

    AQ_COM.controllers.AuthController.prototype.init = function() {
        this.signInBtn = $('#btn-signin');
        this.signOutBtn = $('#btn-signout');
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
           self.signOut();
        });

        this.forgotPasswordBtn.click(function() {
            self.forgotPassword();
        });

        this.registerBtn.click(function() {
            self.register();
        });
    }

    AQ_COM.controllers.AuthController.prototype.signOut = function() {
        AQ_COM.utils.ajaxWrapper({
            type: "POST",
            url: "/logout",
            success: function(result) {
                window.location.reload();
            },
            error: function(data) {
                alert(data);
            }
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
                        success: function(result) {
                            if (result.data.type == 'admin') {
                                window.location.assign('/admin');
                            } else {
                                window.location.reload();
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
        } else {
            AQ_COM.utils.validateNotEmpty(data, validateCallback);
        }
    }

    AQ_COM.controllers.AuthController.prototype.register = function() {
        var self = this;

        BootstrapDialog.show({
            title: 'Register',
            message: $('<div class="alert alert-danger hidden" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span> <span class="errorMessage"></span></div>' +
                '<div class="row">' +
                '<div class="col-xs-6"><div class="form-group"><input type="text" class="form-control" id="username" placeholder="Tên đăng nhập" required></div></div>' +
                '<div class="col-xs-6"><div class="form-group"><input type="password" class="form-control" id="password" placeholder="Mật khẩu"></div></div>' +
                '</div>' +
                '<div class="row">' +
                '<div class="col-xs-6"><div class="form-group"><input type="email" class="form-control" id="email" placeholder="Email"></div></div>' +
                '<div class="col-xs-6"><div class="form-group"><input type="text" class="form-control" id="phoneNumber" placeholder="Địa chỉ"></div></div>' +
                '</div>' +
                '<div class="row">' +
                '<div class="col-xs-6"><div class="form-group"><input type="text" class="form-control" id="address" placeholder="Số điện thoại"></div></div>' +
                '<div class="col-xs-6"><div class="form-group"><input type="text" class="form-control" id="socialId" placeholder="Số CMND"></div></div>' +
                '</div>' +
                '<div class="row">' +
                '<div class="col-xs-6"><div class="form-group"><label>Hình CMND:</label><input type="file" id="socialScreenshot"></div></div>' +
                '</div>'),
            buttons: [{
                label: 'OK',
                action: function(dialog) {
                    dialog.getModalBody().find('.form-group').removeClass('has-error');
                    var $username = dialog.getModalBody().find('#username');
                    var $password = dialog.getModalBody().find('#password');
                    var $email = dialog.getModalBody().find('#email');
                    var $phoneNumber = dialog.getModalBody().find('#phoneNumber');
                    var $address = dialog.getModalBody().find('#address');
                    var $socialId = dialog.getModalBody().find('#socialId');
                    var $socialScreenshot = dialog.getModalBody().find('#socialScreenshot');

                    var $errorMessage = dialog.getModalBody().find('.errorMessage');
                    var $alert = dialog.getModalBody().find('.alert');
                    $alert.addClass('hidden');

                    var username = $username.val();
                    var password = $password.val();
                    var email = $email.val();
                    var phoneNumber = $phoneNumber.val();
                    var address = $address.val();
                    var socialId = $socialId.val();

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
                                self.validate('phoneNumber', phoneNumber, $phoneNumber, isNotValidCallback, function() {
                                    self.validate('address', address, $address, isNotValidCallback, function() {
                                        self.validate('socialId', socialId, $socialId, isNotValidCallback, function() {
                                            if (!$socialScreenshot.val()) {
                                                isNotValidCallback('Please upload your social screenshot!', $socialScreenshot);
                                            } else {
                                                var formData = new FormData();
                                                formData.append("photo", $socialScreenshot.prop("files")[0]);

                                                AQ_COM.utils.ajaxWrapper({
                                                    url: '/uploadPhoto',
                                                    type: 'POST',
                                                    isUploadFile: true,
                                                    data: formData,
                                                    success: function(data) {
                                                        var socialScreenshotUrl = data.data.url;

                                                        AQ_COM.utils.ajaxWrapper({
                                                            type: "POST",
                                                            url: "/users",
                                                            data: {
                                                                "username": username,
                                                                "password": password,
                                                                "email": email,
                                                                "phoneNumber": phoneNumber,
                                                                "address": address,
                                                                "socialId": socialId,
                                                                "socialScreenshot": socialScreenshotUrl
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
                                                    },
                                                    error: function() {
                                                        alert("Can't upload image")
                                                    }
                                                });
                                            }
                                        });
                                    });
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