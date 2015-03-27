require(['require_config'], function () {
    require(['jquery', 'aqua-com'], function() {
        require(['bootstrapCore', 'aqua-com-utils'], function() {
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

                    $('.btn-verify').click(function() {
                        var $this = $(this);
                        var userId = $this.parents('tr').attr('id');

                        AQ_COM.utils.ajaxWrapper({
                            type: "PUT",
                            url: "/admin/users/" + userId,
                            success: function(data) {
                                $this.parent().html('active');
                            },
                            error: function(data) {
                                if (data) {
                                    alert(data);
                                }
                            }
                        });
                    });
                }
            }
        });
    });
});

