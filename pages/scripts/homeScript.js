let idxImageChecked = 1;

setInterval(() => {
  nextImage();
}, 5000)

function nextImage() {
  idxImageChecked++;
  const slidesLength = document.querySelectorAll(".radio-btn").length
  if(idxImageChecked > slidesLength){
    idxImageChecked = 1;
  }
  document.getElementById("radio" + idxImageChecked).checked = true;
}
