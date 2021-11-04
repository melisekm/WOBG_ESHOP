// Live Search
//zalozene na https://www.codingnepalweb.com/search-bar-autocomplete-search-suggestions-javascript/
const searchWrapper = document.querySelector(".search-input");
const inputBox = searchWrapper.querySelector("input");
const suggBox = searchWrapper.querySelector(".autocom-box");
const resultsTag = `<li><strong>Results</strong></li><hr>`;
const MAX_SEARCH_RESULTS = 5;
const MIN_LENGTH_TO_SEARCH = 2;

// if user press any key and release
inputBox.onkeyup = (e) => {
    let userData = e.target.value; //user enetered data
    let suggestionsList = [];
    if (userData.length >= MIN_LENGTH_TO_SEARCH) {
        suggestionsList = suggestions.filter((data) => {
            //filtering array value and user characters to lowercase and return only those words which are start with user enetered chars
            return data.toLocaleLowerCase().startsWith(userData.toLocaleLowerCase());
        });
        suggestionsList = suggestionsList.map((data) => {
            // passing return data inside li tag
            return `<a href="#"><li>${data}</li></a>`;
        });
        suggestionsList.splice(0, 0, resultsTag);
        searchWrapper.classList.add("active"); //show autocomplete box
        suggBox.innerHTML = showSuggestions(suggestionsList);
    } else {
        suggBox.innerHTML = "";
        searchWrapper.classList.remove("active"); //hide autocomplete box
    }
}

const showSuggestions = (list) => {
    const search = `<hr/><a href="#"><li>Search for "${inputBox.value}" &gt;</li></a>`;
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

