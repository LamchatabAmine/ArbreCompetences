document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("form");

  form.addEventListener("submit", function (event) {
    let isValid = true;

    // Validate Compentence Reference
    const reference = document.getElementById("reference").value;
    if (reference.trim() === "") {
      isValid = false;
      alert("Compentence Reference is required.");
      event.preventDefault(); // Prevent form submission
      return;
    }

    // Validate Compentence Nom
    const nom = document.getElementById("nom").value;
    if (nom.trim() === "") {
      isValid = false;
      alert("Compentence Nom is required.");
      event.preventDefault(); // Prevent form submission
      return;
    }

    // Validate Description
    const description = document.getElementById("description").value;
    if (description.trim() === "") {
      isValid = false;
      alert("Description is required.");
      event.preventDefault(); // Prevent form submission
      return;
    }

    if (!isValid) {
      event.preventDefault(); // Prevent form submission
    }
  });
});

// Automatically hide the alert after 3 seconds
// document.addEventListener("DOMContentLoaded", function () {
//   const successAlert = document.getElementById("successAlert");
//   if (successAlert) {
//     setTimeout(function () {
//       successAlert.style.display = "none";
//     }, 7000); // 7000 milliseconds = 7 seconds
//   }
// });

document.addEventListener("DOMContentLoaded", function () {
  const urlParams = new URLSearchParams(window.location.search);
  const successParam = urlParams.get("success");

  // Check if successParam is "editedSuccessfully"
  // if (successParam === "editedSuccessfully") {
    const successAlert = document.getElementById("successAlert");
    if (successAlert) {
      setTimeout(function () {
        successAlert.style.display = "none";

        // Remove the success parameter from the URL
        history.replaceState({}, document.title, window.location.pathname);
      }, 7000); // 7000 milliseconds = 7 seconds
    }
  // }
});
