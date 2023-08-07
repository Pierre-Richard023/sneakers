import React from "react";
import Details from "../../components/payments/details";
import Payments from "../../components/payments/payments";


const PaymentsPages = () => {

    return (
        <>
            <div className={"payment"}>
                <h3>Paiement</h3>

                <Details />
                <Payments />
            </div>
        </>
    )
}

export default PaymentsPages