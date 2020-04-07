import React from 'react'
import Axios from 'axios'
import ChexBoxOption from './chexBoxOption'
import SelectBoxOption from './selectBoxOption'
import ProductList from './productList'

export default class Products extends React.Component {
  constructor(props) {
    super(props)

    this.state = {
      allCategory: [],
      category: '',
      name: '',
      code: '',
      quantity: 1,
      content: '',
      img: [],
      height: '',
      size: '',
      price: '',
      width: '',
      features: 1,
      weight: '',
      product: [],
      minorders: 1,
      selectedOption: {
        selectBox: false,
        checkBox: false
      },
      selectBox: [],
      checkBox: [],
      selectedOptionHover: 0
    }

    this.handleChange = this.handleChange.bind(this)
    this.handleSubmit = this.handleSubmit.bind(this)
    this.getProductList = this.getProductList.bind(this)
    this.getCategoryList = this.getCategoryList.bind(this)
  }

  async componentDidMount() {
    this.getProductList()
    this.getCategoryList()
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
    formData.set('minorders', this.state.minorders)

    formData.set('selectBox', JSON.stringify(this.state.selectBox))
    formData.set('checkBox', JSON.stringify(this.state.checkBox))

    const {data} = await Axios.post('/product/create', formData, {
      headers: {
        'content-type': 'multipart/form-data' // do not forget this
      }
    })

    if (data.status === true) {
      window.location.reload()
    }
  }

  async getProductList() {
    const {data} = await Axios.post('/product/list')

    if (data.status === true) {
      this.setState({product: data.data})
    }
  }

  async getCategoryList() {
    const {data} = await Axios.get('/category/all')

    if (data.status === true) {
      this.setState({allCategory: data.data})
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
    return (
      <React.Fragment>
        <div className="col-12 grid-margin stretch-card">
          <div className="card">
            <div className="card-body">
              <h1 className="display-2 text-center">Ürün Detayları</h1>
              <p className="text-center">
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
                    value={this.state.minorders}
                    onChange={e =>
                      this.setState({
                        minorders: e.target.value <= 0 ? 1 : e.target.value
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
                <div className="row mt-2 mb-2">
                  <div
                    style={{cursor: 'pointer'}}
                    className={
                      this.state.selectedOption.selectBox === true ||
                      this.state.selectedOptionHover === 1
                        ? 'col-md-6 border border-primary'
                        : 'col-md-6 '
                    }
                    onMouseEnter={() => this.setState({selectedOptionHover: 1})}
                    onMouseLeave={() => this.setState({selectedOptionHover: 0})}
                    onClick={() =>
                      this.setState({
                        selectedOption: Object.assign(
                          {},
                          this.state.selectedOption,
                          {
                            selectBox: !this.state.selectedOption.selectBox
                          }
                        )
                      })
                    }
                  >
                    <div className="form-group">
                      <label>Fiyati etkilemeyen ozellikler</label>
                      <select className="form-control form-control-sm">
                        <option>Ozellik 1</option>
                        <option>Ozellik 2</option>
                        <option>Ozellik 3</option>
                        <option>Ozellik 4</option>
                        <option>Ozellik 5</option>
                      </select>
                    </div>
                  </div>
                  <div
                    style={{cursor: 'pointer'}}
                    className={
                      this.state.selectedOption.checkBox === true ||
                      this.state.selectedOptionHover === 2
                        ? 'col-md-6 border border-primary'
                        : 'col-md-6 '
                    }
                    onMouseEnter={() => this.setState({selectedOptionHover: 2})}
                    onMouseLeave={() => this.setState({selectedOptionHover: 0})}
                    onClick={() =>
                      this.setState({
                        selectedOption: Object.assign(
                          {},
                          this.state.selectedOption,
                          {
                            checkBox: !this.state.selectedOption.checkBox
                          }
                        )
                      })
                    }
                  >
                    <div className="d-flex d-block h-100 align-items-center">
                      <div className="row w-100 d-flex justify-content-center">
                        <label className="col-sm-5 col-form-label">
                          Fiyati Etkileyen ozellikler
                        </label>
                        <div className="col-sm-3">
                          <div className="form-check">
                            <label className="form-check-label">
                              <input
                                type="radio"
                                className="form-check-input"
                                checked={true}
                                onChange={() => console.log('clicked')}
                              />
                              Ozellik 1<i className="input-helper"></i>
                            </label>
                          </div>
                        </div>
                        <div className="col-sm-4">
                          <div className="form-check">
                            <label className="form-check-label">
                              <input
                                type="radio"
                                className="form-check-input"
                                checked={false}
                                onChange={() => console.log('clicked')}
                              />
                              Ozellik 2<i className="input-helper"></i>
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div className="row mt-4 mb-2">
                  {this.state.selectedOption.selectBox === true && (
                    <SelectBoxOption
                      selectBoxList={this.state.selectBox}
                      adselectBox={e => {
                        let data = this.state.selectBox
                        data.push(e)
                        this.setState({selectBox: data})
                      }}
                      deleteSelectBox={e => {
                        let data = this.state.selectBox
                        data.splice(e, 1)
                        this.setState({
                          selectBox: data
                        })
                      }}
                    />
                  )}
                </div>
                <div className="row mt-4 mb-2">
                  {this.state.selectedOption.checkBox === true && (
                    <ChexBoxOption
                      checkBoxList={this.state.checkBox}
                      addCheckBox={e => {
                        let data = this.state.checkBox
                        data.push(e)
                        this.setState({checkBox: data})
                      }}
                      deleteCheckBox={e => {
                        let data = this.state.checkBox
                        data.splice(e, 1)
                        this.setState({
                          checkBox: data
                        })
                      }}
                    />
                  )}
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
                      this.state.img.map((val, key) => (
                        <img
                          key={key}
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
              <button className="btn btn-success" onClick={this.handleSubmit}>
                Ekle
              </button>
            </div>
          </div>
        </div>
        <ProductList products={this.state.product} />
      </React.Fragment>
    )
  }
}
