import React, {useState} from "react";
import InformationsPages from "../pages/informationsPages/informationsPages";
import OrdersDetailsPages from "../pages/ordersDetailsPages/ordersDetailsPages";
import PaymentsPages from "../pages/paymentsPages/paymentsPages";

const OrdersController = () => {

    const [step, setStep] = useState(3)


    return (
        <>

            <p>Paiement de chaussures</p>

            {
                step === 1 &&
                <InformationsPages/>
            }

            {
                step === 2 &&
                <OrdersDetailsPages/>
            }

            {
                step === 3 &&
                <PaymentsPages/>
            }
        </>
    )
}


export default OrdersController