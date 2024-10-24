import {createAsyncThunk, createSlice} from "@reduxjs/toolkit";
import {getSneakerbyIdService} from "../../services/sneaker";
import {getSneakers} from "./collectionsSlice";


export const getSneakerById = createAsyncThunk("sneaker/getSneakerById", async (sneakerId) => {

    return await getSneakerbyIdService(sneakerId)
})


export const sneakerSlice = createSlice({
    name: "sneaker",
    initialState: {
        sneaker: {},
        loadingSneaker: false,

    },
    reducers: {},
    extraReducers: (builder) => {

        builder.addCase(getSneakerById.pending, (state) => {
            state.loadingSneaker = true
        })
        builder.addCase(getSneakerById.fulfilled, (state, action) => {
            state.loadingSneaker = false
            state.sneaker = action.payload['hydra:member'][0]
        })
    }
})


export const {} = sneakerSlice.actions

export default sneakerSlice.reducer
