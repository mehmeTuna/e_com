import React from 'react'

import CheckBoxFormDialog from './checkbox-form-dialog'

export default class ChexBoxOption extends React.Component {
  constructor(props) {
    super(props)

    this.state = {
      title: '',
      price: 1,
      showDialog: false
    }
  }

  render() {
    return (
      <>
        {this.state.showDialog && (
          <CheckBoxFormDialog
            open={this.state.showDialog}
            setOpen={() => this.setState({showDialog: !this.state.showDialog})}
            setData={this.props.addCheckBox}
          />
        )}
        <div className="mx-auto">
          <p className="lead">
            Bu kisimdaki opsiyonlar fiyati etkiler, Opsiyon ile birlikte yeni
            fiyatini giriniz
          </p>
          <button
            type="button"
            className="btn btn-primary font-weight-bold mt-2 ml-2"
            onClick={() => this.setState({showDialog: !this.state.showDialog})}
          >
            <span className="badge">
              <i className="icon-circle-plus"></i>
            </span>
            <span>Opsiyon Ekle</span>
          </button>
          {this.props.checkBoxList.length > 0 &&
            this.props.checkBoxList.map((e, key) => (
              <button
                key={key}
                onClick={() => this.props.deleteCheckBox(key)}
                className="btn btn-success mt-2 ml-2"
              >
                <span className="badge">
                  <i className="icon-trash"></i>
                </span>
                <span>opsiyon:{e.title}</span>
                <br />
                <span>Fiyat: {e.price}</span>
              </button>
            ))}
        </div>
      </>
    )
  }
}
