$(document).ready(function(){
	$('#changeProfilePhoto').on('click', function(e){
        $('#changeProfilePhotoModal').modal({show:true});
    });
	$('#profileImage').on('change', function()	{
		$("#previewProfilePhoto").html('');
		$("#previewProfilePhoto").html("<div class='spinner-border' role='status'></div>");
		$("#savePhoto").prop("disabled", true);
		$("#cropImage").ajaxForm(
		{
		target: '#previewProfilePhoto',
		success:    function() {
				console.log("1");

				$('img#photoPResize').imgAreaSelect({
					aspectRatio: '1:1',
					onSelectEnd: getSizes,
					x1: 50, y1: 50, x2: 210, y2: 170, w1:160, h1:120
				});
				$('#imageName').val($('#photoPResize').attr('file-name'));
				$('#savePhoto').css("display", "inline-block");
				$("#savePhoto").prop("disabled", false);


			}
		}).submit();
					console.log("2");

	});
	$('#savePhoto').on('click', function(e){
    e.preventDefault();
    params = {
            targetUrl: 'resources/change_photoAvatar.php?action=save',
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


        var x_axis = obj.x1;
        console.log("x_axis-"+x_axis);
        var x2_axis = obj.x2;
        console.log("x2_axis-"+x2_axis);
        var y_axis = obj.y1;
        console.log("y_axis-"+y_axis);
        var y2_axis = obj.y2;
        console.log("y2_axis-"+y2_axis);
        var thumb_width = obj.width;
        console.log("thumb_width-"+thumb_width);
        var thumb_height = obj.height;
        console.log("thumb_height-"+thumb_height);


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
					if(response=='danger'){
						$('#savePhoto').css("display", "hidden");
						$('#changeProfilePhotoModal').modal('hide');
						$(".imgareaselect-border1,.imgareaselect-border2,.imgareaselect-border3,.imgareaselect-border4,.imgareaselect-border2,.imgareaselect-outer").css('display', 'none');
						alert('Ha sucedido un error con la carga de la imagen, por favor inténtalo nuevamente.');
					}else{
						$('#savePhoto').css("display", "hidden");
						$('#changeProfilePhotoModal').modal('hide');
						$(".imgareaselect-border1,.imgareaselect-border2,.imgareaselect-border3,.imgareaselect-border4,.imgareaselect-border2,.imgareaselect-outer").css('display', 'none');
						console.log(response);
						$("#profilePhoto").attr('src', response);
						$("#previewProfilePhoto").html('');
						$("#profileImage").val();
						$("#changeProfilePhoto").text('Change Photo');
					}
			},
			error: function (xhr, ajaxOptions, thrownError) {
				alert('status Code:' + xhr.status + 'Error Message :' + thrownError);
			}
		});
    }
});
