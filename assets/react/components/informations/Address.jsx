import React from 'react'

const Address = () => {


    const adrs = [
        {
            name: 'Pierre-Richard BEBE',
            street: '14 rue des awaras',
            additional: 'Residence les palmiers',
            city: 'Macouria',
            zip: '97355',
            country: 'Guyane',
            tel:'0694057552'

        },
        {
            name: 'Pierre-Richard BEBE',
            street: '2 chemins des moulin',
            additional: 'Residence Universitaires',
            city: 'Reims',
            zip: '51000',
            country: 'France',
            tel:'0694057552'

        }
    ]


    return (
        <>
            <h3>Où livrons nous votre commande ?</h3>

            <div className={"address"}>
                <div className={"new"}>
                    <div className={"content"}>
                        <i className="ri-add-circle-line"></i>
                        <span>Ajouter une nouvelle adresse</span>
                    </div>
                </div>
                {
                    adrs.length > 0 &&
                    adrs.map((val, idx) =>
                        <div key={idx} className={"actual"}>
                            {val.name} <br/>
                            {val.street}<br/>
                            {val.additional}<br/>
                            {val.zip} - {val.city}<br/>
                            {val.country}<br/>
                            {val.tel}<br/>
                        </div>
                    )
                }
            </div>

        </>
    )
}

export default Address