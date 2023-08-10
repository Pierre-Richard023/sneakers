import axios from "axios";
import {API_URL_USER, API_URL_TRANSPORTER, API_URL_ADDRESS} from "../utils/links";

export const getAddressUser = async () => {
    return await axios.get(API_URL_USER).then(response => response.data)

}

export const getAddressById = async (id) => {
    return await axios.get(`${API_URL_ADDRESS}/${id}`).then(response => response.data)
}

export const getAllTransporter = async () => {
    return await axios.get(API_URL_TRANSPORTER).then(response => response.data)
}

export const getTransporterById = async (id) => {
    return await axios.get(`${API_URL_TRANSPORTER}/${id}`).then(response => response.data)
}