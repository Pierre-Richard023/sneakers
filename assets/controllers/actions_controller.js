import {Controller} from '@hotwired/stimulus';
import axios from "axios"

export default class extends Controller {

    static targets = ["cart", "total","reset"]

    connect() {
    }


    async addSneaker(event) {
        event.preventDefault()

        const link = event.currentTarget
        const data = link.dataset

        const json = JSON.stringify({id: data.actionsIdParam})
        const res = await axios.post(`${link.href}`, json, {
            headers: {
                'Content-Type': 'application/json'
            }
        })
            .then(response => {
                const data = response.data
                this.showSuccess(data)
            })
    }

    async deleteSneaker(event) {

        event.preventDefault()

        const link = event.currentTarget
        const data = link.dataset


        const json = JSON.stringify({id: data.actionsIdParam})
        const res = await axios.post(`${link.href}`, json, {
            headers: {
                'Content-Type': 'application/json'
            }
        })
            .then(response => {
                const data = response.data
                this.cartTarget.remove()
                this.showSuccess(data)
            })

    }

    async clearSneaker(event)
    {
        event.preventDefault()

        const link = event.currentTarget
        const data = link.dataset

        const json = JSON.stringify({token: data.actionsTokenParam})

        const res = await axios.post(`${link.href}`, json, {
            headers: {
                'Content-Type': 'application/json'
            }
        })
            .then(response => {
                const data = response.data
                this.resetTarget.remove()
                this.showSuccess(data)
            })
    }

    showSuccess(data) {

        const state = document.querySelector('#state')

        if (data.success) {
            state.style.backgroundColor = "#059669"

            console.log(data)
            if (data.total) {
                console.log('fonctionne')
                this.totalTarget.textContent = `${data.total} €`
            }
        } else
            state.style.backgroundColor = "#e11d48"

        const spanElement = document.querySelector('#state span');

        spanElement.textContent = data.message;

        state.style.display = "block";


        setTimeout(function () {
            state.style.display = "none";
        }, 3000);

    }
}
