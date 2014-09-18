$(document).ready(function() {
	$('.summernote').summernote({
		height: 200,
		onImageUpload: function(files, editor, welEditable) {
			sendFile(files[0], editor, welEditable);
		}
	});

	function sendFile(file, editor, welEditable) {
			data = new FormData();
			data.append("summernotefile", file);
			$.ajax({
				data: data,
				type: "POST",
				url: "/upload",
				cache: false,
				contentType: false,
				processData: false,
				success: function(url) {
				editor.insertImage(welEditable, url);
				}
			});
		}
	});