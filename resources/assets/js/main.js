jQuery(document).ready(function($) {


  $(document).on('click', '.close-modal, .mr-wrapper', function(e) {
    $('.modal-result').fadeOut('fast');
  });

  $(document).on('click', '.upload-icon-wrapper', function(e) {
    e.preventDefault();
    $(this).parent().find('.upload-file-input').click();
  });

  $(document).on('change', '.upload-file-input', function(e) {
    e.preventDefault();

    var file = null;
    var filename = "Ningún archivo seleccionado";
    var size = 0;
    var width = 0;
    var height = 0;

    if(this.files.length){
      file = this.files.item(0);
      filename = file.name;
      size = file.size;

      var reader = new FileReader();
      reader.readAsDataURL(file);
      reader.onload = (e) => {
          $('#file1original').val(e.target.result);
      }
    }

    // $('#avatar-upload').find('.filename').text(filename);

    if(file === null){
      $(this).parent().find('.tools').addClass('hidden');
    }else{
      $(this).parent().find('.tools').removeClass('hidden');
      var elemId = $(this).parents('.collage-item').attr('id');
      var elem = document.getElementById(elemId);
      var _width = $('#'+elemId).outerWidth();
      var _heigth = $('#'+elemId).outerHeight();
      var basic = $('#'+elemId).croppie({
          viewport: {
              width: _width,
              height: _heigth
          },
          boundary: {
              width: _width,
              height: _heigth
          },
          showZoomer: true,
          enforceBoundary: true,
          enableOrientation: true
        });
      basic.croppie('bind', {
          url: window.URL.createObjectURL(file)
      });

      $(elem).find('.tool-rotate').unbind('click');
      $(elem).find('.tool-rotate').click(function(e) {
        e.preventDefault();
        basic.croppie('rotate', parseInt($(this).data('deg')));
      });

      $(elem).find('.tool-expand').unbind('click');
      $(elem).find('.tool-expand').click(function(e) {
        e.preventDefault();
        basic.croppie('setZoom', 0);
      });

      $(elem).find('.tool-remove').unbind('click');
      $(elem).find('.tool-remove').click(function(e) {
        e.preventDefault();
        $(this).parents('.tools').addClass('hidden');
        $(this).parents('.collage-item').find('.upload-file-input').val('');
        $(this).parents('.collage-item').find('#file1original').val('');
        $(this).parents('.collage-item').find('#file1cropped').val('');
        basic.croppie('destroy');
      });

      $(elem).find('.tool-done').unbind('click');
      $(elem).find('.tool-done').click(function(e) {
        // $('.loader-wrapper').show();

        var w = parseInt($(elem).outerWidth(), 10),
          h = parseInt($(elem).outerHeight(), 10),
          size = 'viewport';
        if (w || h) { size = { width: w, height: h }; }

        basic.croppie('result', {
          type: 'base64',
          // size: size
          size: 'original',
          format: 'jpg'
        }).then(function(response){
          $('#file1cropped').val(response);
          $('.postcard-preview-image').attr('src', response);
          // $('.button-save-draft').removeAttr('disabled');
          $('.steps [data-step-id="2"]').removeClass('is-active').addClass('is-completed');
          $('.steps [data-step-id="3"]').addClass('is-active');
          $('.steps .step-content').removeClass('is-active');
          $('.steps .step-content:nth-child(4)').addClass('is-active');
          // $('.mr-img').attr('src', response);
          // $('.loader-wrapper').hide();
          // $('.modal-result').fadeIn(350);

          // Send to form.php to save result image
          // $('#hidden-input').val(response);
          // $('#postcard').submit();
          // console.info(response);
        });
      });

    } // file !== null
  });

  // $('.tool-rotate').click(function(e) {
    // e.preventDefault();
    // console.info(parseInt($(this).data('deg')))
    // croppie.rotate(parseInt($(this).data('deg')));
    // $(this).find('.cr-overlay').croppie('rotate', parseInt($(this).data('deg')));
  // });

  $(document).on('click', '.font-family', function(e) {
    e.preventDefault();
    $(this).toggleClass('opened');
  });


});
