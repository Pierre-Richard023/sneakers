import React from 'react';

const filterMenu = () =>{




    return(
        <>
            <form
                action="#"
                method="get"
                id="drawer-filter"
                className="fixed top-0 left-0 z-40 h-screen w-[320px] p-4 overflow-y-auto transition-transform -translate-x-full bg-white "
                tabIndex={-1}
                aria-labelledby="drawer-label"
            >
                <h5
                    id="drawer-label"
                    className="inline-flex items-center mb-4 text-base font-semibold text-gray-500 uppercase "
                >
                    Appliquer des filtres
                </h5>
                <button
                    type="button"
                    data-drawer-dismiss="drawer-filter"
                    aria-controls="drawer-filter"
                    className="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center  "
                >
                    <svg
                        aria-hidden="true"
                        className="w-5 h-5"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            fillRule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clipRule="evenodd"
                        />
                    </svg>
                    <span className="sr-only">Fermer le menu</span>
                </button>
                <div className="">
                    <div
                        id="accordion-flush"
                        data-accordion="collapse"
                        data-active-classes="bg-white text-gray-900 "
                        data-inactive-classes="text-gray-500 "
                    >
                        <h2 id="accordion-flush-heading-1">
                            <button
                                type="button"
                                className="flex items-center justify-between w-full py-5 font-medium rtl:text-right text-gray-500 border-b border-gray-200  gap-3"
                                data-accordion-target="#accordion-flush-body-1"
                                aria-expanded="true"
                                aria-controls="accordion-flush-body-1"
                            >
                                <span>Marque</span>
                                <svg
                                    data-accordion-icon=""
                                    className="w-3 h-3 rotate-180 shrink-0"
                                    aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 10 6"
                                >
                                    <path
                                        stroke="currentColor"
                                        strokeLinecap="round"
                                        strokeLinejoin="round"
                                        strokeWidth={2}
                                        d="M9 5 5 1 1 5"
                                    />
                                </svg>
                            </button>
                        </h2>
                        <div
                            id="accordion-flush-body-1"
                            className="hidden"
                            aria-labelledby="accordion-flush-heading-1"
                        >
                            <div className="py-5 border-b border-gray-200 ">
                                <div className="flex items-center">
                                    <input
                                        id="tv"
                                        type="checkbox"
                                        defaultValue=""
                                        className="w-4 h-4 bg-gray-100 border-gray-300 rounded text-blue-600 focus:ring-blue-500   focus:ring-2  "
                                    />
                                    <label
                                        htmlFor="tv"
                                        className="ml-2 text-sm font-medium text-gray-900 "
                                    >
                                        TV, Audio-Video
                                    </label>
                                </div>
                            </div>
                        </div>
                        <h2 id="accordion-flush-heading-2">
                            <button
                                type="button"
                                className="flex items-center justify-between w-full py-5 font-medium rtl:text-right text-gray-500 border-b border-gray-200   gap-3"
                                data-accordion-target="#accordion-flush-body-2"
                                aria-expanded="false"
                                aria-controls="accordion-flush-body-2"
                            >
                                <span>Taille</span>
                                <svg
                                    data-accordion-icon=""
                                    className="w-3 h-3 rotate-180 shrink-0"
                                    aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 10 6"
                                >
                                    <path
                                        stroke="currentColor"
                                        strokeLinecap="round"
                                        strokeLinejoin="round"
                                        strokeWidth={2}
                                        d="M9 5 5 1 1 5"
                                    />
                                </svg>
                            </button>
                        </h2>
                        <div
                            id="accordion-flush-body-2"
                            className="hidden"
                            aria-labelledby="accordion-flush-heading-2"
                        >
                            <div className="py-5 border-b border-gray-200 ">
                                <ul className="grid w-full gap-6 md:grid-cols-3">
                                    <li>
                                        <input
                                            type="checkbox"
                                            id="react-option"
                                            defaultValue=""
                                            className="hidden peer"
                                            required=""
                                        />
                                        <label
                                            htmlFor="react-option"
                                            className="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer   peer-checked:border-blue-600 hover:text-gray-600  peer-checked:text-gray-600 hover:bg-gray-50   "
                                        >
                                            <div className="block">1</div>
                                        </label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <h2 id="accordion-flush-heading-3">
                            <button
                                type="button"
                                className="flex items-center justify-between w-full py-5 font-medium rtl:text-right text-gray-500 border-b border-gray-200   gap-3"
                                data-accordion-target="#accordion-flush-body-3"
                                aria-expanded="false"
                                aria-controls="accordion-flush-body-3"
                            >
                                <span>Couleur</span>
                                <svg
                                    data-accordion-icon=""
                                    className="w-3 h-3 rotate-180 shrink-0"
                                    aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 10 6"
                                >
                                    <path
                                        stroke="currentColor"
                                        strokeLinecap="round"
                                        strokeLinejoin="round"
                                        strokeWidth={2}
                                        d="M9 5 5 1 1 5"
                                    />
                                </svg>
                            </button>
                        </h2>
                        <div
                            id="accordion-flush-body-3"
                            className="hidden"
                            aria-labelledby="accordion-flush-heading-3"
                        >
                            <div className="py-5 border-b border-gray-200 "></div>
                        </div>
                    </div>
                </div>
            </form>

        </>
    )
}


export default filterMenu
