import React from "react";


const Shipping = () => {

    const mode = [
        {
            name: 'Livraison Standard',
            description: 'En cas d\'imposibilité votre colis sera mis à votre disposition au bureau de poste dont vous dépendez .',
            price: 15
        },
        {
            name: 'Livraison Express',
            description: 'En cas d\'absence votre colis sera mis en instance auprés d\'un point de retrait. ',
            price: 54
        }
    ]


    return (
        <>
            <h3>Votre mode de livraison ?</h3>

            <div className={"shipping"}>
                {
                    mode.length > 0 &&

                    mode.map((val, idx) =>
                        <div className={"mode"} key={idx}>
                            <h3>{val.name}</h3>
                            <p>
                                {val.description}
                            </p>
                        </div>
                    )

                }
            </div>

        </>
    )
}

export default Shipping