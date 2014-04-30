$(document).ready(function() {
    $("[data-toggle='tooltip']").tooltip();
    
    $("[datepicker]").datepicker({
        'format': 'yyyy-mm-dd'
    });

    $('.editor').wysihtml5();

    $("[data-loading-text]").click(function() {
        var $btn = $(this);
        $btn.button('loading');
    });
});