jQuery(function ($) {
  $("body").on("click", "#my-button", function () {      
      const $fileInput = $("#files");
      const filesData = $fileInput.prop("files"); // Get multiple files
      const fileThumbnail = $("#thumbnail").prop("files")[0];
      const formData = new FormData();

      // Append each selected file to the form data
      $.each(filesData, function (i, file) {
          formData.append("files[]", file);
      });

      formData.append("thumbnail", fileThumbnail);
      formData.append("action", "file_upload2");
      formData.append("name", $("#name").val());
      formData.append("address", $("#address").val());
      formData.append("rooms", $("#rooms").val());
      formData.append("area", $("#area").val());
      formData.append("beds", $("#beds").val());
      formData.append("bath", $("#bath").val());
      formData.append("description", $("#description").val());

      const ajaxUrl = $("#property-form").data("url");

      $.ajax({
          url: ajaxUrl,
          type: "POST",
          contentType: false,
          processData: false,
          data: formData,
          success: function (response) {
              if (response.success) {
                  window.location.href = themePath.domain;
              }
            console.log(response);
          },
          error: function (xhr, status, error) {
              console.error("Submission failed:", status, error);
          }
      });
  });
});