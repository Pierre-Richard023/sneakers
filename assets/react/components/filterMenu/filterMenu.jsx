import React, {useState} from 'react';
import {useDispatch, useSelector} from "react-redux";
import {sneakerColors} from "../../utils/data";
import {setFilter} from "../../store/slice/collectionsSlice";

const filterMenu = () => {

    const dispatch = useDispatch()
    const brands = useSelector(state => state.collections.brands)

    const initialState = {
        brands: [],
        colors: [],
        size: null,
    }
    const [formData, setFormData] = useState(initialState)

    const handleChange = (e) => {
        const {name, value, type, checked} = e.target

        if (type === 'checkbox') {
            setFormData((prevFormData) => ({
                ...prevFormData,
                [name]: checked
                    ? [...prevFormData[name], value]
                    : prevFormData[name].filter((item) => item !== value)
            }))
        } else {
            setFormData({
                ...formData,
                [name]: value
            })
        }
    }

    const handleReset = () => {
        setFormData(initialState)
    }

    const handleSubmit = (e) => {
        e.preventDefault()

        let link = ""

        if (formData.brands.length > 0) {
            link += "brands="
            formData.brands.forEach((brand, i) => {
                link += brand
                if (i <= formData.brands.length - 2)
                    link += ","
            })
        }

        if (formData.colors.length > 0) {
            link += (link.length > 0 ? "&color=" : "color=")

            formData.colors.forEach((color, i) => {
                link += color
                if (i <= formData.colors.length - 2)
                    link += ","
            })
        }

        if (formData.size !== null) {
            link += (link.length > 0 ? "&shoe_size=" : "shoe_size=") + formData.size
        }

        dispatch(setFilter(link))
    }

    return (
        <>
            <form
                onSubmit={handleSubmit}
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


                    <div id="accordion-flush" data-accordion="collapse"
                         data-active-classes="bg-white text-gray-900"
                         data-inactive-classes="text-gray-500 dark:text-gray-400"
                    >
                        <h2 id="accordion-flush-heading-1">
                            <button type="button"
                                    className="flex items-center justify-between w-full py-5 font-medium rtl:text-right text-gray-500 border-b border-gray-200 gap-3"
                                    data-accordion-target="#accordion-flush-body-1" aria-expanded="true"
                                    aria-controls="accordion-flush-body-1">
                                <span>Marque</span>
                                <svg data-accordion-icon="" className="w-3 h-3 rotate-180 shrink-0 "
                                     aria-hidden="true"
                                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" strokeLinecap="round" strokeLinejoin="round"
                                          strokeWidth="2" d="M9 5 5 1 1 5"/>
                                </svg>
                            </button>
                        </h2>
                        <div id="accordion-flush-body-1" className="hidden" aria-labelledby="accordion-flush-heading-1">
                            <div className="w-full py-5 border-b border-gray-200 flex flex-wrap gap-4">


                                {
                                    brands.map((brand, index) => (
                                        <div key={index} className="flex items-center">
                                            <input
                                                id={brand.name}
                                                type="checkbox" name="brands"
                                                value={brand.id}
                                                onChange={handleChange}
                                                className="w-4 h-4 bg-gray-100 border-gray-300 rounded text-blue-600 focus:ring-blue-500 focus:ring-2"
                                            />
                                            <label
                                                htmlFor={brand.name}
                                                className="ml-2 text-sm font-medium text-gray-900 "
                                            >
                                                {brand.name}
                                            </label>
                                        </div>
                                    ))
                                }

                            </div>
                        </div>
                        <h2 id="accordion-flush-heading-2">
                            <button type="button"
                                    className="flex items-center justify-between w-full py-5 font-medium rtl:text-right text-gray-500 border-b border-gray-200 gap-3"
                                    data-accordion-target="#accordion-flush-body-2" aria-expanded="false"
                                    aria-controls="accordion-flush-body-2">
                                <span>Taille</span>
                                <svg data-accordion-icon="" className="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" strokeLinecap="round" strokeLinejoin="round"
                                          strokeWidth="2" d="M9 5 5 1 1 5"/>
                                </svg>
                            </button>
                        </h2>
                        <div id="accordion-flush-body-2" className="hidden" aria-labelledby="accordion-flush-heading-2">
                            <div className="py-5 border-b border-gray-200 ">
                                <ul className="grid w-full gap-2 grid-cols-4">


                                    {
                                        Array.from({length: 15}, (_, index) => 38 + index * 0.5).map((item, index) => (

                                            <li key={index}>

                                                <input type="radio" id={`size-${item}`} name="size"
                                                       value={item}
                                                       onChange={handleChange}
                                                       className="hidden peer"/>
                                                <label htmlFor={`size-${item}`}
                                                       className="inline-flex items-center justify-between w-full p-1 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 ">
                                                    <div className="w-full text-base text-center font-bold">
                                                        {item}
                                                    </div>
                                                </label>
                                            </li>
                                        ))
                                    }
                                </ul>


                            </div>
                        </div>
                        <h2 id="accordion-flush-heading-3">
                            <button type="button"
                                    className="flex items-center justify-between w-full py-5 font-medium rtl:text-right text-gray-500 border-b border-gray-200  gap-3"
                                    data-accordion-target="#accordion-flush-body-3" aria-expanded="false"
                                    aria-controls="accordion-flush-body-3">
                                <span>Couleur</span>
                                <svg data-accordion-icon="" className="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" strokeLinecap="round" strokeLinejoin="round"
                                          strokeWidth="2" d="M9 5 5 1 1 5"/>
                                </svg>
                            </button>
                        </h2>
                        <div id="accordion-flush-body-3" className="hidden" aria-labelledby="accordion-flush-heading-3">
                            <div className="py-5 border-b border-gray-200 ">


                                <ul className="grid w-full gap-4 grid-cols-4">
                                    {
                                        sneakerColors.map((color, index) => (
                                            <li key={index}>
                                                <input type="checkbox" name="colors" id={color.name}
                                                       value={color?.value}
                                                       onChange={handleChange}
                                                       className="hidden peer"/>
                                                <label htmlFor={color.name}
                                                       className={` inline-flex items-center justify-between w-full border-2 border-gray-400 rounded-lg cursor-pointer peer-checked:border-primary-dark bg-${color?.name}  `}
                                                >
                                                    <div
                                                        className={`w-full h-10 rounded-lg`}></div>
                                                </label>
                                            </li>
                                        ))
                                    }
                                </ul>


                            </div>
                        </div>
                    </div>


                    <div className="bottom-0 left-0 flex justify-center w-full pb-4 mt-6 space-x-4 md:px-4 md:absolute">
                        <button type="submit"
                                className="w-full px-5 py-2 text-xs font-medium text-center text-white rounded-lg bg-secondary-normal hover:bg-secondary-light focus:ring-4 focus:outline-none focus:ring-primary-300 ">
                            Appliquer des filtres
                        </button>
                        <button type="reset" onClick={handleReset}
                                className="w-full px-5 py-2 text-xs font-medium text-white bg-danger-normal border border-gray-200 rounded-lg focus:outline-none hover:bg-danger-light focus:z-10 focus:ring-4 focus:ring-gray-200 ">
                            Réinitialiser
                        </button>
                    </div>
                </div>
            </form>

        </>
    )
}


export default filterMenu
