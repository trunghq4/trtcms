CKEDITOR.editorConfig = function( config ) {
   config.filebrowserBrowseUrl = '/noithat/public/ckfinder/ckfinder.html';
   config.filebrowserImageBrowseUrl = '/noithat/public/ckfinder/ckfinder.html?type=Images';
   config.filebrowserFlashBrowseUrl = '/noithat/public/ckfinder/ckfinder.html?type=Flash';
   config.filebrowserUploadUrl = '/noithat/public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
   config.filebrowserImageUploadUrl = '/noithat/public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
   config.filebrowserFlashUploadUrl = '/noithat/public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
   config.allowedContent = true;
	config.extraPlugins = 'youtube';
};
var editor = CKEDITOR.replace( 'editor1' );
CKFinder.setupCKEditor( editor, '/ckfinder/' );
config.extraPlugins = 'youtube';
config.toolbar = [{ name: 'insert', items: ['Image', 'Youtube']}];