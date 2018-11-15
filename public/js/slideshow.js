'use strict';

class Slideshow {
    constructor(slidesVue) {
        this.slidesVue = slidesVue;
        this.container = document.querySelector('.slideshow-container');
        this.slideshow = document.querySelector('.slideshow');
        this.slideElts = document.querySelectorAll('.slide-elt');
        this.ratio = this.slideElts.length / this.slidesVue;
        this.currentIndex = 0;
    }

    init() {
        this.setSlideshowWidth();
        this.setSlideEltWidthAndPadding();
        this.buildNavigation();
        this.hideOrShowArrowNav();
    }

    setSlideshowWidth() {
        this.slideshow.style.width = 100 * this.ratio + "%";
    }

    setSlideEltWidthAndPadding() {
        for (let i = 0; i < this.slideElts.length; i++) {
            this.slideElts[i].style.width = ((100 / this.slidesVue) / this.ratio) + '%';
            if (i % 2 === 0) this.slideElts[i].style.paddingRight = "5px";
            else this.slideElts[i].style.paddingLeft = "5px";
        }
    }

    buildDiv(className) {
        const divToBuild = document.createElement('div');
        divToBuild.className = className;
        return divToBuild
    }

    buildNavigation() {
      this.leftArrow = this.buildDiv('left-arrow');
      this.rightArrow = this.buildDiv('right-arrow');
      const arrowContainer = document.querySelector('.arrow-container');
      arrowContainer.appendChild(this.leftArrow);
      arrowContainer.appendChild(this.rightArrow);
      this.leftArrow.addEventListener('click', this.prev.bind(this));
      this.rightArrow.addEventListener('click', this.next.bind(this));
    }

    next() {
        console.log(this.currentIndex);
        this.moveTo(this.currentIndex + this.slidesVue);
    }

    prev() {
        console.log(this.currentIndex);
        this.moveTo(this.currentIndex - this.slidesVue);
    }

    moveTo(index) {
        let translateOnX = index * - 100 / this.slideElts.length;
        this.slideshow.style.transform = "translateX(" + translateOnX + "%)";
        this.currentIndex = index;
        this.hideOrShowArrowNav();
    }

    hideOrShowArrowNav() {
        if (this.slidesVue === this.slideElts.length) {
            this.leftArrow.style.display = 'none';
            this.rightArrow.style.display = 'none';
        } else if (this.currentIndex === 0 && this.slidesVue < this.slideElts.length) {
            this.leftArrow.style.display = 'none';
            this.rightArrow.style.display = 'block'
        } else if (this.currentIndex === this.slideElts.length || this.currentIndex + this.slidesVue >= this.slideElts.length) {
            this.leftArrow.style.display = 'block';
            this.rightArrow.style.display = 'none';
        } else {
            this.leftArrow.style.display = 'block';
            this.rightArrow.style.display = 'block';
        }
    }
}

document.addEventListener('DOMContentLoaded', () => {
   const slideshow = new Slideshow(2);
   slideshow.init();
});