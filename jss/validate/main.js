$(document).on("pageshow", "#registerPage", function() {


	$.validator.addMethod("passmatch", function(value) {
			return value == $("#password").val();
	}, 'Confirmation password must match.');

	$("#registerForm").validate({

		errorPlacement: function(error, element) {
			if (element.attr("name") === "favcolor") {
				error.insertAfter($("#favcolor").parent());
			} else {
				error.insertAfter(element);
			}
		}

	});

});

$(document).on("pageshow", "#registerPage", function() {


	$.validator.addMethod("passmatch", function(value) {
			return value == $("#password").val();
	}, 'Confirmation password must match.');

	$("#registerForm1").validate({

		errorPlacement: function(error, element) {
			if (element.attr("name") === "favcolor") {
				error.insertAfter($("#favcolor").parent());
			} else {
				error.insertAfter(element);
			}
		}

	});

});