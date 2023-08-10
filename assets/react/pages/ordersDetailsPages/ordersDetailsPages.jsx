import React, {useEffect} from "react";
import {useDispatch, useSelector} from "react-redux";
import {getAddress, getTransporter, setPrice} from "../../store/slice/orderSlice";
import ResumeCart from "../../components/detailsCart/resumeCart";
import Payment from "../../components/payment/payment";

const OrdersDetailsPages = () => {

    const dispatch = useDispatch()
    const price = useSelector(state => state.order.price)
    const addressChoose = useSelector(state => state.order.addressChoose)
    const transporterChoose = useSelector(state => state.order.transporterChoose)
    const addressDetails = useSelector(state => state.order.addressDetails)
    const transporterDetails = useSelector(state => state.order.transporterDetails)
    const loadingAddressDetails = useSelector(state => state.order.loadingAddressDetails)
    const loadingTransporterDetails = useSelector(state => state.order.loadingTransporterDetails)
    const loadingCart = useSelector(state => state.order.loadingCart)
    const loadingSneakers = useSelector(state => state.order.loadingSneakers)

    useEffect(() => {
        dispatch(getAddress(addressChoose))
        dispatch(getTransporter(transporterChoose))
    }, []);


    return (
        <>

            <h2>Récapulatif de la commande </h2>
            <div className={"order-recap"}>
                <div className={"order-recap-details"}>
                    <div className={"details"}>
                        <h3>
                            Total de la Commande :
                        </h3>

                        {
                            transporterDetails &&

                            <p>
                                Frais de port : {transporterDetails.price} €
                            </p>

                        }

                        <p>
                            TOTAL : {price} €
                        </p>
                    </div>
                    <div className={"details"}>
                        <h3>
                            Adresse de Livraison :
                        </h3>

                        {
                            addressDetails &&
                            <div className={"sub-details"}>
                                {addressDetails.first_name + ' ' + addressDetails.last_name} <br/>
                                {
                                    addressDetails.company_name &&
                                    addressDetails.company_name + ' ' + <br/>
                                }
                                {addressDetails.address}<br/>
                                {
                                    addressDetails.additional_address &&
                                    addressDetails.additional_address + ' ' + <br/>
                                }
                                {addressDetails.postal_code + ' - ' + addressDetails.city}<br/>
                                {addressDetails.country}<br/>
                                {addressDetails.phone_number}<br/>
                            </div>
                        }

                    </div>
                </div>

                <ResumeCart/>
            </div>

            <Payment/>

        </>
    )
}

export default OrdersDetailsPages