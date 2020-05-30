import React, {useEffect, useState} from 'react'
import Axios from 'axios'
import Popup from 'reactjs-popup'

const Modal = ({open, setOpen, addOption}) => {
  const [title, setTitle] = useState('')
  const [price, setPrice] = useState('')
  const [stock, setStock] = useState('')
  const [minOrders, setMinOrders] = useState('')

  const setData = () => {
    if (title !== '' && price > 0 && stock >= 0 && minOrders > 0) {
      addOption({
        title,
        price,
        stock,
        minOrders
      })
      setTitle('')
      setPrice('')
      setStock('')
      setMinOrders('')
    }
    setOpen()
  }
  return (
    <Popup open={open} contentStyle={{maxWidth: '800px', width: '95%'}} modal>
      <div className="mx-2">
        <div className="row d-flex justify-content-end">
          <img
            onClick={setOpen}
            type="button"
            width="30px"
            height="30px"
            src="/public/svg/close.svg"
          />
        </div>
        <div className="row mb-4">
          <p className="h4 mx-auto">Urun Icin Opsiyon Tanimlama</p>
        </div>
        <div className="row">
          <div className="col-sm-12 col-md-4 col-lg-4">
            <div className="form-group w-100">
              <label>Opsiyon Icin Alt Baslik Belirtin</label>
              <input
                value={title}
                onChange={e => setTitle(e.target.value)}
                type="text"
                className="form-control"
                aria-describedby="emailHelp"
                placeholder="Urun Adi"
              />
            </div>
          </div>
          <div className="col-sm-12 col-md-4 col-lg-4">
            <div className="form-group w-100">
              <label>Fiyat Belirtin</label>
              <input
                value={price}
                onChange={e =>
                  setPrice(e.target.value > 0 ? e.target.value : 0)
                }
                type="number"
                className="form-control"
                placeholder="Urun Kodu"
              />
            </div>
          </div>
          <div className="col-sm-12 col-md-4 col-lg-4">
            <div className="form-group w-100">
              <label>Stok Bilgisi</label>
              <input
                value={stock}
                onChange={e =>
                  setStock(e.target.value > 0 ? e.target.value : 0)
                }
                type="text"
                className="form-control"
                placeholder="Urun Kodu"
              />
            </div>
          </div>
        </div>
        <div className="row justify-content-between align-items-end">
          <div className="col-sm-12 col-md-6 col-lg-4">
            <div className="form-group w-100">
              <label>Minimum Siparis Adeti</label>
              <input
                value={minOrders}
                onChange={e =>
                  setMinOrders(e.target.value > 0 ? e.target.value : 1)
                }
                type="text"
                className="form-control"
                placeholder="Minimum Siparis Adeti"
              />
            </div>
          </div>
          <div className="col-sm-12 xol-md-6 col-lg-4 text-right">
            <button onClick={setData} type="button" className="btn btn-primary">
              Opsiyonu Ekle
            </button>
          </div>
        </div>
      </div>
    </Popup>
  )
}

const ProductImgUpdate = ({handleChange}) => {
  return (
    <div className="text-center">
      <p className="h5">Resim Sec</p>
      <label>
        <span className="glyphicon glyphicon-folder-open" aria-hidden="true">
          <img
            type="button"
            width="50px"
            height="50px"
            src="/public/svg/graphic-design.svg"
          />
        </span>
        <input type="file" style={{display: 'none'}} onChange={handleChange} />
      </label>
    </div>
  )
}

const ProductOptionList = ({data, deleteOption}) => {
  return (
    <div className="my-4">
      {data.map((e, key) => (
        <div className="border my-2" key={key}>
          <div className="row p-2">
            <div className="col text-center">
              <p>Opsyion</p>
              <p>{e.title}</p>
            </div>
            <div className="col text-center">
              <p>Fiyat</p>
              <p>{e.price}</p>
            </div>
            <div className="col text-center">
              <p>Stok</p>
              <p>{e.stock}</p>
            </div>
            <div className="col text-center">
              <p>Min. Siparis Adet</p>
              <p>{e.minOrders}</p>
            </div>
            <div className="col text-right">
              <img
                onClick={() => deleteOption(e.id)}
                type="button"
                width="30px"
                height="30px"
                src="/public/svg/close.svg"
              />
            </div>
          </div>
        </div>
      ))}
    </div>
  )
}

export default function ProductCreate() {
  const [modalIsOpen, setModalIsOpen] = useState(false)
  const [productName, setProductName] = useState('')
  const [productCode, setProductCode] = useState('')
  const [content, setContent] = useState('')
  const [img, setImg] = useState([])
  const [alert, setAlert] = useState(false)
  const [category, setCategory] = useState([])
  const [selectedCategory, setSelectedCategory] = useState([])
  const [option, setOption] = useState([])

  useEffect(() => {
    const getCategoryList = async () => {
      const {data} = await Axios.get('/category/all')

      if (data.status === true) {
        setCategory(data.data)
      }
    }

    getCategoryList()
  }, [])

  const updateCategory = e => {
    let isControl = false
    selectedCategory.forEach(val => {
      if (val.id == category[e.target.value].id) isControl = true
    })
    if (!isControl)
      setSelectedCategory([...selectedCategory, category[e.target.value]])
  }

  const deleteCategory = val => {
    setSelectedCategory(selectedCategory.filter(e => e.id !== val))
  }

  const deleteOption = val => {
    setOption(option.filter(e => e.id !== val))
  }

  const addOption = data => {
    setOption([...option, data])
  }

  const handleChange = event => {
    setImg([
      ...img,
      {
        url: URL.createObjectURL(event.target.files[0]),
        file: event.target.files[0]
      }
    ])
  }

  const handleSubmit = () => {
    if (
      productName === '' ||
      productCode === '' ||
      content === '' ||
      img.length === 0 ||
      selectedCategory.length === 0 ||
      option.length === 0
    ) {
      window.alert('Urun ekeleyebilmek icin gerekli alanlari doldurunuz')
      return
    }
    var productForm = new FormData()

    productForm.append('name', productName)
    productForm.append('category', JSON.stringify(selectedCategory))
    productForm.append('code', productCode)
    productForm.append('cardText', content)
    productForm.append('options', option)

    for (let a = 0; a < img.length; a++) {
      formData.set('img' + a, img[a].file)
    }

    console.log({
      productName,
      productCode,
      content,
      img,
      selectedCategory,
      option
    })
  }

  const modelShowUpdate = () => {
    setModalIsOpen(!modalIsOpen)
  }

  return (
    <>
      <Modal
        addOption={addOption}
        open={modalIsOpen}
        setOpen={modelShowUpdate}
      />
      <div className="container bg-white px-4">
        <div className="w-full mt-4 text-center">
          <p className="h1">Yeni Bir Tane Urun Tanimlayin</p>
        </div>
        <div className="row justify-content-sm-center mt-4 mb-4">
          <div className="col-sm-12 col-md-4 col-lg-4 row">
            {img.length !== 0 &&
              img.map((val, key) => (
                <div className="col row align-items-center">
                  <img
                    key={key}
                    src={val.url}
                    width="50px"
                    height="50px"
                    className="rounded mx-auto d-block"
                  />
                </div>
              ))}
            <div className="col row align-items-center justify-content-center">
              <ProductImgUpdate handleChange={handleChange} />
            </div>
          </div>
          <div className="col-sm-12 col-md-4 col-lg-4">
            <div className="form-group w-100">
              <label>Urun Adi</label>
              <input
                type="text"
                value={productName}
                onChange={e => setProductName(e.target.value)}
                className="form-control"
                placeholder="Urun Adi"
              />
            </div>
          </div>
          <div className="col-sm-12 col-md-4 col-lg-4">
            <div className="form-group w-100">
              <label>Urun Kodu</label>
              <input
                type="text"
                value={productCode}
                onChange={e => setProductCode(e.target.value)}
                className="form-control"
                placeholder="Urun Kodu"
              />
            </div>
          </div>
        </div>
        <div className="row">
          <div className="form-group w-100">
            <label>Urun Aciklamasi</label>
            <textarea
              className="form-control"
              rows="4"
              value={content}
              onChange={e => setContent(e.target.value)}
              placeholder="Urun Icin Aciklama Giriniz"
            ></textarea>
          </div>
        </div>
        <div className="row flex-sm-column-reverse flex-md-row flex-lg-row mb-4">
          <div className="col-sm-12 col-md-6 col-lg-6 col-xl-6">
            <label>Kategori Sec</label>
            <select onClick={updateCategory} className="custom-select" size="3">
              {category.length !== 0 &&
                category.map((val, key) => (
                  <option key={key} value={key}>
                    {val.name}
                  </option>
                ))}
            </select>
          </div>
          <div className="col-sm-12 col-md-6 col-lg-6 col-xl-6 mt-md-4 mt-lg-4">
            {selectedCategory.length !== 0 &&
              selectedCategory.map((e, key) => (
                <div key={key} className="btn btn-secondary m-1">
                  {e.name}{' '}
                  <span
                    onClick={() => deleteCategory(e.id)}
                    className="badge badge-light"
                  >
                    <img
                      type="button"
                      width="10px"
                      height="10px"
                      src="/public/svg/close.svg"
                    />
                  </span>
                </div>
              ))}
          </div>
        </div>
        <div className="row">
          <button
            onClick={modelShowUpdate}
            type="button"
            className="btn btn-primary"
          >
            Opsiyon Ekle
          </button>
        </div>
        <ProductOptionList deleteOption={deleteOption} data={option} />
        <div className="row tex-center my-4">
          <button onClick={handleSubmit} className="btn btn-success mx-auto">
            Yeni Urun Ekle
          </button>
        </div>
      </div>
    </>
  )
}
