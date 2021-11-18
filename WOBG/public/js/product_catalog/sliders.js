//Prodcut catalog slider
//https://github.com/seiyria/bootstrap-slider
const minTag = document.getElementById("priceMin")
const maxTag = document.getElementById("priceMax")
const priceRange = new Slider('#priceRange', {"tooltip": "hide"});
const priceRangeElement = priceRange.getElement()
minTag.innerHTML = priceRange.getValue()[0] + "$"
maxTag.innerHTML = priceRange.getValue()[1] + "$"

const updatePriceSliderValues = () => {
    const [low, high] = priceRange.getValue()
    minTag.innerHTML = low + "$"
    maxTag.innerHTML = high + "$"
}
priceRangeElement.slide = updatePriceSliderValues
priceRangeElement.change = updatePriceSliderValues


priceRangeElement.slideStop = () => {
    url.searchParams.set("min_price", priceRange.getValue()[0])
    url.searchParams.set("max_price", priceRange.getValue()[1])
    window.location.href = url.href;
}



const SliderWrapper = (sliderId, tag, textDecorator) => {
    const slider = new Slider(sliderId, {"tooltip": "hide"})
    const sliderElement = slider.getElement()
    const tagElement = document.getElementById(tag)

    sliderElement.slideStop = () => {
        url.searchParams.set(tag, slider.getValue())
        window.location.href = url.href;
    }

    const updateSliderValue = () => {
        tagElement.innerHTML = slider.getValue() + textDecorator
    }
    updateSliderValue()
    sliderElement.slide = updateSliderValue
    sliderElement.change = updateSliderValue

}
SliderWrapper('#ageRange', "minAge", " years")
SliderWrapper('#playerRange', "minPlayers", " players")
SliderWrapper('#playTimeRange', "minPlayTime", " minutes")
