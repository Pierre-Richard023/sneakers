import React from "react";


const Details = () => {

    const sneakers = [
        {
            name: 'Nike',
            price: 180,
            amount: 1,
            size: 44
        },
        {
            name: 'Adidas',
            price: 180,
            amount: 1,
            size: 44
        },
        {
            name: 'Puma',
            price: 180,
            amount: 4,
            size: 44
        },

    ]


    return (
        <>
            <div className={"details"}>
                <h3 className={"subtitle"}>Votre panier</h3>
                <div className={"sneakers"}>
                    {
                        sneakers.length > 0 &&

                        sneakers.map((val, idx) =>
                            <div className={"sneaker"} key={idx}>
                                <div className={"image"}>

                                </div>
                                <div className={"snkr-informations"}>
                                    <div>
                                        <h3>{val.name}</h3>
                                    </div>
                                    <div>
                                        <span>Prix unitaire : {val.price}€</span>
                                        <span>qté : {val.amount}</span>
                                        <span>Prix : {val.amount * val.price}€</span>
                                    </div>
                                </div>
                            </div>
                        )
                    }
                </div>

                <hr/>

                <div className={"price"}>
                    <div className={"prc-details"}>
                        <div className={""}>
                            <span>Sous-total panier :</span>
                            <span>180 €</span>
                        </div>
                        <div className={""}>
                            <span>Livraison</span>
                            <span>15 €</span>
                        </div>
                    </div>
                    <hr/>
                    <div className={""}>
                        <span>Total </span>
                        <span>195 €</span>
                    </div>
                </div>
            </div>
        </>
    )
}

export default Details