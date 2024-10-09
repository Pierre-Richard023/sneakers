import React, {useEffect} from 'react';
import Filter from "../../components/filter/filter";
import {useDispatch, useSelector} from "react-redux";
import {getSneakers} from "../../store/slice/collectionsSlice";
import SneakerCard from "../../components/sneakerCard/sneakerCard";
import Alert from "../../components/alert/alert";


const CollectionsPage = () => {

    const dispatch = useDispatch()

    const sneakers = useSelector(state => state.collections.sneakers)
    const alertAddFavorites = useSelector(state => state.collections.alertAddFavorite)
    const messageAlert=useSelector(state => state.collections.messageAlert)
    const alertType=useSelector(state => state.collections.alertType)


    useEffect(() => {
        dispatch(getSneakers())
    }, []);

    return (
        <>


            <div className="relative mx-auto max-w-screen-xl px-4 2xl:px-0">
                {
                    alertAddFavorites && <Alert message={messageAlert}  type={alertType}/>
                }

                <div className="mb-4 items-end justify-between space-y-4 sm:flex sm:space-y-0 md:mb-8">
                    <div>
                        <h2 className="mt-3 text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Collections
                            de sneakers</h2>
                    </div>
                    {/*<Filter/>*/}

                </div>


                <div className="mb-4 grid gap-4 sm:grid-cols-2 md:mb-8 lg:grid-cols-3 xl:grid-cols-4">

                    {
                        sneakers.map((sneaker, index) =>
                            <SneakerCard key={index} sneaker={sneaker}/>
                        )
                    }
                </div>

            </div>
        </>
    )
}

export default CollectionsPage;