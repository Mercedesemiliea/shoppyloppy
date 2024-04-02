
function sortPrice() {
    var sortOrder = document.getElementById('priceSort').value;
    console.log(sortOrder);
    var currentUrl = new URL(window.location);
    currentUrl.searchParams.set("dir", sortOrder);
    window.location.href = currentUrl.toString();
}
