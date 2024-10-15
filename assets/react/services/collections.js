import axios from "axios";
import {API_URL_SNEAKER, API_URL_BRANDS} from "../utils/links";

export const getSneakersService = async (filter, page, sort) => {

    return await axios.get(`${API_URL_SNEAKER}?${filter}${filter.length === 0 ? '':'&'}order[${sort.champ}]=${sort.by}&page=${page}`).then((response) => response.data)
}

export const getBrandsService = async () => {
    return await axios.get(`${API_URL_BRANDS}`).then((response) => response.data)
}
