import axios from "axios";
import {API_URL_SNEAKER} from "../utils/links";

export const getSneakersService = async (page=1) =>{


    return await axios.get(`${API_URL_SNEAKER}?page=${page}`  ).then((response) => response.data)
}