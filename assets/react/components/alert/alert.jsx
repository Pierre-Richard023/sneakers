import React from 'react';
import {BadgeInfo, X} from 'lucide-react'

const Alert = ({message, type}) => {


    return (
        <>
            <div className={`fixed left-0 h-16 w-full flex justify-center `}>
                {/*${type === 'success' ? 'bg-success' : 'bg-danger'}*/}
                    <div id="favorites-alert"
                         className={` flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 transform -translate-x-1/2  `}
                         role="alert">
                        <BadgeInfo className={"flex-shrink-0 w-4 h-4"}/>
                        <span className="sr-only">Info</span>
                        <div className="ms-3 text-sm font-medium">
                            {message}
                        </div>
                        <button type="button"
                                className="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8   "
                                data-dismiss-target="#favorites-alert" aria-label="Close">
                            <span className="sr-only">Fermer</span>
                            <X className="w-4 h-4" aria-hidden="true"/>
                        </button>
                    </div>
            </div>


        </>
    )
}
export default Alert;