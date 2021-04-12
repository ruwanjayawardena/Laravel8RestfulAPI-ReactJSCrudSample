import React from 'react'

function Dashboard() {
    return (
        <div>
            <div className="px-4 pt-5 my-5 text-center border-bottom">
                <h1 className="display-4 fw-bold">
                <img src="https://lh3.googleusercontent.com/proxy/zqwa5Q58xgRMBdYAQsVyKhQZQ4wH3I3Vq3ncJ3FEuv3vc6cxbff2J5IBNIet3mN9j2wAB0hs_P17Kvha60aoqYMLwdKlRdXTFk3A9wK6PlUpiBQa_CZRBbXoPqZJ1t6nGvWrPR-BStSgi4Q2mg" width="100px"/>
                Welcome to Sinha Hardware<br/><span className="text-secondary fs-1 fw-lighter">Cloud Based Point Of Sale System</span></h1>
                <div className="col-lg-6 mx-auto">
                    <p className="lead mb-4">Desingned By Ruwan Jayawardena <span className="badge rounded-pill bg-dark">Full Stack Web App Engineer</span>  
                    <img src="https://www.wfd.org/wp-content/uploads/2019/10/LK-Sri-Lanka-Flag-icon.png" width="60px"/>
                    <img src="https://i.dlpng.com/static/png/6149190-download-canada-flag-free-png-transparent-image-and-clipart-canada-flag-transparent-400_400_preview.png" width="60px"/></p>
                    <div className="d-grid gap-2 d-sm-flex justify-content-sm-center mb-5">
                        <button type="button" className="btn btn-primary btn-lg px-4 me-sm-3 text-white">Go Home</button>
                        <button type="button" className="btn btn-outline-secondary btn-lg px-4">Learn More</button>               
                    </div>
                </div>            
            </div>
        </div>
    )
}

export default Dashboard

