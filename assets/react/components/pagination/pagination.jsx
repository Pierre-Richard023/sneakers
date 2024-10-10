import React, {useEffect} from 'react'
import {useDispatch, useSelector} from "react-redux";
import {ChevronLeft, ChevronRight} from "lucide-react";
import {getSneakers, goPages, nextPages, previousPages} from "../../store/slice/collectionsSlice";

const Pagination = () => {


    const dispatch = useDispatch()

    const currentPage = useSelector(state => state.collections.currentPage)
    const nbPages = useSelector(state => state.collections.nbPages)



    return (
        <>
            <div className="w-full flex justify-center ">
                <nav aria-label="Page navigation example">
                    <ul className="flex items-center -space-x-px h-8 text-sm">

                        {
                            currentPage > 1 &&
                            <li>
                                <button type="button" onClick={() => dispatch(previousPages())}
                                        className="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700     ">
                                    <span className="sr-only">Précédent</span>
                                    <ChevronLeft className="w-4 h-4 rtl:rotate-180" aria-hidden="true"/>
                                </button>
                            </li>
                        }


                        {Array.from({length: nbPages}, (_, index) => (
                            <li key={index + 1}>
                                <button type="button" onClick={() => dispatch(goPages(index + 1))}
                                        className={`flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 ${(index + 1) === currentPage ? "text-secondary-normal" : ""}  `}>
                                    {index + 1}
                                </button>
                            </li>
                        ))}

                        {
                            currentPage < nbPages &&
                            <li>
                                <button type="button" onClick={() => dispatch(nextPages())}
                                        className="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700     ">
                                    <span className="sr-only">Suivant</span>
                                    <ChevronRight className="w-4 h-4 rtl:rotate-180" aria-hidden="true"/>
                                </button>
                            </li>
                        }


                    </ul>
                </nav>
            </div>
        </>
    )
}


export default Pagination