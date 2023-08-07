import React from "react";


const SneakerCart = ({sneaker}) => {


    return (
        <>
            <div className={"sneaker-cart"}>
                <div className={"sneaker-image"}>
                    <img src={sneaker?.img} alt={sneaker?.name}/>
                </div>
                <div className={"sneaker-infs"}>
                    <div className={"details"}>
                        <div className={"name"}>
                            <a href={"#"}>{sneaker?.name}</a>
                            <p>Taille : {sneaker?.size}</p>
                            <p>Quantité : {sneaker?.amount}</p>
                        </div>
                        <div className={"price"}>
                            <span>{sneaker?.price} €</span>
                        </div>
                    </div>
                    <div className={"actions"}>
                        <button>
                            <i className="ri-heart-line"></i>
                        </button>
                        <button>
                            <i className="ri-delete-bin-5-line"></i>
                        </button>
                    </div>
                </div>
            </div>
        </>
    )
}


export default SneakerCart