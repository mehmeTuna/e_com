import React from 'react'
import axios from 'axios'
import Swal from 'sweetalert2'
import withReactContent from 'sweetalert2-react-content'

const sweet = withReactContent(Swal)

export default class Category extends React.Component {
  constructor(props) {
    super(props)

    this.state = {
      categoryNameEn: '',
      categoryNameTr: '',
      category: [],
      img: []
    }

    this.newCategory = this.newCategory.bind(this)
    this.getCategory = this.getCategory.bind(this)
    this.handleChange = this.handleChange.bind(this)
    this.deleteCategory = this.deleteCategory.bind(this)
  }

  componentDidMount() {
    //kategorileri iste ve listele
    this.getCategory()
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

  async getCategory() {
    const {data} = await axios.post('/category/list')

    if (data.status === true) {
      this.setState({category: data.data})
    }

    console.log(this.state.category)
  }

  async newCategory() {
    if (this.state.categoryNameTr === '') {
      sweet.fire('Lutfen karegori ismi giriniz')
      return
    }

    let formData = new FormData()
    formData.set('nameTr', this.state.categoryNameTr)
    formData.set('nameEn', this.state.categoryNameEn)

    if (this.state.img.length > 0) {
      for (let a = 0; a < this.state.img.length; a++) {
        formData.set('img' + a, this.state.img[a].file)
      }
    }

    const {data} = await axios.post('/category/create', formData, {
      headers: {
        'content-type': 'multipart/form-data' // do not forget this
      }
    })

    if (data.status === true) {
      sweet.fire('Kategori Eklendi')
      this.getCategory()
    } else {
      sweet.fire(data.text)
    }
  }

  async deleteCategory(id) {
    const {data} = await axios.post('/category/delete', {
      id: id
    })

    if (data.status === true) {
      this.getCategory()
    }
  }

  render() {
    return (
      <React.Fragment>
        <div className="col-12 grid-margin stretch-card">
          <div className="card">
            <div className="card-body">
              <div className="form-group">
                <label>Eklemek istediginiz kategori ismi giriniz</label>
                <br />
                <label>Türkçe</label>
                <input
                  type="text"
                  className="form-control"
                  value={this.state.categoryNameTr}
                  onChange={e =>
                    this.setState({categoryNameTr: e.target.value})
                  }
                  placeholder="Kategori ismi"
                />
                <label>English</label>
                <input
                  type="text"
                  className="form-control"
                  value={this.state.categoryNameEn}
                  onChange={e =>
                    this.setState({categoryNameEn: e.target.value})
                  }
                  placeholder="Kategori ismi"
                />
              </div>
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

              <div className="row display-3">
                <button
                  type="button"
                  className="btn btn-success font-weight-bold mx-auto mt-4"
                  onClick={this.newCategory}
                >
                  <span className="badge">
                    <i className="icon-circle-plus" />
                  </span>
                  <span>Kategori Ekle</span>
                </button>
              </div>
            </div>
          </div>
        </div>
        {this.state.category.length === 0 && (
          <h1 className="mx-auto mt-4">Kategori Yok</h1>
        )}
        {this.state.category.length > 0 && (
          <div className="col-12">
            <div className="card">
              <div className="card-body">
                <h4 className="card-title">Kategoriler</h4>
                <div className="table-responsive">
                  <table className="table">
                    <thead>
                      <tr>
                        <th>Sil</th>
                        <th>id</th>
                        <th>Kategori Gorsel</th>
                        <th>Kategori ismi Turkce</th>
                        <th>Kategori ismi Ingilizce</th>
                        <th>Kayitli urun sayisi</th>
                      </tr>
                    </thead>
                    <tbody>
                      {this.state.category.map(val => (
                        <tr key={val.id}>
                          <td>
                            <i
                              onClick={() => this.deleteCategory(val.id)}
                              className="icon-trash"
                            ></i>
                          </td>
                          <td>{val.id}</td>
                          <td className="text-center">
                            <img
                              className="img-fluid"
                              src={val.img}
                              alt={val.trName}
                            />
                          </td>
                          <td>{val.trName}</td>
                          <td>{val.enName}</td>
                          <td>{val.count}</td>
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
    )
  }
}
