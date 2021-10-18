// ajax requests

let form = $('#contact-form');

form.on('submit', function(e){
    e.preventDefault();
    $('#send').attr('disabled', true);
    $('#send').attr('value', 'Please Wait...');
    $('#send').css('cursor', 'not-allowed');
    $.ajax({
        url: 'form-submit.php',
        type: 'POST',
        data: form.serialize(),
        success: function(result){
            alert(result);
            $('#send').attr('disabled', false);
            $('#send').css('cursor', 'pointer');
            $('#send').attr('value', 'Send Message');
            form[0].reset();
        }
    });
});
