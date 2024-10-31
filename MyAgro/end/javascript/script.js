window.onload = function () {
  document.getElementById("download").addEventListener("click", function () {
    const invoice = document.getElementById("invoice");
    var opt = {
      margin: 0,
      filename: "MyAgro Invoice.pdf",
      image: { type: "jpeg", quality: 0.98 },
      html2canvas: { scale: 2 },
      jsPDF: { unit: "in", format: "letter", orientation: "portrait" },
    };
    html2pdf().from(invoice).set(opt).save();
  });
};
