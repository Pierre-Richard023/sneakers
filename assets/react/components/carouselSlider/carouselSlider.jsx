import React, {useState} from "react";
import {Swiper, SwiperSlide} from 'swiper/react'
import {FreeMode, Navigation, Thumbs} from 'swiper/modules'
import 'swiper/css'
import 'swiper/css/free-mode'
import 'swiper/css/navigation'
import 'swiper/css/thumbs'

const CarouselSlider = ({images}) => {

    const [thumbsSwiper, setThumbsSwiper] = useState(null)


    return (
        <>
            <Swiper
                style={{
                    '--swiper-navigation-color': '#fff',
                    '--swiper-pagination-color': '#fff',
                }}
                spaceBetween={10}
                navigation={false}
                thumbs={{swiper: thumbsSwiper}}
                modules={[FreeMode, Navigation, Thumbs]}
                className="mySwiper2"
            >
                {
                    images?.map((image, index) => (
                        <SwiperSlide key={index}>
                            <img src={image?.imageUrl} alt={` sneaker view ${index}`}/>
                        </SwiperSlide>
                    ))
                }


            </Swiper>
            <Swiper
                onSwiper={setThumbsSwiper}
                spaceBetween={10}
                slidesPerView={3}
                freeMode={false}
                watchSlidesProgress={false}
                modules={[FreeMode, Navigation, Thumbs]}
                className="mySwiper"
            >

                {
                    images?.map((image, index) => (
                        <SwiperSlide key={index}>
                            <img src={image?.imageUrl} alt={` logo`}/>
                        </SwiperSlide>
                    ))
                }

            </Swiper>
        </>
    )
}

export default CarouselSlider