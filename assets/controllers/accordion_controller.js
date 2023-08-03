import {Controller} from '@hotwired/stimulus';

export default class extends Controller {

    static targets = ["output",'state']

    connect() {
    }


    show() {


        if (this.outputTarget.style.display === "block"){
            this.outputTarget.style.display = "none"
            this.stateTarget.classList.remove("ri-subtract-line")
            this.stateTarget.classList.add("ri-add-line")
        }
        else{
            this.outputTarget.style.display = "block"
            this.stateTarget.classList.remove("ri-add-line")
            this.stateTarget.classList.add("ri-subtract-line")
        }

    }


    hide(){

        if (this.outputTarget.style.display === "none"){
            this.outputTarget.style.display = "block"
            this.stateTarget.classList.remove("ri-arrow-up-s-line")
            this.stateTarget.classList.add("ri-arrow-down-s-line")
        }
        else{
            this.outputTarget.style.display = "none"
            this.stateTarget.classList.remove("ri-arrow-down-s-line")
            this.stateTarget.classList.add("ri-arrow-up-s-line")
        }

    }
}
