import React from 'react'

export default function ChexBoxOption({
  checkBoxList,
  addCheckBox,
  deleteCheckBox
}) {
  return (
    <div className=" mx-auto">
      <p className="lead">
        Bu kisimdaki opsiyonlar fiyati etkiler, Opsiyon ile birlikte yeni
        fiyatini giriniz
      </p>
      <button
        type="button"
        className="btn btn-primary font-weight-bold mt-2 ml-2"
      >
        <span className="badge">
          <i className="icon-circle-plus"></i>
        </span>
        <span>Opsiyon Ekle </span>
      </button>
      {checkBoxList.length > 0 &&
        checkBoxList.map((e, key) => (
          <button
            key={key}
            onClick={() => deleteCheckBox(key)}
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
