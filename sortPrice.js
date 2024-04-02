
function sortPrice() {
    var sortOrder = document.getElementById('priceSort').value;
    var searchParams = new URLSearchParams(window.location.search);
    searchParams.set("dir", sortOrder);
    window.location.href = window.location.pathname + '?' + searchParams.toString();
}
