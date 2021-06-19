$(document).ready(function () {
  var $buyerForm = $('#buyerEntryForm');
  $buyerForm.find('#phone').val('880');

  // report page datepicker
  var $filterForm = $('#filterForm');
  $filterForm.find("#date_from").datepicker({ dateFormat: 'yy-mm-dd' });
  $filterForm.find("#date_to").datepicker({ dateFormat: 'yy-mm-dd' });

  // items add more
  $(".add-more").click(function() {
    var item = '<div class="item-wrap" style="margin-top: 10px">' +
      '<input type="text" name="items[]" class="" placeholder="Please enter items">' +
      '<button type="button" class="remove">Remove</button></div>';
    $(".items-wrapper").append(item);
  });  

  $(".items-wrapper").on("click", ".remove", function() {
    $(this).parent(".item-wrap").remove();
  });

  // js validation
  jQuery.validator.addMethod("onlytext", function(value, element) {
    return this.optional(element) || /^[a-z]+$/i.test(value);
  }, "Only text is allowed");

  jQuery.validator.addMethod("onlytextspace", function(value, element) {
    return this.optional(element) || /^[a-z ]+$/i.test(value);
  }, "Only text, space are allowed");

  jQuery.validator.addMethod("onlytextspacenumber", function(value, element) {
    return this.optional(element) || /^[a-z0-9 ]+$/i.test(value);
  }, "Only text, space, number are allowed");

  if($buyerForm.length > 0) {
    $buyerForm.validate({
      rules: {
        amount: { 
          required: true,
          number: true,
        }, 
        buyer: { 
          required: true,
          maxlength: 20,
          onlytextspacenumber: true
        }, 
        receipt_id: { 
          required: true,
          onlytext: true
        }, 
        'items[]': { 
          required: true,
          onlytext: true
        },
        email: {
          required: true,
          email: true
        },
        note: { 
          required: true,
          maxlength: 30
        }, 
        city: { 
          required: true,
          onlytextspace: true
        }, 
        phone: { 
          required: true,
          number: true, 
          maxlength: 13,
          minlength: 13,
        }, 
        entry_by: { 
          required: true,
          number: true
        }
      },
      messages: {
        email: {
          required: 'Email field is required',
          email: 'Email must be valid'
        }, 
        phone: {
          minlength: 'Please enter 13 digits'
        }
      }
    });
  }

  // form submit
  $buyerForm.on('submit', function (e) {
    e.preventDefault();

    if($buyerForm.valid()) {
      $.ajax({
        type: 'post',
        url: $buyerForm.attr("action"),
        data: $buyerForm.serialize(),
        dataType: 'json',
        success: function(response) {
          if(response.error_exists == 1) {
            var errors = response.validation_errors;

            $buyerForm.find('.error').html('');
            $.each(errors, function (key, msg) {
              $buyerForm.find('#' + key).next('.error').html("<br><span class='error'>"+ msg +"</span>");
            });
          } else {
            alert('Information submitted successfully.');
            $buyerForm[0].reset();

            // cookie set
            var date = new Date();
            date.setDate(date.getDate() + 1);
            date.toGMTString();

            $cookie_value = date.toLocaleTimeString();
            document.cookie ="buyer=" + $cookie_value + "; expires=" + date + '; path=/';

            $msg = 'As you have submitted today, You can\'t submit within 24 hours. You can submit after ' + $cookie_value;
            $buyerForm.html($msg);
          }
        }
      });
    }
  });
});