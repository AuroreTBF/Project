function previewImage() {
      var preview = document.getElementById('preview');
      var fileInput = document.getElementById('imageUpload');
      var file = fileInput.files[0];

      if (file) {
        var reader = new FileReader();

        reader.onload = function (e) {
          var img = new Image();
          img.src = e.target.result;
          img.style.maxWidth = '70%';
          img.style.maxHeight = '70%';
          preview.innerHTML = '';
          preview.appendChild(img);
        };

        reader.readAsDataURL(file);
      } else {
        // No file selected or canceled, clear the preview
        preview.innerHTML = '';
      }
    }

    function cancelSelection() {
      var fileInput = document.getElementById('imageUpload');
      fileInput.value = ''; // Reset the file input
      var preview = document.getElementById('preview');
      preview.innerHTML = ''; // Clear the preview
    }