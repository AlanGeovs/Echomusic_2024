$(document).ready(function(){
	$('#changeCoverPhoto').on('click', function(e){
        $('#changeCoverPhotoModal').modal({show:true});
    });
	$('#coverImage').on('change', function()	{
		$("#previewCoverPhoto").html('');
		$("#previewCoverPhoto").html("<div class='spinner-border' role='status'></div>");
		$("#saveCoverPhoto").prop("disabled", true);
		$("#cropCoverImage").ajaxForm(
		{
		target: '#previewCoverPhoto',
		success:    function() {
					console.log("1");

				$('img#photoPResize').imgAreaSelect({
				aspectRatio: '15:5',
				onSelectEnd: getSizes,
				x1: 50, y1: 50, x2: 210, y2: 170, w1:160, h1:120
			});
					console.log("2");
			$('#imageName').val($('#photoPResize').attr('file-name'));
			$('#saveCoverPhoto').css("display", "inline-block");
			$("#saveCoverPhoto").prop("disabled", false);
			}
		}).submit();

	});
	$('#saveCoverPhoto').on('click', function(e){
    e.preventDefault();

    params = {
            targetUrl: 'resources/change_photoCover.php?action=save',
            action: 'save',
            x_axis: $('#hdn-x1-axis').val(),
            y_axis : $('#hdn-y1-axis').val(),
            x2_axis: $('#hdn-x2-axis').val(),
            y2_axis : $('#hdn-y2-axis').val(),
            thumb_width : $('#hdn-thumb-width').val(),
            thumb_height:$('#hdn-thumb-height').val()
        };
        saveCropImage(params);
    });
    function getSizes(img, obj){
					console.log("3");
        var x_axis = obj.x1;
        var x2_axis = obj.x2;
        var y_axis = obj.y1;
        var y2_axis = obj.y2;
        var thumb_width = obj.width;
        var thumb_height = obj.height;
        if(thumb_width > 0) {
			$('#hdn-x1-axis').val(x_axis);
			$('#hdn-y1-axis').val(y_axis);
			$('#hdn-x2-axis').val(x2_axis);
			$('#hdn-y2-axis').val(y2_axis);
			$('#hdn-thumb-width').val(thumb_width);
			$('#hdn-thumb-height').val(thumb_height);
        } else {
            alert("Por favor selecciona una sección.");
		}
    }
    function saveCropImage(params) {
		$.ajax({
			url: params['targetUrl'],
			cache: false,
			dataType: "html",
			data: {
				action: params['action'],
				id: $('#hdn-profile-id').val(),
				t: 'ajax',
				w1:params['thumb_width'],
				x1:params['x_axis'],
				h1:params['thumb_height'],
				y1:params['y_axis'],
				x2:params['x2_axis'],
				y2:params['y2_axis'],
				imageName :$('#imageName').val()
			},
			type: 'Post',
		   	success: function (response) {
					$('#saveCoverPhoto').css("display", "hidden");
					$('#changeCoverPhotoModal').modal('hide');
					$(".imgareaselect-border1,.imgareaselect-border2,.imgareaselect-border3,.imgareaselect-border4,.imgareaselect-border2,.imgareaselect-outer").css('display', 'none');
					console.log(response);
					// $("#profileCover").attr('src', response);
					$("#profileCover").css("background-image", response);
					$("#previewCoverPhoto").html('');
					$("#coverImage").val();
					$("#changeCoverPhoto").text('Change Photo');
			},
			error: function (xhr, ajaxOptions, thrownError) {
				alert('status Code:' + xhr.status + 'Error Message :' + thrownError);
			}
		});
    }
});
