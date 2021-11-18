// na zaklade velkosti obrazovky umiestni von a dnu searchbar
const mediaQuery = window.matchMedia('(max-width: 768px)')
const mediaQueryLg = window.matchMedia('(min-width: 769px)')
const handleTabletChange = (e) => {
    if (e.matches) {
        $("#search_form").appendTo($("#toggleMobileMenu"));
    }
}

mediaQuery.addEventListener("change", handleTabletChange)
mediaQueryLg.addEventListener("change", (e) => {
    if (e.matches) {
        $("#search_form").insertBefore($("#hamburger-btn"));
    }
})

// okamzita kontrola pri otvoreni stranky
handleTabletChange(mediaQuery)


// Live Search
//zalozene na https://www.codingnepalweb.com/search-bar-autocomplete-search-suggestions-javascript/
const searchWrapper = document.querySelector(".search-input");
const inputBox = searchWrapper.querySelector("input");
const suggBox = searchWrapper.querySelector(".autocom-box");
const resultsTag = `<li class="fw-bold results-header">Results</li><hr>`;
const MAX_SEARCH_RESULTS = 5;
const MIN_LENGTH_TO_SEARCH = 2;

// if user press any key and release
inputBox.onkeyup = (e) => {
    let userData = e.target.value; //user enetered data
    if (userData.length >= MIN_LENGTH_TO_SEARCH) {
        // get suggestions from server
        fetch(`/api/products/search?query=${userData}`)
            .then(res => res.json())
            .then(suggestionsList => {
                suggestionsList = suggestionsList.map((product) => {
                    // return data inside li tag
                    return `<a href="/products/${product.id}"><li>${product.name}</li></a>`;
                });
                suggestionsList.splice(0, 0, resultsTag);
                searchWrapper.classList.add("active"); //show autocomplete box
                suggBox.innerHTML = showSuggestions(suggestionsList);
            })
            .catch(err => {
                console.log(err);
            });
    } else {
        suggBox.innerHTML = "";
        searchWrapper.classList.remove("active"); //hide autocomplete box
    }
}

const showSuggestions = (list) => {
    const search = `<hr/><a href="/products?search=${inputBox.value}"><li>Search for "${inputBox.value}" &gt;</li></a>`;
    if (list.length === 1) {
        return search;
    } else if (list.length >= MAX_SEARCH_RESULTS) {
        list[MAX_SEARCH_RESULTS + 1] = search;
        return list.slice(0, MAX_SEARCH_RESULTS + 2).join('');
    }
    list.push(search);
    return list.join('');
}

inputBox.addEventListener('search', () => {
    suggBox.innerHTML = "";
    searchWrapper.classList.remove("active");
});

const addProductToCart = (id) => {
    $.post(`/cart/${id}`).done((data) => {
        $("#cartCount").html(data.length);
    });
}
