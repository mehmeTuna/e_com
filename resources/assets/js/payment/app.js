import React from 'react'
import ReactDOM from 'react-dom'

import 'react-credit-cards/es/styles-compiled.css'
import Cards from 'react-credit-cards'
import Popup from 'reactjs-popup'

require('./../bootstrap')

window.React = require('react')

const Modal = ({children}) => (
  <Popup
    contentStyle={{maxWidth: '700px', width: '90%'}}
    trigger={<div className="btn proceed-btn">Odeme Yap </div>}
    modal
    closeOnDocumentClick
  >
    {children}
  </Popup>
)

export default class App extends React.Component {
  constructor(props) {
    super(props)

    this.state = {
      cvc: '',
      expiry: '',
      focus: '',
      name: '',
      number: ''
    }
    this.handleInputFocus = this.handleInputFocus.bind(this)
    this.handleInputChange = this.handleInputChange.bind(this)
  }

  handleInputFocus(e) {
    this.setState({focus: e.target.name})
  }

  handleInputChange(e) {
    const {name, value} = e.target

    this.setState({[name]: value})
  }
  render() {
    return (
      <>
        <Modal>
          <div id="PaymentForm" className="row my-2">
            <div className="d-none d-sm-block col-6">
              <Cards
                cvc={this.state.cvc}
                expiry={this.state.expiry}
                focused={this.state.focus}
                name={this.state.name}
                number={this.state.number}
              />
            </div>
            <div className="col-sm-12 col-md-6 col-lg-6">
              <form>
                <input
                  className="form-control mb-2"
                  type="tel"
                  name="number"
                  placeholder="Kart Numarasi"
                  onChange={this.handleInputChange}
                  onFocus={this.handleInputFocus}
                />
                <input
                  className="form-control mb-2"
                  type="tel"
                  name="name"
                  placeholder="Kart Uzerindeki isim"
                  onChange={this.handleInputChange}
                  onFocus={this.handleInputFocus}
                />
                <div className="row mb-2">
                  <div className="col-6">
                    <input
                      className="form-control"
                      type="tel"
                      name="expiry"
                      placeholder="12/22"
                      onChange={this.handleInputChange}
                      onFocus={this.handleInputFocus}
                    />
                  </div>
                  <div className="col-6">
                    <input
                      className="form-control"
                      type="tel"
                      name="cvc"
                      placeholder="cvv"
                      onChange={this.handleInputChange}
                      onFocus={this.handleInputFocus}
                    />
                  </div>
                </div>
                <div className="d-flex justify-content-end pr-2">
                  <button type="button" className="btn btn-primary">
                    Odeme Yap
                  </button>
                </div>
              </form>
            </div>
          </div>
        </Modal>
      </>
    )
  }
}

if (document.getElementById('PaymentForm')) {
  ReactDOM.render(<App />, document.getElementById('PaymentForm'))
}
