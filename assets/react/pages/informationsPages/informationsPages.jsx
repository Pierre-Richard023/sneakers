import React, {useEffect} from "react";
import Address from "../../components/informations/Address";
import Transporter from "../../components/informations/transporter";
import {useDispatch, useSelector} from "react-redux";
import Loading from "../../components/loading/loading";
import {setAddress, setPrice, setTransporter} from "../../store/slice/orderSlice";


const InformationsPages = () => {

    const dispatch=useDispatch()
    const loadingAddress = useSelector(state => state.order.loadingAddress)
    const loadingTransporter = useSelector(state => state.order.loadingTransporter)


    useEffect(() => {
        dispatch(setAddress())
        dispatch(setTransporter())
    }, []);


    return (
        <>

            {
                (!loadingAddress && !loadingTransporter) &&

                <div className={"informations"}>
                    <Address/>

                    <Transporter/>
                </div>
            }

            {
                (loadingAddress || loadingTransporter) &&

                <Loading/>
            }


        </>
    )
}


export default InformationsPages