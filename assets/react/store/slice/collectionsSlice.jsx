import {createAsyncThunk, createSlice} from "@reduxjs/toolkit"
import {getBrandsService, getSneakersService} from "../../services/collections";
import axios from "axios";


export const getSneakers = createAsyncThunk('collections/getSneakers', async (filter) => {
    return await getSneakersService(filter.filter, filter.page, filter.sort)
})

export const getBrands = createAsyncThunk('collections/getBrands', async () => {
    return await getBrandsService()
})

export const addFavorites = createAsyncThunk('collections/addFavorites', async (id, {rejectWithValue}) => {

    try {
        const url = window.location.origin
        return await axios.post(`${url}/collections/add-favorites`, {
            sneakerId: id
        }).then(response => response.data)
    } catch (error) {
        if (error.response && error.response.data) {
            return rejectWithValue(error.response.data);
        } else {
            return rejectWithValue({status: 'error', message: 'Une erreur est survenue'});
        }
    }

})

export const collectionsSlice = createSlice({
    name: "collections",
    initialState: {
        loading: false,
        loadingSneaker: false,
        loadingAlert: false,
        sneakers: [],
        brands: [],
        filter: "",
        brandsFilter: [],
        sneakerSizeFilter: null,
        sneakerColorFilter: [],
        currentPage: 1,
        nbPages: 1,
        sortBy: {
            champ: 'release_date',
            by: 'desc',
        },
        needSearch: true,
        hasData: false,
        alertAddFavorite: false,
        messageAlert: "",
        alertStatus: "",
        error: null,
    },
    reducers: {

        hideAddFavorites: (state) => {
            state.alertAddFavorite = false
        },
        nextPages: (state) => {
            if (state.currentPage < state.nbPages) {
                state.currentPage = state.currentPage + 1
                state.needSearch = true
            }
        },
        previousPages: (state) => {
            if (state.currentPage > 1) {
                state.currentPage = state.currentPage - 1
                state.needSearch = true
            }
        },
        goPages: (state, action) => {
            if (Number.isInteger(action.payload))
                if (action.payload !== state.currentPage)
                    if (action.payload <= state.nbPages && action.payload >= 1) {
                        state.currentPage = action.payload
                        state.needSearch = true
                    }

        },
        sortBy: (state, action) => {

            if (action.payload === 'increasing_price') {
                state.sortBy.champ = 'price'
                state.sortBy.by = 'asc'
            } else if (action.payload === 'decreasing_price') {
                state.sortBy.champ = 'price'
                state.sortBy.by = 'desc'
            } else if (action.payload === 'most_recent') {
                state.sortBy.champ = 'date'
                state.sortBy.by = 'desc'
            }
            state.needSearch = true

        },
        setFilter: (state, action) => {
            state.filter = action.payload
            state.needSearch = true
        }
    },
    extraReducers: (builder) => {

        builder.addCase(getSneakers.pending, (state, action) => {
            state.loadingSneaker = true
        })
        builder.addCase(getSneakers.fulfilled, (state, action) => {
            state.loadingSneaker = false
            state.needSearch = false
            state.sneakers = action.payload['hydra:member']
            let nbRst = action.payload['hydra:totalItems']
            state.nbPages = Math.ceil(nbRst / 12)
        })

        builder.addCase(getBrands.pending, (state, action) => {
            state.loading = true
        })
        builder.addCase(getBrands.fulfilled, (state, action) => {
            state.loading = false
            state.brands = action.payload['hydra:member']
        })


        builder.addCase(addFavorites.pending, (state, action) => {
            state.loadingAlert = true;
            state.messageAlert = ""
            state.alertStatus = ""
        })

        builder.addCase(addFavorites.fulfilled, (state, action) => {
            state.alertAddFavorite = true
            state.messageAlert = action.payload.message
            state.alertStatus = action.payload.status
            state.loadingAlert = false
            state.error = null
        })

        builder.addCase(addFavorites.rejected, (state, action) => {
            state.loadingAlert = false
            state.alertAddFavorite = true
            state.messageAlert = action.payload.message || 'Une erreur est survenue'
            state.alertStatus = 'error'
            state.error = action.payload
        });
    }
})


export const {
    hideAddFavorites, nextPages,
    previousPages, goPages,
    sortBy, setFilter
} = collectionsSlice.actions


export default collectionsSlice.reducer