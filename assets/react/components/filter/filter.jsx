import React from 'react';
import FilterMenu from "../filterMenu/filterMenu";

const Filter = () => {


    return (
        <>
            <div className="flex items-center space-x-4">
                <button
                    type="button"
                    data-drawer-target="drawer-filter"
                    data-drawer-show="drawer-filter"
                    aria-controls="drawer-filter"
                    className="flex w-full items-center justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100       sm:w-auto"
                >
                    <svg
                        className="-ms-0.5 me-2 h-4 w-4"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        width={24}
                        height={24}
                        fill="none"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke="currentColor"
                            strokeLinecap="round"
                            strokeWidth={2}
                            d="M18.796 4H5.204a1 1 0 0 0-.753 1.659l5.302 6.058a1 1 0 0 1 .247.659v4.874a.5.5 0 0 0 .2.4l3 2.25a.5.5 0 0 0 .8-.4v-7.124a1 1 0 0 1 .247-.659l5.302-6.059c.566-.646.106-1.658-.753-1.658Z"
                        />
                    </svg>
                    Filtres
                    <svg
                        className="-me-0.5 ms-2 h-4 w-4"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        width={24}
                        height={24}
                        fill="none"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke="currentColor"
                            strokeLinecap="round"
                            strokeLinejoin="round"
                            strokeWidth={2}
                            d="m19 9-7 7-7-7"
                        />
                    </svg>
                </button>
                <button
                    id="sortFilterButton"
                    data-dropdown-toggle="sortFilter"
                    type="button"
                    className="flex w-full items-center justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100       sm:w-auto"
                >
                    <svg
                        className="-ms-0.5 me-2 h-4 w-4"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        width={24}
                        height={24}
                        fill="none"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke="currentColor"
                            strokeLinecap="round"
                            strokeLinejoin="round"
                            strokeWidth={2}
                            d="M7 4v16M7 4l3 3M7 4 4 7m9-3h6l-6 6h6m-6.5 10 3.5-7 3.5 7M14 18h4"
                        />
                    </svg>
                    Trier par
                    <svg
                        className="-me-0.5 ms-2 h-4 w-4"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        width={24}
                        height={24}
                        fill="none"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke="currentColor"
                            strokeLinecap="round"
                            strokeLinejoin="round"
                            strokeWidth={2}
                            d="m19 9-7 7-7-7"
                        />
                    </svg>
                </button>
                <div
                    id="sortFilter"
                    className="z-50 hidden w-40 divide-y divide-gray-100 rounded-lg bg-white shadow "
                    data-popper-placement="bottom"
                >
                    <ul
                        className="p-2 text-left text-sm font-medium text-gray-500 "
                        aria-labelledby="sortDropdownButton"
                    >
                        <li>
                            <a
                                href="#"
                                className="group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900   "
                            >
                                Le plus récent
                            </a>
                        </li>
                        <li>
                            <a
                                href="#"
                                className="group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900   "
                            >
                                Prix croissant
                            </a>
                        </li>
                        <li>
                            <a
                                href="#"
                                className="group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900   "
                            >
                                Prix décroissant
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <FilterMenu />
        </>
    )
}

export default Filter