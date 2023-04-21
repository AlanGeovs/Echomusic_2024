$(document).ready(function(){
	$('#changeBandPhoto').on('click', function(e){
        $('#editBandModal').modal({show:true});
    });
	$('#bandImage').on('change', function()	{
		$("#previewBandPhoto").html('');
		$("#previewBandPhoto").html("<div class='spinner-border' role='status'></div>");
		$("#saveBandPhoto").prop("disabled", true);
		$("#cropBandMemberImage").ajaxForm(
		{
		target: '#previewBandPhoto',
		success:    function() {
				$('img#photoPResize').imgAreaSelect({
				aspectRatio: '1:1',
				x1: 50, y1: 50, x2: 210, y2: 170, w1:160, h1:120,
				onSelectEnd: getSizes
			});
			$('#imageName').val($('#photoPResize').attr('file-name'));
			$("#saveBandPhoto").prop("disabled", false);
			}
		}).submit();

	});
	$('#saveBandPhoto').on('click', function(e){
    e.preventDefault();
    params = {
            targetUrl: 'resources/change_photoBand.php?action=save',
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
			$('#hdn-thumb-width-2').val(thumb_width);
			$('#hdn-thumb-height-2').val(thumb_height);
			$('#hdn-thumb-width-b').val(thumb_width);
			$('#hdn-thumb-height-b').val(thumb_height);
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
				fname: $('#first_name_member').val(),
				lname: $('#last_name_member').val(),
				instrument: $('#instrument_member').val(),
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
					$('#editBandModal').modal('hide');
					$(".imgareaselect-border1,.imgareaselect-border2,.imgareaselect-border3,.imgareaselect-border4,.imgareaselect-border2,.imgareaselect-outer").css('display', 'none');
					console.log(response);
					// $("#profileCover").attr('src', response);
					// $("#profileCover").css("background-image", response);
					if(response=='success'){
						window.location.href=window.location.href;
					}else if(response=='danger'){
						alert('Ha sucedido un error, por favor vuelve a intentarlo.');
					}

			},
			error: function (xhr, ajaxOptions, thrownError) {
				alert('status Code:' + xhr.status + 'Error Message :' + thrownError);
			}
		});
    }
});
