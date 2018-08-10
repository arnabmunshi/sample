// @author arnabmunshi
$(function() {
  $('li.operator').addClass('active-page open');
  $('li.operator ul.sub-menu').show();
  $('li.operator ul.sub-menu li').addClass('animation');
  $('li.animation a[href="sos"]').addClass('active');
  $('li.animation a[href="sos"]').parent('li').addClass('active-bar');

  $('.date-picker').datepicker({
    orientation: "top auto",
    autoclose: true
  });

  // operator attendance entry
  $('#form_other_application_submit').submit(function(e) {
    e.preventDefault();

    var form = $('#form_other_application_submit');
    var submit_button = $(this).find('#btnSubmit');
    var submit_data = (form).serialize();
    var submit_url = 'models/other-application/ajax_other_application_submit.php';
    var redirect_url = './other-application';
    var success_response_msg = 'Submited';

    $.ajax({
      type: 'POST',
      url: submit_url,
      data: submit_data,
      context: this,
      beforeSend: function() {
        (submit_button).attr('disabled', true).html('<i class="fa fa-spinner fa-spin fa-fw"></i> Please Wait ...');
      },
      error: function(xhr) {
        console.log('Error Message: '+xhr.status);
        // $('#doc-details .after-submit.msg-red').text('Server Error.').show();
        // $('#form_create_division .button').attr('disabled', false).html('<i class="fa fa-plus-circle"></i> Add Doctor');
      },
      success: function(response) {
        console.log('Success Message: '+response);
        if (response === 'SESSION-OUT') {
          window.location = "./";
        } else {
          if (response.indexOf('Could not connect to server') >= 0) {
            // $('#doc-details .after-submit.msg-red').text('Detabase Connection Error.').show();
            // $('#doc-details .button').html('<i class="fa fa-plus-circle"></i> Add Doctor').attr('disabled', false);
          } else if (response == 'Saved') {
            (form)[0].reset();
            (submit_button).html('<i class="fa fa-check-circle"></i> '+success_response_msg);
            setTimeout(function() {
              window.location = redirect_url;
            }, 1000);
          } else {
            $(submit_button).html('Submit').attr('disabled', false);
            // $('#form_add_emp .after-submit.msg-red').text(response).show();
          }
        } // else
      }, // end success
    }); // end ajax
  });
});
