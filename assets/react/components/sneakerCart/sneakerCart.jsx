import React, {useEffect, useState} from "react";
import {useSelector} from "react-redux";


const SneakerCart = ({sneaker}) => {

    const cart = useSelector(state => state.order.cart)
    const [qty, setQty] = useState(0)

    useEffect(() => {
        if (cart.length > 0) {
            const objetTrouve = cart.find(c => c.sneakerId == sneaker.id)
            setQty(objetTrouve.qty)
        }

    }, [cart]);

    return (
        <>
            <div className={"sneaker"}>
                <div className={"image"}>
                    <img src={`${window.location.origin}/images/sneakers/profiles/${sneaker?.imageName}`} alt={sneaker?.name}
                    />
                </div>
                <div className={"snkr-informations"}>
                    <div>
                        <h3>{sneaker?.name}</h3>
                        <span>Taille : {sneaker?.shoe_size}</span>
                    </div>
                    <div>
                        <span>Prix unitaire : {sneaker?.price}€</span>
                        <span>qté : {qty}</span>
                        <span>Prix : {qty * sneaker?.price}€</span>
                    </div>
                </div>
            </div>
        </>
    )
}


export default SneakerCart