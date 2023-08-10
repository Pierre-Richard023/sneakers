import {createAsyncThunk, createSlice} from "@reduxjs/toolkit"
import axios from "axios";
import {getAddressById, getAddressUser, getAllTransporter, getTransporterById} from "../../services/apiService";
import {getCartDetails, getSneakerDetails} from "../../services/cartService";

export const getKeyPaymentIntent = createAsyncThunk('order/getKeyPaymentIntent', async (price) => {
    const json = JSON.stringify({price})
    return await axios.post(`${window.location.origin}/commandes/paymentKey`, json, {
        headers: {
            'Content-Type': 'application/json'
        }
    })
        .then(response => response.data)

})

export const setAddress = createAsyncThunk('order/setAddress', async () => {
    return await getAddressUser()
})

export const getAddress = createAsyncThunk('order/getAddress', async (id) => {
    return await getAddressById(id)
})

export const setTransporter = createAsyncThunk('order/setTransporter', async () => {
    return await getAllTransporter()
})

export const getTransporter = createAsyncThunk('order/getTransporter', async (id) => {
    return await getTransporterById(id)
})

export const getCart = createAsyncThunk('order/getCart', async () => {
    return await getCartDetails()
})

export const getSneakerCart = createAsyncThunk('order/getSneakerCart', async (cart) => {
    return await getSneakerDetails(cart)
})

export const orderSlice = createSlice({
    name: 'order',
    initialState: {
        keyPaymentIntent: null,
        step: 1,
        price: 0,
        address: [],
        addressChoose: null,
        addressDetails: null,
        transporter: [],
        transporterChoose: null,
        transporterDetails: null,
        sneakers: [],
        cart: [],
        totalCart: 0,
        priceTransporter: 0,
        loadingKeyPayment: false,
        loadingAddress: false,
        loadingAddressDetails: false,
        loadingTransporter: false,
        loadingTransporterDetails: false,
        loadingCart: false,
        loadingSneakers: false,


    },
    reducers: {
        chooseAddress: (state, action) => {
            state.addressChoose = action.payload
        },
        chooseTransport: (state, action) => {
            state.transporterChoose = action.payload.id
            state.priceTransporter = action.payload.price
        },
        nextStep: (state) => {
            state.step++
        },
        backStep: (state) => {
            state.step--
        },
        setPrice: (state) => {
            state.price = state.totalCart + state.priceTransporter
        }

    },
    extraReducers: (builder) => {

        builder.addCase(setAddress.pending, (state, action) => {
            state.loadingAddress = true
        })
        builder.addCase(setAddress.fulfilled, (state, action) => {
            state.address = action.payload['hydra:member'][0].delivery_address
            state.loadingAddress = false
        })
        builder.addCase(getAddress.pending, (state, action) => {
            state.loadingAddressDetails = true
        })
        builder.addCase(getAddress.fulfilled, (state, action) => {
            state.addressDetails = action.payload
            state.loadingAddressDetails = false
        })
        builder.addCase(setTransporter.pending, (state, action) => {
            state.loadingTransporter = true
        })
        builder.addCase(setTransporter.fulfilled, (state, action) => {
            state.transporter = action.payload['hydra:member']
            state.loadingTransporter = false
        })
        builder.addCase(getTransporter.pending, (state, action) => {
            state.loadingTransporterDetails = true
        })
        builder.addCase(getTransporter.fulfilled, (state, action) => {
            state.transporterDetails = action.payload
            state.loadingTransporterDetails = false
        })
        builder.addCase(getCart.pending, (state, action) => {
            state.loadingCart = true
        })
        builder.addCase(getCart.fulfilled, (state, action) => {
            state.cart = action.payload.cart
            state.totalCart = action.payload.total
            state.loadingCart = false
        })
        builder.addCase(getSneakerCart.pending, (state, action) => {
            state.loadingSneakers = true
        })
        builder.addCase(getSneakerCart.fulfilled, (state, action) => {
            state.sneakers = action.payload['hydra:member']
            state.loadingSneakers = false
        })
        builder.addCase(getKeyPaymentIntent.pending, (state, action) => {
            state.loadingKeyPayment = true
        })
        builder.addCase(getKeyPaymentIntent.fulfilled, (state, action) => {
            state.keyPaymentIntent = action.payload.clientSecret
            state.loadingKeyPayment = false
        })

    }
})

export const {
    chooseAddress, chooseTransport,
    nextStep, backStep,
    setPrice,
} = orderSlice.actions

export default orderSlice.reducer