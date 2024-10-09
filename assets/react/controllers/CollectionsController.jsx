import React from 'react';
import CollectionsPage from "../pages/CollectionsPages/CollectionsPage";
import store from "../store/store";
import {Provider} from "react-redux";


const CollectionsController = (props) => {


    return (
        <>
            <Provider store={store}>
                <CollectionsPage/>
            </Provider>
        </>
    )
}

export default CollectionsController;
