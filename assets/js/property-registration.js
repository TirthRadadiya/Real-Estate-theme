jQuery(function ($) {
  $("body").on("click", "#my-button", function (e) {
    e.preventDefault();
    let $fileInput = $("#files");
    let files_data = $fileInput.prop("files"); // Get multiple files
    let file_thumbnail = $("#thumbnail").prop("files")[0];
    let form_data = new FormData();

    // Loop through each selected file
    $.each(files_data, function (i, file) {
      form_data.append("files[]", file); // Add each file to the form data
    });

    form_data.append("thumbnail", file_thumbnail);

    form_data.append("action", "file_upload2");
    form_data.append("name", $("#name").val());
    form_data.append("address", $("#address").val());
    form_data.append("rooms", $("#rooms").val());
    form_data.append("area", $("#area").val());
    form_data.append("beds", $("#beds").val());
    form_data.append("bath", $("#bath").val());
    form_data.append("description", $("#description").val());

    const url = $("#property-form").data("url");

    $.ajax({
      url: url,
      type: "POST",
      contentType: false,
      processData: false,
      data: form_data,
      success: function (response) {
        window.location.href = `${themePath.domain}`;
      },
    });
  });
});
