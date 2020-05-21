import React from 'react'
import Axios from 'axios'
import Swal from 'sweetalert2'
import withReactContent from 'sweetalert2-react-content'

const sweet = withReactContent(Swal)

function deleteProduct(id, name) {
  sweet.fire(`${name} ürünü silmek istediğinize eminmisiniz ?`).then(result => {
    if (typeof result.value != undefined && result.value === true) {
      Axios.post('/product/delete', {
        id: id
      }).then(e => {
        window.location.reload()
      })
    }
  })
}

const ProductList = ({products}) => {
  return (
    <div className="col-12 grid-margin stretch-card">
      <div className="card">
        <div className="card-body">
          <h4 className="card-title">Urun Listesi</h4>
          <p className="card-description">
            Toplam Urun Sayisi: {products.length}
          </p>
          <p>
            Detaylar pop icerisinde gosterilecek ve o kisimda duzenlenebilir
            olabilecek
          </p>
          <div className="table-responsive pt-3">
            <table className="table table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Kod</th>
                  <th>img</th>
                  <th>Adi</th>
                  <th>Fiyati</th>
                  <th>stok</th>
                  <th>minimum siparis</th>
                  <th>Kategori</th>
                </tr>
              </thead>
              <tbody>
                {products.length > 0 &&
                  products.map((e, key) => (
                    <tr key={key}>
                      <td>
                        <i
                          style={{cursor: 'pointer'}}
                          onClick={() => deleteProduct(e.id, e.name)}
                          className="icon-trash"
                        ></i>
                      </td>
                      <td>{e.code}</td>
                      <td>
                        <img src={e.img} className="rounded d-block" />
                      </td>
                      <td>{e.name}</td>
                      <td>{e.price}</td>
                      <td>{e.stok}</td>
                      <td>{e.minorders}</td>
                      <td>{e.category}</td>
                    </tr>
                  ))}
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  )
}

export default ProductList
