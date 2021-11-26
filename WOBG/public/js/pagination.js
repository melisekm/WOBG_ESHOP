// PER PAGE SELECTION
// read what is selected and set it in params
document.getElementById('per_page').onchange = function () {
    url.searchParams.set('per_page', this.value);
    window.location.href = url.href;
};
