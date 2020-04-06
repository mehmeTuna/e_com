import {React} from 'react'
import Axios from 'axios'

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

const ProductList = () => {
  return <div>Listeleme kismi</div>
}

export default ProductList
