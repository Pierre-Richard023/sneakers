import React from 'react'
import {useDispatch, useSelector} from "react-redux";
import {chooseAddress, setAddress} from "../../store/slice/orderSlice";

const Address = () => {

    const dispatch = useDispatch()
    const address = useSelector(state => state.order.address)
    const addressChoose = useSelector(state => state.order.addressChoose)

    console.log(address)

    return (
        <>
            <h3>Où livrons nous votre commande ?</h3>

            <div className={"address"}>
                <div className={"new"}>
                    <div className={"content"}>
                        <i className="ri-add-circle-line"></i>
                        <span>Ajouter une nouvelle adresse</span>
                    </div>
                </div>
            </div>

            <ul className={"address-list"}>

                {
                    address.length > 0 &&
                    address.map((val, idx) =>

                        <li key={idx}>
                            <input type={"radio"} name={"address"} id={"address" + idx} required={true}
                                   defaultChecked={addressChoose === val.id} readOnly
                                   onClick={(e) => dispatch(chooseAddress(val.id))}
                            />
                            <label htmlFor={"address" + idx}>
                                <div className={"address-details"}>
                                    {val.first_name + ' ' + val.last_name} <br/>
                                    {
                                        val.company_name &&
                                        val.company_name + ' ' + <br/>
                                    }
                                    {val.address}<br/>
                                    {
                                        val.additional_address &&
                                        val.additional_address + ' ' + <br/>
                                    }
                                    {val.postal_code} - {val.city}<br/>
                                    {val.country}<br/>
                                    {val.phone_number}<br/>
                                </div>
                            </label>
                        </li>
                    )
                }


            </ul>

        </>
    )
}

export default Address