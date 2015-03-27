require(['require_config'], function() {
    require(['jquery', 'aqua-com'], function() {
        require(['bootstrapCore'], function() {
            require(['controllers/authController'], function () {
                AQ_COM.common = new CommonPageControl();
                AQ_COM.common.init();

                function CommonPageControl() {
                    var self = this;

                    this.init = function () {
                        self.authController = new AQ_COM.controllers.AuthController();
                        self.authController.init();

                        $('#btn-addNewBid').click(function() {
                            window.location.href = '/newBid';
                        });
                    }
                }
            });
        });
    });
});
