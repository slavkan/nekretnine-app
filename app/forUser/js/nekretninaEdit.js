const imageUrls = [
  document.getElementById('tempSlikaUrl1').value,
  document.getElementById('tempSlikaUrl2').value,
  document.getElementById('tempSlikaUrl3').value,
  document.getElementById('tempSlikaUrl4').value,
  document.getElementById('tempSlikaUrl5').value,
  document.getElementById('tempSlikaUrl6').value,
  document.getElementById('tempSlikaUrl7').value,
  document.getElementById('tempSlikaUrl8').value,
  document.getElementById('tempSlikaUrl9').value,
  document.getElementById('tempSlikaUrl10').value,
];


const previewElements = [
  document.getElementById("previewOld1"),
  document.getElementById("previewOld2"),
  document.getElementById("previewOld3"),
  document.getElementById("previewOld4"),
  document.getElementById("previewOld5"),
  document.getElementById("previewOld6"),
  document.getElementById("previewOld7"),
  document.getElementById("previewOld8"),
  document.getElementById("previewOld9"),
  document.getElementById("previewOld10"),
];

const defaultImagePath = "../assets/No_Preview_image.png";

for (let i = 0; i < imageUrls.length; i++) {

  if (imageUrls[i]) {
      previewElements[i].src = imageUrls[i];
  } else {
      previewElements[i].src = defaultImagePath;
  }
}




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

function previewImage(input, imageId, imageOldId) {
    const preview = document.getElementById(imageId);
    const file = input.files[0];
    const oldImage = document.getElementById(imageOldId);
    oldImage.style.filter = "brightness(35%)";
    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        preview.src = e.target.result;
      };
      reader.readAsDataURL(file);
    }
  }

function removeUploadedFile(button, input, previewIndex, imageOldId) {
  button.disabled = true;
  input.value = '';
  const previewImageName = 'preview' + previewIndex;
  document.getElementById(previewImageName).src = '../assets/No_Preview_image.png';

  const oldImage = document.getElementById(imageOldId);
    oldImage.style.filter = "brightness(100%)";
}