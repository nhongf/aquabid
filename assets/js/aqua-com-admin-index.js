require(['require_config'], function () {
    require(['jquery', 'aqua-com'], function() {
        require(['bootstrapCore'], function() {
            AQ_COM.adminIndex = new AdminIndexPageControl();
            AQ_COM.adminIndex.init();

            function AdminIndexPageControl() {
                var self = this;

                this.init = function() {

                }
            }
        });
    });
});

