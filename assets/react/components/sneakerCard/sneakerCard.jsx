import React from 'react';
import {useDispatch} from "react-redux";
import {addFavorites} from "../../store/slice/collectionsSlice";


const SneakerCard = ({sneaker}) => {

    const dispatch = useDispatch()

    const urlOrigin = window.location.origin



    return (
        <>

            <div className="rounded-lg border border-gray-200 bg-white p-6 shadow-sm  ">
                <div className="h-56 w-full">
                    <img className="mx-auto h-full " src={sneaker?.profileImageUrl}
                         alt={` ${sneaker?.name} logo`}/>
                </div>
                <div className="pt-6 text-center">
                    <div className="mb-4 flex items-center flex-row-reverse  gap-4">
                        <div className="flex items-center justify-end gap-1">
                            <button type="button" onClick={ () => dispatch(addFavorites(sneaker?.id))} data-tooltip-target="tooltip-add-to-favorites"
                                    className="rounded-lg p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-900   ">
                                <span className="sr-only"> Add to Favorites </span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     strokeWidth={1.5} stroke="currentColor" className="h-5 w-5">
                                    <path strokeLinecap="round" strokeLinejoin="round"
                                          d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"/>
                                </svg>
                            </button>
                            <div id="tooltip-add-to-favorites" role="tooltip"
                                 className="tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 "
                                 data-popper-placement="top">
                                Ajouter au favoris
                                <div className="tooltip-arrow" data-popper-arrow=""></div>
                            </div>
                        </div>
                    </div>

                    <a href={`${urlOrigin}/collections/sneakers/${sneaker?.slug}`}
                        className="text-lg font-semibold leading-tight text-gray-900 hover:underline ">
                        {sneaker?.name}
                    </a>

                    <div className="mt-4 text-center">
                    <p className="text-2xl font-extrabold leading-tight text-gray-900 ">
                            {sneaker?.price} €
                        </p>
                    </div>
                </div>
            </div>


        </>
    )
}


export default SneakerCard