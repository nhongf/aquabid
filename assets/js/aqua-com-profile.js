require(['require_config'], function () {
    require(['jquery', 'aqua-com'], function() {
        require(['bootstrapCore'], function() {
            require(['aqua-com-common'], function() {
                AQ_COM.index = new IndexPageControl();
                AQ_COM.index.init();

                function IndexPageControl() {
                    var self = this;

                    this.init = function() {
                        $('#btn-editProfile').click(function() {
                            $('#form-profile input.editable').removeAttr('disabled');

                            $('#btn-editProfile').addClass('hidden');
                            $('#btn-saveEditProfile').removeClass('hidden');
                            $('#btn-cancelEditProfile').removeClass('hidden');
                        });

                        $('#btn-cancelEditProfile').click(function() {
                            $('#form-profile input.editable').attr('disabled', 'true');

                            $('#btn-editProfile').removeClass('hidden');
                            $('#btn-saveEditProfile').addClass('hidden');
                            $('#btn-cancelEditProfile').addClass('hidden');
                        });

                        $('#btn-saveEditProfile').click(function() {
                            AQ_COM.utils.ajaxWrapper({
                                type: "PUT",
                                url: "/users/" + $('#userId').val(),
                                data: {
                                    address: $('#address').val(),
                                    phoneNumber: $('#phoneNumber').val()
                                },
                                success: function(result) {
                                    $('#form-profile input.editable').attr('disabled', 'true');

                                    $('#btn-editProfile').removeClass('hidden');
                                    $('#btn-saveEditProfile').addClass('hidden');
                                    $('#btn-cancelEditProfile').addClass('hidden');
                                },
                                error: function(data) {
                                    alert(data);
                                }
                            });
                        });
                    }
                }
            });
        });
    });
});

