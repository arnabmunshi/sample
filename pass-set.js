$(function() {
  // var strong = 0;
  $('#new_password').on('keyup', function() {
    
    var pass = $(this).val();
    // console.log(pass);
    var capkey = 0,
        smallkey = 0,
        numerickey = 0,
        minlength = 0,
        maxlength = 0,
        // strong = 0,
        specialkey = 0;

    var format = /[ !@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;
    if (format.test(pass)) {
      specialkey = 1;
    }
    
    if (pass.length >= 8) {
      minlength = 1;
      maxlength = 1;
    }
    if (pass.length > 12) {
      maxlength = 0;
    }

    for (var i=0; i<pass.length; i++) {
      var ascii = pass.charCodeAt(i);
      if (ascii >= 65 && ascii <= 90) {
        capkey = 1;
      }
      if (ascii >= 97 && ascii <= 122) {
        smallkey = 1;
      }
      if (ascii >= 48 && ascii <= 57) {
        numerickey = 1;
      } 
    }

    strong = minlength + maxlength + capkey + smallkey + numerickey + specialkey;

    if (strong == 0) {
      $('.fillcolor').css({
        'width': '0',
      });
    }
    if (strong == 1) {
      $('.fillcolor').css({
        'width': '10%',
        "background-color": "#ED5565",
      });
    }
    if (strong == 2) {
      $('.fillcolor').css({
        'width': '20%',
        "background-color": "#ED5565",
      });
    }
    if (strong == 3) {
      $('.fillcolor').css({
        'width': '40%',
        "background-color": "#FFCE54",
      });
    }
    if (strong == 4) {
      $('.fillcolor').css({
        'width': '60%',
        "background-color": "#4FC1E9",
      });
    }
    if (strong == 5) {
      $('.fillcolor').css({
        'width': '80%',
        "background-color": "#9281e4",
      });
    }
    if (strong == 6) {
      $('.fillcolor').css({
        'width': '100%',
        "background-color": "#A0D468",
      });
    }
  });
});
