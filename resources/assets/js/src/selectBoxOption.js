import React from 'react'
import Swal from 'sweetalert2'
import withReactContent from 'sweetalert2-react-content'

const sweet = withReactContent(Swal)

function addSelectBoxData(adselectBox) {
  sweet
    .fire({
      title: 'Eklemek istediginiz opsiyon ismi giriniz',
      confirmButtonText: 'Ekle',
      input: 'text'
    })
    .then(result => {
      if (typeof result.value !== 'undefined') {
        if (result.value === '') {
          sweet.fire({
            title: 'eklemek icin birseyler yazmalisiniz',
            timer: 1500
          })
          return
        }
        adselectBox({title: result.value})
      }
    })
}

export default function SelectBoxOption({
  selectBoxList,
  adselectBox,
  deleteSelectBox
}) {
  return (
    <div className="mx-auto">
      <p className="lead ">Bu kisimdaki opsiyonlar fiyati etkilemez</p>
      <button
        type="button"
        onClick={() => addSelectBoxData(adselectBox)}
        className="btn btn-primary font-weight-bold mt-2 ml-2"
      >
        <span className="badge">
          <i className="icon-circle-plus"></i>
        </span>
        <span>Opsiyon Ekle </span>
      </button>
      {selectBoxList.length > 0 &&
        selectBoxList.map((e, key) => (
          <button
            key={key}
            onClick={() => deleteSelectBox(key)}
            className="btn btn-success mt-2 ml-2"
          >
            <span className="badge">
              <i className="icon-trash"></i>
            </span>
            <span>{e.title}</span>
          </button>
        ))}
    </div>
  )
}
