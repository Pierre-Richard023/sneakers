import axios from "axios";
import {API_URL_SNEAKER} from "../utils/links";

export const getCartDetails = async () => {

    const url = `${window.location.origin}/panier/details`

    return await axios.get(url).then(response => {

        const res = []
        const data = response.data.cart
        const total = response.data.total


        Object.keys(data).forEach(prop => {
            res.push({
                'sneakerId': prop,
                'qty': data[prop],
            })
        });

        return { cart : res, total }
    })

}


export const getSneakerDetails = async (cart) => {

    const cartL=cart.join('&id[]=')
    const url = `${API_URL_SNEAKER}?id[]=${cartL}`

    return await axios.get(url).then(response => response.data )

}