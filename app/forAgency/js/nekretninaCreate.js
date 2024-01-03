document.addEventListener("DOMContentLoaded", function() {
    var uploadInputs = document.querySelectorAll(".image-upload-button");
    var deleteInputs = document.querySelectorAll(".delete-btn-custom");

    for (var i = 0; i < uploadInputs.length; i++) {
        deleteInputs[i].disabled = true;
    }

    for (var i = 0; i < uploadInputs.length; i++) {
        uploadInputs[i].addEventListener("change", function() {
            var currentIndex = Array.from(uploadInputs).indexOf(this);
            if (currentIndex >= 0 && currentIndex < uploadInputs.length) {
              console.log(currentIndex);
                deleteInputs[currentIndex].disabled = false;
            }
        });
    }
});

function previewImage(input, imageId) {
    const preview = document.getElementById(imageId);
    const file = input.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        preview.src = e.target.result;
      };
      reader.readAsDataURL(file);
    }
  }

function removeUploadedFile(button, input, previewIndex) {
  button.disabled = true;
  input.value = '';
  const previewImageName = 'preview' + previewIndex;
  document.getElementById(previewImageName).src = '../assets/No_Preview_image.png';
}