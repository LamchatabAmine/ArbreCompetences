document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("form");

  form.addEventListener("submit", function (event) {
    const nomInput = document.getElementById("nom");
    const cneInput = document.getElementById("CNE");
    const villeInput = document.getElementById("ville");

    // Validate "nom" input
    const nomValue = nomInput.value.trim();
    if (/^[A-Za-z]+[ ]+ [A-Za-z]+$/.test(nomValue)) {
      alert("Nom must contain only alphabetic characters.");
      event.preventDefault();
      return;
    }

    // Validate "CNE" input
    const cneValue = cneInput.value.trim();
    if (!/^[A-Za-z][0-9]{9}$/.test(cneValue)) {
      alert("CNE must start with a character followed by 9 numbers.");
      event.preventDefault();
      return;
    }

    const villeValue = villeInput.value.trim();
    if (/^[A-Za-z]+[ ]+ [A-Za-z]+$/.test(villeValue)) {
      alert("Nom must contain only alphabetic characters.");
      event.preventDefault();
      return;
    }

  });
});
