window.addEventListener("load", () => {
    handleSlider()
})

function openModal(imageSrc) {
    var modal = document.getElementById("myModal");
    var modalImage = document.getElementById("modalImage");
    modal.style.display = "flex";
    modalImage.src = imageSrc;
}

function closeModal() {
    var modal = document.getElementById("myModal");
    modal.style.display = "none";
}

function handleSlider(){

    const inputs = document.querySelectorAll('input[name="slider"]');
    const dots = document.querySelectorAll('.dots label');

    const arrowLeft = document.querySelector('.slider .slider-arrow-next');
    const arrowRight = document.querySelector('.slider .slider-arrow-prev');

    arrowLeft.addEventListener("click", () =>  {
        const currentActive = document.querySelector('.dots label.active');
        if (currentActive.previousElementSibling){
            currentActive.previousElementSibling.click();
        } else {
            dots[dots.length - 1].click();
        }
    })

    arrowRight.addEventListener("click", () => {
        const currentActive = document.querySelector('.dots label.active');
        if (currentActive.nextElementSibling){
            currentActive.nextElementSibling.click()
        } else {
            dots[0].click();
        }
    })

    inputs.forEach((input, index) => {
        input.addEventListener('change', () => {
            dots.forEach((dot, i) => {
                if (i === index){
                    dot.classList.add("active");
                } else {
                    dot.classList.remove("active");
                }
            })
        })
    })
}

const scrollers = document.querySelectorAll(".scroller");

// If a user hasn't opted in for recuded motion, then we add the animation
if (!window.matchMedia("(prefers-reduced-motion: reduce)").matches) {
    addAnimation();
}

function addAnimation() {
    scrollers.forEach((scroller) => {
        // add data-animated="true" to every `.scroller` on the page
        scroller.setAttribute("data-animated", true);

        // Make an array from the elements within `.scroller-inner`
        const scrollerInner = scroller.querySelector(".scroller__inner");
        const scrollerContent = Array.from(scrollerInner.children);

        // For each item in the array, clone it
        // add aria-hidden to it
        // add it into the `.scroller-inner`
        scrollerContent.forEach((item) => {
            const duplicatedItem = item.cloneNode(true);
            duplicatedItem.setAttribute("aria-hidden", true);
            scrollerInner.appendChild(duplicatedItem);
        });
    });
}