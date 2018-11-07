class HeaderDiv {
    constructor() {
        this.mainDiv = document.querySelector(".home-header");
        this.treeHead = document.querySelector(".tree-head");
        this.treeTrunk = document.querySelector("#tree-trunk");
        this.rocket = document.querySelector(".rocket-img");
        this.rocketBody = document.querySelector(".rocket-body-img");
        this.cloud = document.querySelector(".cloud1-img");
        this.textAnim = document.querySelector(".text-anim");
        this.flowerAnim = document.querySelector(".flower-anim");
    }

    init() {
        // Ugly Part.. Chrome/Opera choose to load image or not without this.
        this.rocket.style.display = 'block';
        this.rocketBody.style.display = 'block';
        this.cloud.style.display = 'block';
        this.treeHead.style.display = 'block';
        this.textAnim.style.display = 'inline';
        this.flowerAnim.style.display = 'inline';

        this.placeTreeTrunk();
    }

    getWidth(elt) {
        return parseFloat(window.getComputedStyle(elt).width);
    }

    getHeight(elt) {
        return parseFloat(window.getComputedStyle(elt).height);
    }

    getTop(elt) {
        return parseFloat(window.getComputedStyle(elt).top);
    }

    getLeft(elt) {
        return parseFloat(window.getComputedStyle(elt).left);
    }

    placeTreeTrunk() {
        this.treeTrunk.style.width = (this.getWidth(this.treeHead) / 10 )+ 'px';
        this.treeTrunk.style.height = (this.getHeight(this.mainDiv) - this.getTop(this.treeHead) - this.getHeight(this.treeHead) / 2) + 'px';
        this.treeTrunk.style.left = (this.getWidth(this.treeHead) / 2 + this.getLeft(this.treeHead) - this.getWidth(this.treeTrunk) / 2) + 'px';
    }
}

window.addEventListener('load', function() {
    const headerDiv = new HeaderDiv;
    headerDiv.init();
    window.addEventListener("resize", () => {
        headerDiv.placeTreeTrunk();
    });
});