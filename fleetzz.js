$(function() {
  console.log('Check');
  $('li.admin').addClass('active-page open');
  $('li.admin ul.sub-menu').show();
  $('li.admin ul.sub-menu li').addClass('animation');
  $('li.animation a[href="admin-profile"]').addClass('active');
  $('li.animation a[href="admin-profile"]').parent('li').addClass('active-bar');

  $('#form_admin_update').submit(function(e) {
    e.preventDefault();

    var form = $('#form_admin_update');
    var submit_button = $('#form_admin_update button');
    var redirect_url = './admin-profile';

    $.ajax({
      type: 'POST',
      url: 'models/ajax_update_admin.php',
      data: (form).serialize(),
      context: this,
      beforeSend: function() {
        (submit_button).attr('disabled', true).html('<i class="fa fa-spinner fa-spin fa-fw"></i> Please Wait ...');
      },
      error: function(xhr) {
        console.log('Error Message: '+xhr.status);
      },
      success: function(response) {
        console.log('Success Message: '+response);
        if (response === 'SESSION-OUT') {
          window.location = "./";
        } else if (response.indexOf('Could not connect to server') >= 0) {
        } else if (response == 'Updated') {
          (submit_button).html('<i class="fa fa-check-circle"></i> Profile Updated');
          setTimeout(function() {
            window.location = redirect_url;
          }, 1000);
        }
      }, // end success
    }); // end ajax
  });
});
