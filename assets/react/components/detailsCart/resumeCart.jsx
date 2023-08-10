import React, {useEffect} from "react";
import {getCartDetails} from "../../services/cartService";
import {useDispatch, useSelector} from "react-redux";
import {getCart, getSneakerCart, setPrice} from "../../store/slice/orderSlice";
import SneakerCart from "../sneakerCart/sneakerCart";

const ResumeCart = () => {

    const dispatch = useDispatch()
    const cart = useSelector(state => state.order.cart)
    const sneakers = useSelector(state => state.order.sneakers)


    useEffect(()=>{
        dispatch(getCart())
    },[])

    useEffect(()=>{
        if(cart.length > 0){
            dispatch(setPrice())

            const sneakersId=[]
            for(const c of cart)
            {
                sneakersId.push(c.sneakerId)
            }
            dispatch(getSneakerCart(sneakersId))
        }
    },[cart])

    return (
        <>
            <div className="sneakers">
                {
                    sneakers.length > 0 &&

                    sneakers.map((sneaker ,id)=>
                        <SneakerCart key={id} sneaker={sneaker} />
                    )

                }
            </div>
        </>
    )
}


export default ResumeCart