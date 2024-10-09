import {createAsyncThunk, createSlice} from "@reduxjs/toolkit"
import {getSneakersService} from "../../services/collections";
import {setAddress} from "./orderSlice";


export const getSneakers = createAsyncThunk('collections/getSneakers', async () => {
    return await getSneakersService()
})

export const addFavorites = createAsyncThunk('collections/addFavorites', async (id) => {
    return await null
})

export const collectionsSlice = createSlice({
    name: "collections",
    initialState: {
        loading: false,
        sneakers: [],
        page: 1,
        nbItems: 0,
        alertAddFavorite: false,
        messageAlert:"",
        alertType:"",

    },
    extraReducers: (builder) => {

        builder.addCase(getSneakers.pending, (state, action) => {
            state.loading = true
        })
        builder.addCase(getSneakers.fulfilled, (state, action) => {
            state.sneakers = action.payload['hydra:member']
            state.nbItems = action.payload['hydra:totalItems']
            state.loading = false
        })

        builder.addCase(addFavorites.pending, (state, action) => {
            state.loading = true
            console.log('fontionne ldd')

        })
        builder.addCase(addFavorites.fulfilled, (state, action) => {
            state.alertAddFavorite = true
            state.messageAlert="Fonctionne correctement "
            state.alertType="success"
            state.loading = false
        })
    }
})


// export const {} = collectionsSlice.actions


export default collectionsSlice.reducer