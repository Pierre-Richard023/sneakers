import React, {useState, useEffect} from 'react';
import {BadgeInfo, X} from 'lucide-react'
import {useDispatch, useSelector} from "react-redux";
import {hideAddFavorites} from "../../store/slice/collectionsSlice";

const Alert = ({message, status}) => {

    const dispatch = useDispatch();
    const alertAddFavorite = useSelector(state => state.collections.alertAddFavorite)
    const [progress, setProgress] = useState(100)

    useEffect(() => {
        const interval = setInterval(() => {
            setProgress(prevProgress => (prevProgress > 0 ? prevProgress - 1 : 0));
        }, 30);
        return () => clearInterval(interval);
    }, []);

    useEffect(() => {
        if (progress === 0) {
            dispatch(hideAddFavorites())
        }
    }, [progress]);


    if (!alertAddFavorite)
        return null

    return (
        <>

            <div className={`fixed top-16 right-8 md:right-32 z-50`}>
                <div
                    className={` rounded-lg ${status === 'success' ? 'bg-success-dark text-white' : 'bg-danger-dark text-white'} `}
                    role="alert">

                    <div className={"flex items-center gap-4 p-4"}>
                        <BadgeInfo className={"flex-shrink-0 w-4 h-4"}/>
                        <span className="sr-only">Information</span>
                        <div className="ms-3 text-sm font-medium">
                            {message}
                        </div>
                        <button type="button" onClick={() => dispatch(hideAddFavorites())}
                                className={`ms-auto -mx-1.5 -my-1.5 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 inline-flex items-center justify-center h-8 w-8 ${status === 'success' ? 'hover:bg-success-light text-white' : 'hover:bg-danger-light text-white'}   `}
                                aria-label="Close">
                            <span className="sr-only">Close</span>
                            <X className="w-4 h-4" aria-hidden="true"/>
                        </button>
                    </div>

                    <div className="w-full h-2 rounded-lg overflow-hidden">
                        <div
                            className={`${status === 'success' ? 'bg-success-light' : 'bg-danger-light'} h-full transition-all duration-75`}
                            style={{width: `${progress}%`}}
                        ></div>
                    </div>

                </div>

            </div>

        </>
    )
}
export default Alert;