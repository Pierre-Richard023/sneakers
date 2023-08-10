import React from "react";
import {useDispatch, useSelector} from "react-redux";
import {backStep, nextStep} from "../../store/slice/orderSlice";

const OrderBottom = () => {

    const dispatch = useDispatch()
    const step = useSelector(state => state.order.step)
    const transporterChoose = useSelector(state => state.order.transporterChoose)
    const addressChoose = useSelector(state => state.order.addressChoose)


    const next = (event) => {

        if (addressChoose && transporterChoose) {
            dispatch(nextStep())
        }

    }

    const back = (event) => {
        dispatch(backStep())
    }

    return (
        <>
            <div className={"actions"}>

                {
                    step > 1 &&
                    <>
                        <button type={"button"} onClick={back}>
                            Etape précédente
                        </button>
                    </>

                }

                {
                    step < 2 &&
                    <>
                        <button type={"button"} onClick={next}>
                            {
                                step === 1 &&
                                <span>
                            Étape suivante
                        </span>
                            }

                        </button>
                    </>

                }
            </div>
        </>
    )
}

export default OrderBottom