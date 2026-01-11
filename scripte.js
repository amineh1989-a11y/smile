
document.getElementById("rdvForm").addEventListener("submit", function (e) {
    e.preventDefault();
    document.getElementById("confirmation").classList.remove("hidden")
        ; this.reset();
});
