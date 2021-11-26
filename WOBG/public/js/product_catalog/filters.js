// based on the value of the sort_by select box, change the url
const changeOrderURLParam = (value) => {
    if (["recommended", "recent", "top"].includes(value)) {
        url.searchParams.delete("order")
        url.searchParams.set("sort", value)
    } else if (value === "price_asc") {
        url.searchParams.set("sort", "price")
        url.searchParams.set('order', 'asc');

    } else if (value === "price_desc") {
        url.searchParams.set("sort", "price")
        url.searchParams.set('order', 'desc');
    }
    window.location.href = url.href;
}

// MOBILE ORDERDING
document.getElementById("mobile_sort").onchange = function () {
    changeOrderURLParam(this.value);
};


// DESKTOP ORDERING
// iterate over every element with class odering and set for each onclick function
document.querySelectorAll('.sort-option').forEach((element) => {
    element.onclick = () => changeOrderURLParam(element.id);
});


// CHECKBOXES
const getCheckedCategoriesAndSearch = () => {
    // get selected checkboxes on page
    const selectedCategories = document.querySelectorAll('input[name="categories"]:checked');
    const selectedSubCategories = document.querySelectorAll('input[name="subcategories"]:checked');
    // create array with values only
    const categories = Array.from(selectedCategories).map(el => el.value);
    const subcategories = Array.from(selectedSubCategories).map(el => el.value);
    // make a string with "," separator
    const catgoriesStr = categories.join(',');
    const subcategoriesStr = subcategories.join(',');
    // set url only if atleast one category is checked, else remove it
    if (categories.length > 0) {
        url.searchParams.set('cat', catgoriesStr);
    } else {
        url.searchParams.delete('cat');
    }
    if (subcategories.length > 0) {
        url.searchParams.set('subcat', subcategoriesStr);
    } else {
        url.searchParams.delete('subcat');
    }
    // update url
    // window.location.href = url.href;
}

// iterate over every checkbox and add eventlistener which listens for checkbox change
document.querySelectorAll('input[type="checkbox"]').forEach(cb => {
    cb.addEventListener('change', getCheckedCategoriesAndSearch);
});
