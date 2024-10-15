import React, {useEffect} from 'react';
import Filter from "../../components/filter/filter";
import {useDispatch, useSelector} from "react-redux";
import {getBrands, getSneakers} from "../../store/slice/collectionsSlice";
import SneakerCard from "../../components/sneakerCard/sneakerCard";
import Alert from "../../components/alert/alert";
import Pagination from "../../components/pagination/pagination";
import Loading from "../../components/loading/loading";


const CollectionsPage = () => {

    const dispatch = useDispatch()

    const sneakers = useSelector(state => state.collections.sneakers)
    const sortBy = useSelector(state => state.collections.sortBy)
    const currentPage = useSelector(state => state.collections.currentPage)
    const filter = useSelector(state => state.collections.filter)
    const needSearch = useSelector(state => state.collections.needSearch)
    const loadingSneaker = useSelector(state => state.collections.loadingSneaker)
    const alertAddFavorites = useSelector(state => state.collections.alertAddFavorite)
    const messageAlert = useSelector(state => state.collections.messageAlert)
    const alertStatus = useSelector(state => state.collections.alertStatus)


    useEffect(() => {
        dispatch(getBrands())
    }, []);

    useEffect(() => {
        if (needSearch)
            dispatch(getSneakers({page: currentPage, filter: filter, sort: sortBy}))
    }, [currentPage, sortBy, filter]);

    return (
        <>

            <div className="relative mx-auto max-w-screen-xl px-4 2xl:px-0">
                {
                    alertAddFavorites && <Alert message={messageAlert} status={alertStatus}/>
                }

                <div className="mb-4 items-end justify-between space-y-4 sm:flex sm:space-y-0 md:mb-8">
                    <div>
                        <h2 className="mt-3 text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">
                            Collections de sneakers
                        </h2>
                    </div>
                    <Filter/>
                </div>

                {
                    loadingSneaker && <Loading/>
                }

                {
                    !loadingSneaker &&
                    <>
                        <div className="mb-4 grid gap-4 sm:grid-cols-2 md:mb-8 lg:grid-cols-3 xl:grid-cols-4">
                            {
                                sneakers.map((sneaker, index) =>
                                    <SneakerCard key={index} sneaker={sneaker}/>
                                )
                            }
                        </div>
                    </>
                }
                <Pagination/>

            </div>
        </>
    )
}

export default CollectionsPage;