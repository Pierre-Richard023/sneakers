import axios from "axios";
import {API_URL_SNEAKER} from "../utils/links";

export const getSneakerbyIdService = async (id) => {

    return await axios.get(`${API_URL_SNEAKER}?id=${id}`).then((response) => response.data)
}


