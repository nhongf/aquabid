require(['require_config'], function () {
    require(['jquery', 'aqua-com'], function() {
        require(['bootstrapCore'], function() {
            require(['aqua-com-common'], function() {
                AQ_COM.index = new IndexPageControl();
                AQ_COM.index.init();

                function IndexPageControl() {
                    var self = this;

                    this.init = function() {

                    }
                }
            });
        });
    });
});

