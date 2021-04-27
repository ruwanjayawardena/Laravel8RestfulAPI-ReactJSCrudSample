import React, { component } from 'react';
//import ReactDOM from 'react-dom';
//import bootstrap from 'bootstrap';
import * as boostrapIcon from "react-icons/bs";
//import { Link } from 'react-router-dom';
import { Route, BrowserRouter as Router, Switch, Link } from "react-router-dom";
import Dashboard from './Pages/Dashboard';
import Maincategory from './Pages/Maincategory';
import Sub1category from './Pages/Sub1category';
import Sub2category from './Pages/Sub2category';
import Product from './Pages/Product';
import Samplepage from './Pages/Samplepage';
import './Fontawesome';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';

function Navbar() {
    return (
        <Router>
            <nav className="navbar navbar-expand-lg navbar-dark shadow sticky-top">            
            <div className="container-fluid">
                <a className="navbar-brand" href="#"><span className="fs-4 fw-bolder"><FontAwesomeIcon icon="desktop"/> Sinha Hardware</span><span className="fs-5 text-white"> POS</span></a>
                <button className="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span className="navbar-toggler-icon"></span>
                </button>
                <div className="collapse navbar-collapse" id="navbarNav">
                <ul className="navbar-nav text-center">
                    <li className="nav-item">
                        <Link to="/" className="nav-link active">
                            <FontAwesomeIcon icon="home" size="2x"/><br/>Home
                        </Link>                    
                    </li>
                    <li className="nav-item">
                        <Link to="/maincategory" className="nav-link">
                            <FontAwesomeIcon icon="sitemap" size="2x"/><br/>Main Category
                        </Link>        
                    </li>
                    <li className="nav-item">
                        <Link to="/sub1category" className="nav-link">
                            <FontAwesomeIcon icon="sitemap" size="2x"/><br/>Sub Category 1
                        </Link>
                    </li>               
                    <li className="nav-item">
                        <Link to="/Sub2category" className="nav-link">
                            <FontAwesomeIcon icon="sitemap" size="2x"/><br/>Sub Category 2
                        </Link>
                    </li>               
                    <li className="nav-item">
                        <Link to="/Product" className="nav-link">
                            <FontAwesomeIcon icon="sitemap" size="2x"/><br/>Product
                        </Link>
                    </li>               
                </ul>
                </div>
            </div>
            </nav>
            <Switch>
                <Route path="/maincategory" component={Maincategory}></Route>
                <Route path="/sub1category" component={Sub1category}></Route>
                <Route path="/Sub2category" component={Sub2category} ></Route>                
                <Route path="/Product" component={Product} ></Route>                
                <Route path="/" component={Dashboard}></Route>
            </Switch>
        </Router>
        
    );
}

export default Navbar

