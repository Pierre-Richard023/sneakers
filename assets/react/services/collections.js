import axios from "axios";
import {API_URL_SNEAKER,API_URL_BRANDS} from "../utils/links";

export const getSneakersService = async (page = 1) => {

    return await axios.get(`${API_URL_SNEAKER}?page=${page}`).then((response) => response.data)
}

export const getBrandsService = async () => {
    return await axios.get(`${API_URL_BRANDS}`).then((response) => response.data)
}
