import React, {useEffect, useState} from 'react'
import {useDispatch, useSelector} from "react-redux";
import {getKeyPaymentIntent} from "../../store/slice/orderSlice";
import Card from "./card/card";


const Payment = () => {

    const dispatch = useDispatch()
    const keyPaymentIntent = useSelector(state => state.order.keyPaymentIntent)
    const price = useSelector(state => state.order.price)
    const [already, setAlready] = useState(false)

    useEffect(() => {
        if (price > 0 && !already) {
            dispatch(getKeyPaymentIntent(price))
            setAlready(true)
        }

    }, [price, setAlready]);

    return (
        <>
            <div className={"payment"}>
                <h3>
                    Paiement par Carte Bancaire
                </h3>
                <div className={"card"}>

                    <Card paymentIntent={keyPaymentIntent}/>

                </div>
            </div>
        </>
    )
}


export default Payment