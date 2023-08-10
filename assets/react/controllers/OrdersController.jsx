import React, {useState} from "react";
import {Provider} from "react-redux";
import store from "../store/store";
import OrderPages from "../pages/OrderPages/OrderPages";

const OrdersController = () => {

    const [step, setStep] = useState(3)


    return (

        <Provider store={store}>
            <OrderPages/>
        </Provider>
    )
}


export default OrdersController