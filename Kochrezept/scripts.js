function validateForm() {
    const dateFrom = document.getElementById("dateFrom").value;
    const dateTo = document.getElementById("dateTo").value;
    const specificMonthInput = document.getElementById("specificMonthInput").value;
    const lastMonth = document.getElementById("lastMonth").checked;
    const currentMonth = document.getElementById("currentMonth").checked;
    const noMonth = document.getElementById("noMonth").checked;

    // Check if at least one field is filled
    if (!dateFrom && !dateTo && !specificMonthInput && !lastMonth && !currentMonth && !noMonth) {
      alert("Bitte füllen Sie mindestens ein Feld aus.");
      return false; // Prevent form submission
    }

    // Additional validation logic can be added if required

    return true; // Allow form submission
}

document.getElementById("recipeSearchForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent default form submission
  
    // Call the validateForm() function here
    if (validateForm()) {
      this.submit(); // Submit the form if validation passes
    }
  });
  

