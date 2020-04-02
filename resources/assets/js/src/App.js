import React from 'react'
import ReactDOM from 'react-dom'
import {BrowserRouter as Router, Switch, Route} from 'react-router-dom'

import Navbar from './Navbar'
import Sidebar from './Sidebar'
import Footer from './Footer'

import Home from './Home'
import LogoSlider from './LogoSlider'
import Orders from './Orders'
import Products from './Products'
import Category from './Category'

class App extends React.Component {
  constructor(props) {
    super(props)
  }

  render() {
    return (
      <Router>
        <div className="container-scroller">
          <Navbar />
          <div className="container-fluid page-body-wrapper">
            <Sidebar />
            <div className="main-panel">
              <div className="content-wrapper">
                <div className="row">
                  <Switch>
                    <Route path="/yonetim/siparisler">
                      <Orders />
                    </Route>
                    <Route path="/yonetim/urunler">
                      <Products />
                    </Route>
                    <Route path="/yonetim/kategoriler">
                      <Category />
                    </Route>
                    <Route path="/yonetim/logo-slider">
                      <LogoSlider />
                    </Route>
                    <Route path="/yonetim/anasayfa">
                      <Home />
                    </Route>
                    <Route path="/">
                      <Home />
                    </Route>
                  </Switch>
                </div>
              </div>
            </div>
          </div>
          <Footer />
        </div>
      </Router>
    )
  }
}

if (document.getElementById('root')) {
  ReactDOM.render(<App />, document.getElementById('root'))
}
