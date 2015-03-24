require(['require_config'], function () {
    require(['jquery', 'aqua-com'], function() {
        require(['bootstrapCore'], function() {
            AQ_COM.adminUsers = new AdminUsersPageControl();
            AQ_COM.adminUsers.init();

            function AdminUsersPageControl() {
                var self = this;

                this.init = function() {
                    var currentPage = parseInt($('#currentPage').val());

                    $('#btn-prev').click(function() {
                        var prevPage = currentPage - 1;
                        window.location.search = 'page=' + prevPage;
                    });

                    $('#btn-next').click(function() {
                        var nextPage = currentPage + 1;
                        window.location.search = 'page=' + nextPage;
                    });
                }
            }
        });
    });
});

