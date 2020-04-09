class Main {
    init() {
        this.images = [];
        this.images[0] = 'public/img/diapo1.jpg';
        this.images[1] = 'public/img/diapo2.jpg';
        this.images[2] = 'public/img/diapo3.jpg';
        this.images[3] = 'public/img/diapo4.jpg';
        this.images[4] = 'public/img/diapo5.jpg';

        var monDiapo = new Diaporama(this.images, 'image_diapo');

        monDiapo.interval = setInterval(function () {
            monDiapo.avancer();
        }.bind(this), 5000);
    }
}

var myMain = new Main();
myMain.init();