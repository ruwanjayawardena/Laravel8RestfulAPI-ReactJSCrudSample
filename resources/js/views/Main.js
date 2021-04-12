import React from 'react';
import ReactDOM from 'react-dom';
import Navbar from '../components/Navbar';
import Footer from './Footer';

function Main(){
    return (
        <div className="d-flex flex-column h-100">
            <main className="flex-shrink-0">
                <Navbar/>                                  
            </main> 
            <Footer/>
        </div>
    )
}

export default Main

const root = document.getElementById('app');
if (document.getElementById('app')) {
    ReactDOM.render(<Main/>,root);
}
