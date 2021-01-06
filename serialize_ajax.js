// @author arnabmunshi
$(function() {
  $('li.admin').addClass('active-page open');
  $('li.admin ul.sub-menu').show();
  $('li.admin ul.sub-menu li').addClass('animation');
  $('li.animation a[href="employees"]').addClass('active');
  $('li.animation a[href="employees"]').parent('li').addClass('active-bar');

  $('.modal').on("shown.bs.modal", function() {
    $('#form_add_emp').find('#emp_name').focus();
  });

  $('.modal').on('hidden.bs.modal', function () {
    $('#form_add_emp')[0].reset();
  });
  
  // time-picker
  // <link href="https://www.malot.fr/bootstrap-datetimepicker/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css" rel="stylesheet">
  $('.time-picker').datetimepicker({
    // autoclose : true,
    format : "hh:ii",
    startView: 0
  });
  // <script src="https://www.malot.fr/bootstrap-datetimepicker/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>

  // datetime-picker
  // <link href="https://www.malot.fr/bootstrap-datetimepicker/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css" rel="stylesheet">
  $(".date-time-picker").datetimepicker({format: 'yyyy-mm-dd hh:ii'});
  // <script src="https://www.malot.fr/bootstrap-datetimepicker/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
  
  $(".date-picker").datepicker({
    orientation: "top auto",
    autoclose: true,
    format: "yyyy-mm-dd",
    todayHighlight: true,
    orientation: "bottom auto",
    startDate: new Date()
  });

  // add employee
  $('#form_add_emp').submit(function(e) {
    e.preventDefault();

    var form = $(this);
    var submit_button = $(this).find('#btnSubmit');
    var redirect_url = './employees';
    // or
    var redirect_url = location.reload(true);

    var default_button_text = 'Add New Employee';
    var before_send_button_text = '<i class="fa fa-spinner fa-spin fa-fw"></i> Please Wait ...';
    var after_save_button_text = '<i class="fa fa-check-circle"></i> Employee Added';

    var submit_method = 'POST';
    var submit_url = 'models/employees/ajax_add_emp.php';
    var data = (form).serialize();

    $.ajax({
      type: submit_method,
      url: submit_url,
      data: data,
      context: this,
      contentType: "application/json",
      dataType: "json",
      beforeSend: function() {
        (submit_button).attr('disabled', true).html(before_send_button_text);
      },
      error: function(xhr) {
        console.log('Error Message: '+xhr.status);
        // $('#doc-details .after-submit.msg-red').text('Server Error.').show();
        // $('#form_create_division .button').attr('disabled', false).html('<i class="fa fa-plus-circle"></i> Add Doctor');
      },
      success: function(response) {
        console.log('Success Message: '+response);
        // response = JSON.parse(response);
        if (response === 'SESSION-OUT') {
          window.location = "./";
        } else {
          if (response.indexOf('Could not connect to server') >= 0) {
            // $('#doc-details .after-submit.msg-red').text('Detabase Connection Error.').show();
            // $('#doc-details .button').html('<i class="fa fa-plus-circle"></i> Add Doctor').attr('disabled', false);
          } else if (response == 'Saved') {
            (form)[0].reset();
            (submit_button).html(after_save_button_text);
            setTimeout(function() {
              window.location = redirect_url;
              window.location.reload(); // redirect current url
            }, 1000);
          } else if (response.indexOf('Duplicate entry') >= 0) {
            if (response.indexOf('emp_code') >= 0) {
              alert('This Employee Code Is Already Exsis.');
            }
            if (response.indexOf('emp_email') >= 0) {
              alert('This Email ID Is Already Exsis.');
            }
            if (response.indexOf('emp_phn') >= 0) {
              alert('This Phone Number Is Already Exsis.');
            }
            (submit_button).attr('disabled', false).html(default_button_text);
          }
        } // else
      }, // end success
    }); // end ajax
  });
});
