import React, {useEffect} from 'react'
import {useDispatch, useSelector} from "react-redux";
import {getSneakerById} from "../../store/slice/sneakerSlice";
import {ShoppingCart, Heart} from 'lucide-react'
import CarouselSlider from "../../components/carouselSlider/carouselSlider";
import Loading from "../../components/loading/loading";

const SneakersPages = ({id}) => {

    const dispatch = useDispatch()
    const sneaker = useSelector(state => state.sneaker.sneaker)
    const loadingSneaker = useSelector(state => state.sneaker.loadingSneaker)


    useEffect(() => {
        dispatch(getSneakerById(id))
    }, [])

    console.log(sneaker)
    const sizeHandleChange = (e) => {


    }

    return (
        <>
            {
                loadingSneaker && <Loading/>
            }
            {
                !loadingSneaker &&
                <div className="max-w-screen-xl px-4 mx-auto 2xl:px-0">
                    <div className="lg:grid lg:grid-cols-2 lg:gap-8 xl:gap-16">
                        <div className="shrink-0 max-w-md lg:max-w-lg mx-auto">
                            <CarouselSlider images={sneaker?.images}/>
                        </div>

                        <div className="mt-6 sm:mt-8 lg:mt-0">
                            <h1 className="text-xl font-semibold text-gray-900 sm:text-2xl ">
                                {sneaker?.name}
                            </h1>
                            <div className="mt-4 sm:items-center sm:gap-4 sm:flex">
                                <p className="text-2xl font-extrabold text-gray-900 sm:text-3xl ">
                                    {sneaker?.price} €
                                </p>
                            </div>
                            <div className="mt-6 sm:mt-8">
                                <h3 className="text-lg mb-4 font-semibold text-gray-900">Sélectionner la taille :</h3>
                                <div className="w-full">
                                    <ul className="grid w-full gap-2 grid-cols-4">

                                        {
                                            Array.from({length: 15}, (_, index) => 38 + index * 0.5).map((item, index) => (

                                                <li key={index}>
                                                    <input type="radio" id={`size-${item}`} name="size"
                                                           value={item}
                                                           onChange={sizeHandleChange}
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

                            <div className="mt-6 sm:gap-4 sm:items-center sm:flex sm:mt-8">
                                <button
                                    title="Ajouter dans les favoris"
                                    className="flex items-center gap-2 justify-center py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-secondary-normal focus:z-10 focus:ring-4 focus:ring-gray-100      "
                                    role="button"
                                >
                                    <Heart className="w-5 h-5"/>
                                    Ajouter aux favoris
                                </button>

                                <button
                                    title="Ajouter dans le panier"
                                    className=" flex items-center gap-2 justify-center  text-white mt-4 sm:mt-0 bg-secondary-normal hover:bg-secondary-light focus:ring-4 focus:ring-secondary-dark font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none"
                                    role="button"
                                >
                                    <ShoppingCart className="w-5 h-5"/>
                                    Ajouter au panier
                                </button>
                            </div>

                            <hr className="my-6 md:my-8 border-gray-200 "/>

                            <p className="mb-6 text-gray-500 ">
                                {
                                    sneaker?.details
                                }
                            </p>

                            <ul>
                                <li>
                                    Couleur affichée : {sneaker?.color}
                                </li>
                                <li>
                                    Article : {sneaker?.article_number}
                                </li>
                            </ul>


                        </div>
                    </div>
                </div>
            }

        </>
    )
}

export default SneakersPages