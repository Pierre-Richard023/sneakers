import React from "react";

const Loading = () => {

    return (
        <>
            <div className="h-32 my-4">
                <div className="flex justify-center items-center h-full">
                    <div className="flex items-center justify-center space-x-2">
                        <div className="w-16 h-16 rounded-full animate-pulse bg-primary-normal"></div>
                        <div className="w-16 h-16 rounded-full animate-pulse bg-primary-normal"></div>
                        <div className="w-16 h-16 rounded-full animate-pulse bg-primary-normal"></div>
                    </div>
                </div>
            </div>
        </>
    )
}

export default Loading