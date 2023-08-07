import React, {useState} from "react";
import SneakerCart from "../components/sneakerCart/sneakerCart";
import ResumeCart from "../components/detailsCart/resumeCart";


const CartPages = () => {

    const [sneaker, setSneaker] = useState(["fffff"])


    const snk = [
        {
            name: "Nike",
            price: 205,
            size: 40,
            amount: 1,
            img: ""
        },
        {
            name: "Jordan",
            price: 250,
            size: 40,
            amount: 1,
            img: ""
        },
        {
            name: "Adidas",
            price: 180,
            size: 40,
            amount: 1,
            img: ""
        },
        {
            name: "Puma",
            price: 160,
            size: 40,
            amount: 1,
            img: ""
        }
    ]


    return (
        <>
            <div className={"sneakers"}>
                {
                    snk.length > 0 &&
                    snk.map((value, index) => <SneakerCart key={index} sneaker={value}/>)
                }
            </div>


            {
                <ResumeCart/>
            }

        </>
    )
}

export default CartPages