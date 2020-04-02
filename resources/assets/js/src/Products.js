import React from 'react'
import Axios from 'axios'
import {Redirect} from 'react-router-dom'

export default class Products extends React.Component {
  constructor(props) {
    super(props)

    this.state = {
      allCategory: [],
      category: '',
      name: '',
      code: '',
      quantity: '',
      content: '',
      img: [],
      redirect: null,
      height: '',
      size: '',
      price: '',
      width: '',
      features: '',
      weight: '',
      product: []
    }

    this.handleChange = this.handleChange.bind(this)
    this.handleSubmit = this.handleSubmit.bind(this)
    this.getProductList = this.getProductList.bind(this)
    this.deleteProduct = this.deleteProduct.bind(this)
  }

  async componentDidMount() {
    this.getProductList()
  }

  async handleSubmit() {
    if (
      this.state.name === '' ||
      this.state.category === '' ||
      this.state.quantity === '' ||
      this.state.quantity == 0 ||
      this.state.img.length === 0 ||
      this.state.price === '' ||
      this.state.price == 0 ||
      this.state.features <= 0
    ) {
      this.setState({alert: true})
      return
    }

    let formData = new FormData()
    formData.set('name', this.state.name)

    if (this.state.img.length > 0) {
      for (let a = 0; a < this.state.img.length; a++) {
        formData.set('img' + a, this.state.img[a].file)
      }
    }

    formData.set('category', this.state.category)
    formData.set('quantity', this.state.quantity)
    formData.set('price', this.state.price)
    formData.set('cardText', this.state.content)
    formData.set('code', this.state.code)
    formData.set('features', this.state.features)

    const {data} = await Axios.post('/product/create', formData, {
      headers: {
        'content-type': 'multipart/form-data' // do not forget this
      }
    })

    if (data.status === true) {
      this.setState({redirect: '/yonetim/urunler'})
    }
  }

  async getProductList() {
    const {data} = await Axios.post('/product/list')

    if (data.status === true) {
      this.setState({product: data.data})
    }
  }

  async deleteProduct(id) {
    const {data} = await Axios.post('/product/delete', {
      id: id
    })

    if (data.status === true) {
      window.location.reload()
    }
  }

  handleChange(event) {
    if (this.state.img.length >= 4) return
    let images = this.state.img
    images.push({
      url: URL.createObjectURL(event.target.files[0]),
      file: event.target.files[0]
    })
    this.setState({
      img: images
    })
  }

  render() {
    if (this.state.redirect) {
      return <Redirect to={this.state.redirect} />
    }
    return (
      <React.Fragment>
        <div className="col-12 grid-margin stretch-card">
          <div className="card">
            <div className="card-body">
              <h4 className="card-title">Ürün Ekleme</h4>
              <p className="card-description">
                Eklemek istediğiniz ürünün detaylarını giriniz
              </p>
              <form className="forms-sample">
                <div className="form-group">
                  <label
                    className={
                      this.state.alert === true && this.state.name === ''
                        ? 'text-danger'
                        : ''
                    }
                  >
                    Ürün Adı
                  </label>
                  <input
                    type="text"
                    className="form-control"
                    placeholder="Ürün Adı"
                    value={this.state.name}
                    onChange={e => this.setState({name: e.target.value})}
                  />
                </div>
                <div className="form-group">
                  <label
                    className={
                      this.state.alert === true && this.state.coded === ''
                        ? 'text-danger'
                        : ''
                    }
                  >
                    Ürün Kodu
                  </label>
                  <input
                    type="text"
                    className="form-control"
                    placeholder="Ürün Kodu"
                    value={this.state.code}
                    onChange={e => this.setState({code: e.target.value})}
                  />
                </div>
                <div className="form-group">
                  <label
                    className={
                      this.state.alert === true && this.state.features === ''
                        ? 'text-danger'
                        : ''
                    }
                  >
                    Minimum Sipariş Adeti
                  </label>
                  <input
                    type="number"
                    className="form-control"
                    placeholder="Minimum Sipariş Adeti"
                    value={this.state.features}
                    onChange={e =>
                      this.setState({
                        features: e.target.value <= 0 ? 1 : e.target.value
                      })
                    }
                  />
                </div>
                <div className="form-group">
                  <label
                    className={
                      this.state.alert === true && this.state.quantity === ''
                        ? 'text-danger'
                        : ''
                    }
                  >
                    Ürün Adedi
                  </label>
                  <input
                    type="number"
                    className="form-control"
                    placeholder="Ürün Adedi"
                    value={this.state.quantity}
                    onChange={e =>
                      this.setState({
                        quantity: e.target.value <= 0 ? 1 : e.target.value
                      })
                    }
                  />
                </div>
                <div className="form-group">
                  <label
                    className={
                      this.state.alert === true && this.state.price === ''
                        ? 'text-danger'
                        : ''
                    }
                  >
                    Ürün Fiyatı
                  </label>
                  <input
                    type="number"
                    min="0"
                    className="form-control"
                    placeholder="Ürün Fiyatı"
                    value={this.state.price}
                    onChange={e =>
                      this.setState({
                        price: e.target.value <= 0 ? 1 : e.target.value
                      })
                    }
                  />
                </div>
                <div className="form-group">
                  <label>Ürün Açıklaması</label>
                  <textarea
                    className="form-control"
                    id="exampleTextarea1"
                    rows="6"
                    value={this.state.content}
                    onChange={e => this.setState({content: e.target.value})}
                  />
                </div>
                <div className="form-group">
                  <label
                    className={
                      this.state.alert === true && this.state.category === ''
                        ? 'text-danger'
                        : ''
                    }
                  >
                    Kategori
                  </label>
                  <select
                    className="form-control"
                    value={this.state.category}
                    onChange={e => this.setState({category: e.target.value})}
                  >
                    <option>Kategori Sec</option>
                    {this.state.allCategory.map((val, key) => (
                      <option key={key} value={val.id}>
                        {val.name}
                      </option>
                    ))}
                  </select>
                </div>
                <div className="form-group">
                  <label
                    className={
                      this.state.alert === true && this.state.img.length === 0
                        ? 'text-danger'
                        : ''
                    }
                  >
                    Ürün Görseli ekle <br /> Maksimum 4 adet eklenebilir
                  </label>
                  <div className="d-flex justify-content-start">
                    {this.state.img.length > 0 &&
                      this.state.img.map(val => (
                        <img
                          src={val.url}
                          className="w-25 rounded mx-auto d-block"
                        />
                      ))}
                  </div>
                  <div className="input-group">
                    <div className="custom-file">
                      <input
                        type="file"
                        className="custom-file-input"
                        id="inputGroupFile01"
                        onChange={this.handleChange}
                        aria-describedby="inputGroupFileAddon01"
                      />
                      <label
                        className="custom-file-label"
                        htmlFor="inputGroupFile01"
                      >
                        Yuklemek icin resim secin
                      </label>
                    </div>
                  </div>
                </div>
              </form>
              <button
                type="submit"
                className="btn btn-success mr-2"
                onClick={this.handleSubmit}
              >
                Ekle
              </button>
            </div>
          </div>
        </div>
        <React.Fragment>
          {this.state.product.length === 0 && (
            <h1 className="mx-auto mt-4 col-12 text-center">
              Urun bulunamadi. Yeni bir tane ekleyin.
            </h1>
          )}
          {this.state.product.length > 0 && (
            <div className="col-lg-12 grid-margin stretch-card">
              <div className="card">
                <div className="card-body">
                  <h4 className="card-title">
                    Urunler Toplam: {this.state.product.length}
                  </h4>
                  <p className="card-description"></p>
                  <div className="table-responsive pt-3">
                    <table className="table table-bordered">
                      <thead>
                        <tr>
                          <th>Sil</th>
                          <th>Urun kodu</th>
                          <th>Urun gorseli</th>
                          <th>Urun adi</th>
                          <th>Urun adi</th>
                          <th>Urun Aciklamasi</th>
                          <th>Urun Aciklamasi</th>
                          <th>Urun Ozellikleri</th>
                          <th>Eklenme tarihi</th>
                          <th>Kategori</th>
                          <th>Stok</th>
                          <th>Minimum Sipariş Sayısı</th>
                          <th>Fiyat</th>
                        </tr>
                      </thead>
                      <tbody>
                        {this.state.product.map((val, key) => (
                          <tr key={key}>
                            <td>
                              <i
                                onClick={() => this.deleteProduct(val.id)}
                                className="icon-trash"
                              />
                            </td>
                            <td>{val.code}</td>
                            <td className="text-center">
                              <img
                                className="img-fluid"
                                src={val.img}
                                alt={val.trName}
                              />
                            </td>
                            <td>{val.trName}</td>
                            <td>{val.enName}</td>
                            <td>{val.trContent}</td>
                            <td>{val.enContent}</td>
                            <td>{val.date}</td>
                            <td>{val.category}</td>
                            <td>{val.stok}</td>
                            <td>{val.features}</td>
                            <td>{val.price}</td>
                          </tr>
                        ))}
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          )}
        </React.Fragment>
      </React.Fragment>
    )
  }
}
