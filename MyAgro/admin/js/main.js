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
// payment document show in asssitnat dashboard
document.addEventListener("click", function (e) {
  if (e.target.classList.contains("payment_doc")) {
    const src = e.target.getAttribute("src");
    document.querySelector(".modal-img").src = src;
    const myModal = new bootstrap.Modal(
      document.getElementById("payment-document")
    );
    myModal.show();
  }
});
