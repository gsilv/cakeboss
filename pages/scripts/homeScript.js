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

let height = 2
let maxLength = 32
function addHeight() {
  let textarea = document.querySelector('.text-area')
  let commentText = textarea.value
  
  if(commentText.length == maxLength) {
    maxLength += 31
    textarea.style.height = `${height}rem`
    height++
  }
}

function resetHeigth(event) {
  if(event.key == 'Backspace') {
    let textarea = document.querySelector('.text-area')
    let commentText = textarea.value

    if(commentText.length == 0) {
      textarea.style.height = '1.3rem'
      height = 2
      maxLength = 32
    }
  }
}
