import React, {useEffect} from 'react'
import {useDispatch, useSelector} from "react-redux";
import {chooseTransport} from "../../store/slice/orderSlice";

const Transporter = () => {

    const dispatch = useDispatch()
    const transporter = useSelector(state => state.order.transporter)
    const transporterChoose = useSelector(state => state.order.transporterChoose)

    return (
        <>
            <h3>Votre mode de livraison ?</h3>

            <ul className={"transporter-list"}>

                {
                    transporter.length > 0 &&
                    transporter.map((val, idx) =>

                        <li key={idx}>
                            <input type={"radio"} name={"transporter"} id={"transporter" + idx}
                                   defaultChecked={transporterChoose === val.id} readOnly
                                   onClick={(e) => dispatch(chooseTransport({id: val.id, price: val.price}))}
                            />
                            <label htmlFor={"transporter" + idx}>
                                <div className={"transporter-details"}>
                                    <h3>{val.name}</h3>
                                    <p>
                                        {val.description}
                                    </p>
                                </div>
                            </label>
                        </li>
                    )
                }
            </ul>


        </>
    )
}

export default Transporter