import {Controller} from '@hotwired/stimulus';
import axios from "axios";

export default class extends Controller {
    connect() {
        console.log('fontionne Ajax 5')
    }

    filter(event) {
        event.preventDefault()
        console.log(event)
        const form = event.target

        const formData = new FormData(form)
        //
        // const params=new URLSearchParams();
        //
        // formData.forEach((value,key)=>{
        //     params.append(key,value);
        // });
        //
        // console.log(params)


        fetch('/traiter-formulaire', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                console.log(data.message);
            })
            .catch(error => {
                console.error('Une erreur s\'est produite:', error);
            });

    }
}
