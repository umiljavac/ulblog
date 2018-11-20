'use strict';

class Slideshow {
    constructor(type) {
      //  this.slidesVue = slidesVue;
        this.type = type;
        this.initType(type);
       // this.container = document.querySelector('.slideshow-container');
       // this.slideshow = document.querySelector('.slideshow');
       // this.slideElts = document.querySelectorAll('.slide-elt');
        this.currentIndex = 0;
        this.testWindowWidth();
        window.addEventListener('resize', this.testWindowWidth.bind(this));
    }

    initType(type) {
        switch (type) {
            case 'laptop':
                this.container = document.querySelector('.laptop-slideshow-container');
                this.slideshow = document.querySelector('.laptop-slideshow');
                this.slideElts = document.querySelectorAll('.laptop-slide-elt');
                break;
            case 'mobile':
                this.container = document.querySelector('.mobile-slideshow-container');
                this.slideshow = document.querySelector('.mobile-slideshow');
                this.slideElts = document.querySelectorAll('.mobile-slide-elt');
                break;
        }
    }

    init() {
        this.buildNavigation();
        this.hideOrShowArrowNav();
    }

    testWindowWidth()
    {
        if (window.innerWidth <= 768 && this.type === 'laptop') {
            this.slidesVue = 1;
        } else if (window.innerWidth > 768 && this.type === 'laptop') {
            this.slidesVue = 2;
        }
        if (this.type === 'mobile' && window.innerWidth <= 384) {
            this.slidesVue = 1;
        } else if (this.type === 'mobile' && window.innerWidth > 384 && window.innerWidth <= 850) {
            this.slidesVue = 2
        } else if (this.type === 'mobile' && window.innerWidth > 850) {
            this.slidesVue = 4
        }
        this.ratio = this.slideElts.length / this.slidesVue;
        this.setSlideshowWidth();
        this.setSlideEltWidthAndPadding();
        if (this.leftArrow !== undefined) {
            this.moveTo(0);
        }
    }

    setSlideshowWidth() {
        this.slideshow.style.width = 100 * this.ratio + "%";
    }

    setSlideEltWidthAndPadding() {
        for (let i = 0; i < this.slideElts.length; i++) {
            this.slideElts[i].style.width = ((100 / this.slidesVue) / this.ratio) + '%';
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
      const arrowContainer = document.querySelector('.' + this.type + '-arrow-container');
      arrowContainer.appendChild(this.leftArrow);
      arrowContainer.appendChild(this.rightArrow);
      this.leftArrow.addEventListener('click', this.prev.bind(this));
      this.rightArrow.addEventListener('click', this.next.bind(this));
    }

    next() {
        console.log(this.type + ' : ' + this.currentIndex);
        this.moveTo(this.currentIndex + this.slidesVue);
    }

    prev() {
        console.log(this.type + ' : ' + this.currentIndex);
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
    const laptopSlideshow = new Slideshow('laptop');
    laptopSlideshow.init();
    const mobileSlideshow = new Slideshow('mobile');
    mobileSlideshow.init();

});