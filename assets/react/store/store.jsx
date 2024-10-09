import { configureStore } from '@reduxjs/toolkit'
import orderReducer  from './slice/orderSlice'
import collectionsReducer  from './slice/collectionsSlice'

export default configureStore({
    reducer: {
        order: orderReducer,
        collections:collectionsReducer,
    }
})