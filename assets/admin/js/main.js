/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


//login validation

$(document).ready(function () {
    $('#login').validate({
        rules: {
            username: {
                required: true
            },
            password: {
                required: true
            }

        },
        message: {
            username: {
                required: 'username cant be empty'
            },
            password: {
                required: 'Password cant be empty'
            }
        },
        highlight: function (element) {
            var id_attr = "#" + $(element).attr("id") + "1";
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            $(id_attr).removeClass('glyphicon-ok').addClass('glyphicon-remove');
        },
        unhighlight: function (element) {
            var id_attr = "#" + $(element).attr("id") + "1";
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
            $(id_attr).removeClass('glyphicon-remove').addClass('glyphicon-ok');
        },
        submitHandler: function (form) {
            $.ajax({
                url: form.action,
                type: form.method,
                dataType: 'json',
                data: $(form).serialize(),
                beforeSend: showRequest,
                success: showResponse
            });
        }
    });


    $('#addCertification').validate({
        rules: {
            certificationNumber: {
                required: true,
                remote: {
                    url: (window.APP_BASE_URL || '/') + 'process/check_dublicate.php',
                }
            },
            companyName: {
                required: true,
                remote: {
                    url: (window.APP_BASE_URL || '/') + 'process/check_dublicate.php',
                }
            }


        },
        highlight: function (element) {
            var id_attr = "#" + $(element).attr("id") + "1";
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            $(id_attr).removeClass('glyphicon-ok').addClass('glyphicon-remove');
        },
        unhighlight: function (element) {
            var id_attr = "#" + $(element).attr("id") + "1";
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
            $(id_attr).removeClass('glyphicon-remove').addClass('glyphicon-ok');
        },
        submitHandler: function (form) {
            $.ajax({
                url: form.action,
                type: form.method,
                dataType: 'json',
                data: $(form).serialize(),
                beforeSend: showRequest,
                success: showResponse
            });
        }
    });
    

    function showRequest(formData, jqForm, options) {
        $("button").prop('disabled', true);
        openWaitDialog('Please Wait');
    }
    function showResponse(response, statusText, xhr, $form) {
        closeDialog();
        if (xhr.status == 200) {
            if (response.status) {
                $("button").remove();
                if (typeof (response.redirect) != 'undefined') {
                    if (response.dialogMsg != 'undefined') {
                        openWaitDialog(response.message);
                    }

                    location.href = response.redirect;
                }
            } else {
                $(".msg").html(
                        '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>OOPS! </strong> ' + response.message + '</div>');
                $("button").prop('disabled', false);
            }
        } else {
            $(".msg").html('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>OOPS! </strong> Server respond with an error.</div>');
            $("button").prop('disabled', false);
            $("#submitFormLoader").hide();
        }
    }



});



//edit box
function editBox(id) {
    $.ajax({
        url: (window.APP_BASE_URL || '/') + 'process/certified-client-edit.php',
        type: 'POST',
        dataType: 'json',
        data: {'id': id,'method':'singleDetail'},
        beforeSend: function () {
            $('input[type="text"], textarea').val('');
            $("#editBox").modal('show');

        },
        success: function (resp) {
            $('.overlay').addClass('hidden');
            if (resp.status) {
                var data = resp.message;
                $('#certificationTitle').html(data.certificationNumber);
                $('#certificationNumber').val(data.certificationNumber);
                $('#companyName').val(data.companyName);
                $('#address').val(data.address);
                $('#scheme').val(data.scheme);
                if(data.accredited==="1"){
                    $('#accredited').prop('checked',true);
                }
                var formattedDate = new Date(data.validTill);
                var d = formattedDate.getDate();
                var m = formattedDate.getMonth();
                m += 1
                var y = formattedDate.getFullYear();
                $('#validTill').val(d + "/" + m + "/" + y);
                $('#editId').val(data.id);
                //$('#validTill').val();
            } else {
                $('#editCertification').hide();
                $('.msg').html('<div class="alert alert-danger"><strong>Danger!</strong>'+resp.message+'</div>');
            }

        }
    });
}


