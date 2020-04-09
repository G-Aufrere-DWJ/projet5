class Diaporama {
    constructor(tab_images, idimages) {
        this.i = 0;
        this.imagediapo = tab_images;
        this.idimages = idimages;
        document.getElementById(this.idimages).src = this.imagediapo[this.i];
    }

    avancer() {
        this.i++;
        if (this.i > this.imagediapo.length - 1) {
            this.i = 0;
        }
        document.getElementById(this.idimages).src = this.imagediapo[this.i];
    }
}