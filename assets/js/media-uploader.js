jQuery(document).ready(function ($) {
  // Instantiate the variable that holds the media library frame.
  var metaImageFrame;

  // Run when the image button is clicked.
  $('#upload_image_btn').on('click', function (event) {
    // Prevent the default action from occurring.
    event.preventDefault();

    // If the frame already exists, re-open it.
    if (metaImageFrame) {
      metaImageFrame.open();
      return;
    }

    // Set up the media library frame.
    metaImageFrame = wp.media.frames.metaImageFrame = wp.media({
      title: meta_image.title,
      button: { text: meta_image.button },
      library: { type: 'image' }
    });

    // Run when an image is selected.
    metaImageFrame.on('select', function () {
      // Grab the attachment selection and create a JSON representation of the model.
      var mediaAttachment = metaImageFrame
        .state()
        .get('selection')
        .first()
        .toJSON();

      // Send the attachment URL to our custom image input field.
      console.log(mediaAttachment.url);
      $('#txt_upload_image').val(mediaAttachment.url);
    });

    // Open the media library frame.
    metaImageFrame.open();
  });
});