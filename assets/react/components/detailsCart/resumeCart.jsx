import React from "react";

const ResumeCart = () => {


    return (
        <>
            <div className="resume-cart">
                <h2>Récapitulatif</h2>
                <div className="resume-details">
                    <div className="">
                        <p className="">Sous-total</p>
                        <p className="">$99.98</p>
                    </div>
                    <hr className=""/>
                    <div className="">
                        <p className="">Total</p>
                        <p className="">$103.88</p>
                    </div>
                    <div className="resume-actions">
                        <a href={"#"} >Passer la commande</a>
                    </div>
                </div>
            </div>
        </>
    )
}


export default ResumeCart