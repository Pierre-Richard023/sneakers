import {Controller} from '@hotwired/stimulus';

export default class extends Controller {

    static targets = ["upload", "input", "images", "delete"]

    files = []

    connect() {
    }

    async upload() {

        for (const file of this.inputTarget.files) {
            if (!this.files.find(f => f.name === file.name && f.size === file.size)) {
                this.files.push(file)
                this.showFile(file)

                const dataTransfer = new DataTransfer()
                for (const f of this.files) {
                    await dataTransfer.items.add(f)
                }

                this.inputTarget.files = await dataTransfer.files
            }
        }
    }


    showFile(file) {

        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                const imageUrl = e.target.result;

                const imageElement = document.createElement("img");
                imageElement.src = imageUrl;
                imageElement.className = "relative"


                const divElement = document.createElement("div")
                divElement.className = "relative"
                divElement.appendChild(imageElement)

                const buttonElement = document.createElement("button")
                buttonElement.type = "button"
                buttonElement.className = "absolute top-0 right-0 text-white bg-red-700 hover:bg-white hover:text-red-700 hover:ring-1 hover:ring-red-700 rounded-full p-2 mr-2 mt-2"

                buttonElement.addEventListener('click', () => {
                    this.deleteFile(file)
                    divElement.remove()
                })

                const iconSvg = document.createElementNS("http://www.w3.org/2000/svg", "svg")
                const iconPath = document.createElementNS("http://www.w3.org/2000/svg", "path")

                iconSvg.setAttribute('fill', 'none')
                iconSvg.setAttribute('viewBox', '0 0 24 24')
                iconSvg.setAttribute('stroke-width', '1.5')
                iconSvg.setAttribute('stroke', 'currentColor')
                iconSvg.classList.add('w-4')
                iconSvg.classList.add('h-4')

                iconPath.setAttribute(
                    'd',
                    'M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0'
                )
                iconPath.setAttribute('stroke-linecap', 'round')
                iconPath.setAttribute('stroke-linejoin', 'round')


                iconSvg.appendChild(iconPath)
                buttonElement.appendChild(iconSvg)
                divElement.appendChild(imageElement);
                divElement.appendChild(buttonElement)
                this.imagesTarget.appendChild(divElement);
            };

            reader.readAsDataURL(file);
        }

        console.log(this.files)

    }

    async deleteFile(file) {
        this.files = this.files.filter(f => f.name !== file.name || f.size !== file.size)

        const dataTransfer = new DataTransfer()
        for (const f of this.files) {
            await dataTransfer.items.add(f)
        }
        this.inputTarget.files = await dataTransfer.files
    }


    deleteImage(event) {
        event.preventDefault()
        const obj = event.currentTarget

        if (confirm("Voulez-vous supprimer cette image (elle sera définitivement supprimer) ? ")) {

            let xhr = new XMLHttpRequest()

            xhr.onreadystatechange = () => {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    console.log(xhr.responseText);
                }
            }

            const url = window.location.origin + obj.getAttribute("href")

            xhr.open("DELETE", url, true);
            xhr.setRequestHeader("Content-Type", "application/json");

            let jsonData = JSON.stringify({'_token': obj.dataset.token});
            xhr.send(jsonData);

        }

    }
}
