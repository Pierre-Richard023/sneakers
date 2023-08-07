import React from "react";
import Address from "../../components/informations/Address";
import Shipping from "../../components/informations/shipping";


const InformationsPages = () => {

    return (
        <>
            <div className={"informations"}>
                <Address/>

                <Shipping/>
            </div>
        </>
    )
}


export default InformationsPages