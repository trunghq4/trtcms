$("#datatable").DataTable({
	"paging":   false,
	"ordering": false,
	"info":     false,
	"searching": true,
	autoFill: true,
});
$('#datatable-btn').DataTable({
	"paging":   false,
	"ordering": false,
	"info":     false,
	dom: 'Bfrtip',
	buttons: [
	{
		extend: "csv",
		className: "btn-sm"
	},
	{
		extend: "excel",
		className: "btn-sm"
	},
	{
		extend: "print",
		className: "btn-sm"
	},
	]
});
$(document).ready(function(){
	$("#fileUpload").on('change', function () {
	    //Get count of selected files
	    var countFiles = $(this)[0].files.length;
	    var imgPath = $(this)[0].value;
	    var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
	    var image_holder = $("#image-holder");
	    image_holder.empty();
	    if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
	    	if (typeof (FileReader) != "undefined") {
	            //loop for each file selected for uploaded.
	            for (var i = 0; i < countFiles; i++) {
	            	var reader = new FileReader();
	            	reader.onload = function (e) {
	            		$('<img src="'+e.target.result+'" class="img-thumbnail img-responsive" />').appendTo(image_holder);
	            	}
	            	image_holder.show();
	            	reader.readAsDataURL($(this)[0].files[i]);
	            }
	        }else{
	        	alert("This browser does not support FileReader.");
	        }
	    }else{
	    	alert("Please select only images");
	    }
	});
	$("#fileUpload2").on('change', function () {
	    //Get count of selected files
	    var countFiles = $(this)[0].files.length;
	    var imgPath = $(this)[0].value;
	    var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
	    var image_holder = $("#image-holder2");
	    image_holder.empty();
	    if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
	    	if (typeof (FileReader) != "undefined") {
	            //loop for each file selected for uploaded.
	            for (var i = 0; i < countFiles; i++) {
	            	var reader = new FileReader();
	            	reader.onload = function (e) {
	            		$('<img src="'+e.target.result+'" class="img-thumbnail img-responsive" />').appendTo(image_holder);
	            	}
	            	image_holder.show();
	            	reader.readAsDataURL($(this)[0].files[i]);
	            }
	        }else{
	        	alert("This browser does not support FileReader.");
	        }
	    }else{
	    	alert("Please select only images");
	    }
	});
	$("#fileUpload3").on('change', function () {
	    //Get count of selected files
	    var countFiles = $(this)[0].files.length;
	    var imgPath = $(this)[0].value;
	    var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
	    var image_holder = $("#image-holder3");
	    image_holder.empty();
	    if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
	    	if (typeof (FileReader) != "undefined") {
	            //loop for each file selected for uploaded.
	            for (var i = 0; i < countFiles; i++) {
	            	var reader = new FileReader();
	            	reader.onload = function (e) {
	            		$('<img src="'+e.target.result+'" class="img-thumbnail img-responsive" />').appendTo(image_holder);
	            	}
	            	image_holder.show();
	            	reader.readAsDataURL($(this)[0].files[i]);
	            }
	        }else{
	        	alert("This browser does not support FileReader.");
	        }
	    }else{
	    	alert("Please select only images");
	    }
	});
})