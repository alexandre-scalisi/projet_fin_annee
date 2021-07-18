window.slider = (slide) => {

    return {
        leftButton: document.querySelector('.' + slide + '__left-btn'),
        rightButton: document.querySelector('.' + slide + '__right-btn'),
        visible: null,
        width: null,
        lastPos: null,
        currentPos: 0,
        space: 2,
        slider: document.querySelector('.' + slide),
        length: document.querySelectorAll('.' + slide + '__anime').length,


        init() {
            if(window.innerWidth <= 420) {
                this.visible = 1;
            }
            else if(window.innerWidth <= 640) {
                this.visible = 2;
            }
            else if(window.innerWidth <= 1024) {
                this.visible = 3;
            }
            else {
                this.visible = 4;
            }
        
            this.lastPos = this.length - this.visible;
            this.width = (100 - (this.visible * this.space)) / (this.visible + .5)
            this.position();
        },

        position() {
            let translate;
            if(this.currentPos != this.lastPos) {
                this.rightButton.classList.remove('hidden');
            }
            if(this.currentPos != 0) {
                this.leftButton.classList.remove('hidden');
            }
            if(this.currentPos === 0) {
                translate = 0;
                this.leftButton.classList.add('hidden')
            } else if(this.currentPos >= this.lastPos){
                this.currentPos = this.lastPos
                translate = -this.lastPos * this.width - this.lastPos * this.space + this.width / 2 + this.space;
                this.rightButton.classList.add('hidden');
            } else {
                translate = -this.currentPos * this.width - this.currentPos * this.space
            }
            
            this.slider.style.transform = `translateX(${translate}%)`
        },
        
        rightClick() {
            this.currentPos++;
            this.position();
        },

        leftClick() {
            this.currentPos--;
            this.position();
        },

        initResize() {
            const curObj = this;
            console.log(curObj)
            window.addEventListener('resize', curObj.init.bind(curObj));
        }
    }
}











