jQuery(document).ready(function ($) {

  $(document).on("click", ".upload_image_button", function (e) {
    e.preventDefault();

    var $button = $(this);

    // Create the media frame.
    var file_frame = wp.media.frames.file_frame = wp.media({
      title: 'Select or upload image',
      library: { type: 'image' },
      button: { text: 'Select' },
      multiple: false
    });

    // When an image is selected, run a callback.
    file_frame.on('select', function () {
      var attachment = file_frame.state().get('selection').first().toJSON(); // Get image JSON

      $button.siblings('input').val(attachment.url).change();  // Change input value
      $button.siblings('img').attr('src', attachment.url).change(); // Change image URL
    });

    // Finally, open the modal
    file_frame.open();
  });
});
