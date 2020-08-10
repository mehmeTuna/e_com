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
  console.log(products)
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
                  <th>Adi</th>
                  <th>Content</th>
                  <th>Gorsel</th>
                  <th>Kayit Tarihi</th>
                  <th>Kategoriler</th>
                  <th>Opsiyonlar</th>
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
                      <td>{e.name}</td>
                      <td>{e.content}</td>
                      <td>
                        <img src={e.img} className="rounded d-block" />
                      </td>
                      <td>{e.created_at}</td>
                      <td>
                        {e.categories.length > 0 &&
                          e.categories.map((e, key) => (
                            <>
                              <p key={key}>Ad: {e.category.name} </p>{' '}
                              <hr className="m-0" />
                            </>
                          ))}
                      </td>
                      <td>
                        {e.features_items.length > 0 &&
                          e.features_items.map((e, key) => (
                            <>
                              <div key={key}>
                                <p>ad: {e.name}</p>
                                <hr className="m-0" />
                                <p>adet: {e.quantity}</p>
                                <hr className="m-0" />
                                <p>min adet: {e.min_order}</p>
                                <hr className="m-0" />
                                <p>fiyat: {e.price}</p>
                              </div>
                              <hr className="m-0 border border-danger border-bottom" />
                            </>
                          ))}
                      </td>
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
