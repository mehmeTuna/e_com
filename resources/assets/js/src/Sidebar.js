import React from 'react'
import {Link} from 'react-router-dom'

export default class Sidebar extends React.Component {
  constructor(props) {
    super(props)
  }

  render() {
    return (
      <nav className="sidebar sidebar-offcanvas" id="sidebar">
        <div className="user-profile">
          <div className="user-image"></div>
          <div className="user-name" />
          <div className="user-designation">Yonetim Paneli</div>
        </div>
        <ul className="nav">
          <li className="nav-item">
            <Link to={'/yonetim/anasayfa'} className="nav-link">
              <i className="icon-box menu-icon" />
              <span className="menu-title">AnaSayfa</span>
            </Link>
          </li>
          <li className="nav-item">
            <Link to={'/yonetim/siparisler'} className="nav-link">
              <i className="icon-box menu-icon" />
              <span className="menu-title">Siparisler</span>
            </Link>
          </li>
          <li className="nav-item">
            <Link to={'/yonetim/urunler'} className="nav-link">
              <i className="icon-box menu-icon" />
              <span className="menu-title">Urunler</span>
            </Link>
          </li>
          <li className="nav-item">
            <Link to={'/yonetim/kategoriler'} className="nav-link">
              <i className="icon-box menu-icon" />
              <span className="menu-title">Kategoriler</span>
            </Link>
          </li>
          <li className="nav-item">
            <Link to={'/yonetim/logo-slider'} className="nav-link">
              <i className="icon-box menu-icon" />
              <span className="menu-title"> Slider</span>
            </Link>
          </li>
          <li className="nav-item">
            <Link to={'/yonetim/icerik'} className="nav-link">
              <i className="icon-box menu-icon" />
              <span className="menu-title">Icerik Ekle</span>
            </Link>
          </li>
        </ul>
      </nav>
    )
  }
}
