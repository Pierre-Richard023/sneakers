import React from "react";
import {useSelector} from "react-redux";
import InformationsPages from "../informationsPages/informationsPages";
import OrdersDetailsPages from "../ordersDetailsPages/ordersDetailsPages";
import OrderBottom from "../../components/orderBottom/orderBottom";


const OrderPages = () => {

    const step = useSelector(state => state.order.step)


    return (
        <>
            {
                step === 1 &&
                <InformationsPages/>
            }

            {
                step === 2 &&
                <OrdersDetailsPages/>
            }

            <OrderBottom />

        </>
    )
}

export default OrderPages