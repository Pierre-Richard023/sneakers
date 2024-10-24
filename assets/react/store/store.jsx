import {configureStore} from '@reduxjs/toolkit'
import orderReducer from './slice/orderSlice'
import collectionsReducer from './slice/collectionsSlice'
import sneakerReducer from "./slice/sneakerSlice";

export default configureStore({
    reducer: {
        order: orderReducer,
        collections: collectionsReducer,
        sneaker: sneakerReducer,
    }
})