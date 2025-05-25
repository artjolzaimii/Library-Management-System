  document.addEventListener("DOMContentLoaded", function () {
    // Get the input using its placeholder text
    const searchInput = document.querySelector("input[placeholder='Search...']");
    const tableRows = document.querySelectorAll("table tbody tr");

    if (!searchInput) return;

    searchInput.addEventListener("input", function () {
      const filter = searchInput.value.toLowerCase();

      tableRows.forEach(row => {
        const cells = row.querySelectorAll("td");
        const combinedText = Array.from(cells)
          .map(td => td.textContent.toLowerCase())
          .join(" ");

        if (combinedText.includes(filter)) {
          row.style.display = "";
        } else {
          row.style.display = "none";
        }
      });
    });
  });
