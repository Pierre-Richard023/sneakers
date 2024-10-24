import React from 'react'
import {Provider} from "react-redux";
import store from "../store/store";
import SneakersPages from "../pages/SneakersPages/SneakersPages";


const SneakersController = ({id}) =>{

    return (
        <>
            <Provider store={store}>
                <SneakersPages id={id}/>
            </Provider>

        </>
    )
}


export default SneakersController