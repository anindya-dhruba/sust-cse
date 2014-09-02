$(document).ready(function() {
    $("[data-toggle='tooltip']").tooltip();
    
    $("[datepicker]").datepicker({
        'format': 'yyyy-mm-dd'
    });

    $("[data-loading-text]").click(function() {
        var $btn = $(this);
        $btn.button('loading');
    });

    CKEDITOR.replace('editor', {
    	filebrowserUploadUrl: "/upload",
    	"extraPlugins": "imagebrowser",
		"imageBrowser_listUrl": "/list"
    });
});