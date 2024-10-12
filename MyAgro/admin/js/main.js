// after click proof document display popup
document.addEventListener("click", function (e) {
  if (e.target.classList.contains("proof_doc")) {
    const src = e.target.getAttribute("src");
    document.querySelector(".modal-img").src = src;
    const myModal = new bootstrap.Modal(
      document.getElementById("proof-document")
    );
    myModal.show();
  }
});
