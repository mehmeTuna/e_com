import React from 'react'
import Swal from 'sweetalert2'
import withReactContent from 'sweetalert2-react-content'
import axios from 'axios'

const sweet = withReactContent(Swal)

export default class Orders extends React.Component {
  constructor(props) {
    super(props)

    this.state = {
      page: 'wait',
      orders: []
    }
    this.orderDelete = this.orderDelete.bind(this)
    this.orderconfirm = this.orderconfirm.bind(this)
    this.pageUpdate = this.pageUpdate.bind(this)
  }

  async componentDidMount() {
    const {data} = await axios.get('/orders')

    if (data.status === true) {
      //this.setState({orders: data.data})
    }
  }

  pageUpdate() {
    this.setState({orders: orders.map(e => e.m_status == this.state.page)})
  }

  orderconfirm(id) {
    sweet
      .mixin({
        title: 'Kargo Firmasi ve Kargo takip numarasi giriniz',
        confirmButtonText: 'Ileri &rarr;',
        input: 'text',
        progressSteps: ['1', '2']
      })
      .queue(['Kargo Firmasi', 'Kargo Takip numarasi'])
      .then(result => {
        if (typeof result.value !== 'undefined') {
          if (result.value[0] === '' && result.value[1] === '') {
            sweet.fire({
              title: 'Gecerli degerler giriniz',
              timer: 1500
            })
            return
          }
          axios
            .post('/orders/update', {
              id: id,
              company: result.value[0],
              trackingNumber: result.value[1]
            })
            .then(result => {
              if (result.data.status === true) {
                window.location.reload()
              } else {
                sweet.fire('Siparis onaylanmadi')
              }
            })
        }
      })
  }

  async orderDelete(id) {
    const {data} = await axios.delete('/orders', {
      id: id
    })
    if (data.status === true) {
      sweet.fire('Siparis Iptal Edildi')
    } else {
      sweet.fire('Siparis Iptal Edilemedi')
    }
  }

  render() {
    return (
      <React.Fragment>
        {this.state.orders.length === 0 && (
          <h1 className="mx-auto mt-4 col-12 text-center">
            Siparis bulunamadi.
          </h1>
        )}
        {this.state.orders.length > 0 && (
          <React.Fragment>
            <div className="container mb-4">
              <div className="row">
                <div className="col-sm text-center">
                  <button type="button" className="btn btn-primary">
                    Gelen Siparisler
                  </button>
                </div>
                <div className="col-sm text-center">
                  <button type="button" className="btn btn-success">
                    Onaylanan Siparisler
                  </button>
                </div>
                <div className="col-sm text-center">
                  <button type="button" className="btn btn-secondary">
                    Iptal Olan Siparisler
                  </button>
                </div>
              </div>
            </div>
            <div className="col-lg-12 grid-margin stretch-card">
              <div className="card">
                <div className="card-body">
                  <div className="d-flex justify-content-between">
                    {this.state.page === 'wait' && (
                      <h2 className="card-title">Gelen Siparisler</h2>
                    )}
                    {this.state.page === 'confirm' && (
                      <h2 className="card-title">Onaylanan Siparisler</h2>
                    )}
                    {this.state.page === 'cancel' && (
                      <h2 className="card-title">Iptal Olan Siparisler</h2>
                    )}
                    <p> Siparisler Toplam: {this.state.orders.length}</p>
                  </div>
                  <div className="table-responsive pt-3">
                    <table className="table table-bordered">
                      <thead>
                        <tr>
                          <th>Siparis Tarihi</th>
                          <th>Siparis Numarasi</th>
                          <th>Alici</th>
                          <th>Satici Stok Kodu</th>
                          <th>Urun Adi</th>
                          <th>Ozellikler</th>
                          <th>Adet</th>
                          <th>Birim Fiyati</th>
                          <th>Siparisleri Exel'e aktar</th>
                        </tr>
                      </thead>
                      <tbody>
                        {this.state.orders.map((val, key) => (
                          <tr key={key}>
                            <td>{val.created_at}</td>
                            <td> {val.order_id}</td>
                            <td className="text-center">{val.customer}</td>
                            <td> {val.productCode}</td>
                            <td> {val.productName}</td>
                            <td> {val.features}</td>
                            <td> {val.quantity}</td>
                            <td> {val.unitPrice}</td>
                            <td>
                              <button
                                type="button"
                                className="btn btn-success m-1"
                                onClick={() => this.orderconfirm(val.id)}
                              >
                                Siparisi Onayla
                              </button>
                              <button
                                type="button"
                                className="btn btn-warning m-1"
                                onClick={() => this.orderDelete(val.id)}
                              >
                                Siparisi Iptal Et
                              </button>
                            </td>
                          </tr>
                        ))}
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </React.Fragment>
        )}
      </React.Fragment>
    )
  }
}
